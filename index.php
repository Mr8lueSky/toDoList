<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once 'models/ToDoList.php';
    include_once 'components/task.php';
    include_once 'components/pagination.php';
    include_once 'components/nav.php';
    include_once 'components/navbar.php';
    include_once 'controllers/ToDoController.php';
    
    ob_start();
    session_start();
    
    $logged_in = $_SESSION['login'];
    if (!isset($_GET['page'])){
        $_GET['page'] = '1';
    }
    if (!isset($_GET['sort-by'])){
        $_GET['sort-by'] = 'Id';
    }
    if (!isset($_GET['order-by'])){
        $_GET['order-by'] = 'A - Z';
    }
    
    if (isset($_GET['logout']) && $_GET['logout'] == true){
        unset($_SESSION['login']);
        $_GET['logout'] = false;
        header('Location: index.php');
    }
    if ($_GET['order-by'] == 'A - Z')
        $order_by = true;
    else
        $order_by = false;
    if ($_GET['sort-by'] == 'Is done')
        $sort_by = 'done';
    else
        $sort_by = strtolower($_GET['sort-by']);
    $tasks =  get_page($_GET['page'], $sort_by, $order_by);
    if (count($_POST)) {
        if (isset($_POST['id']) && $logged_in && !empty($_POST['goal_text'])){
            if ($_POST['done'] == 'true'){
                $done = 1;
            } else {
                $done = 0;
            }
            task_update($_POST['id'], $_POST['goal_text'], $done);
        } else {
            $email = $_POST["email"];
            if (empty($_POST['goal_text'])) {
                $errors = "You must fill in goal text";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } elseif (empty($_POST['username'])) {
                $errors = "You must fill in username";
            }
            else{
                $task = array(
                    'username' => $_POST['username'],
                    'goal_text' => $_POST['goal_text'],
                    'email' => $_POST['email']
                );
    
                task_push($task);
                header("Refresh:0");
            }
        }
    }
    ?>
    <meta charset="UTF-8">
    <title>ToDoList</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="static/style.css">
    <script src="static/script.js"></script>
</head>
<body>
<?php echo navbar($logged_in) ?>
<?php echo paggination($_GET['page'], ceil(get_count() / 3)); ?>
</div>

<div class="container">
    <div class="form-group row">
        <div class="col-sm">
            <label>Sort by</label>
            <select class="form-control" id="sort-by" onchange="sortTasks()">
                <option>Id</option>
                <option>Email</option>
                <option>Username</option>
                <option>Is done</option>
            </select>
        </div>
        <div class="col-sm">
            <label>Order by</label>
            <select class="form-control" id="order-by" onchange="orderTasks()">
                <option>A - Z</option>
                <option>Z - A</option>
            </select>
        </div>
    </div>
</div>

<div class="card-group">
<?php foreach ($tasks as $task): ?>
    <?php if ($task != null) echo card($task, $logged_in) ?>
<?php endforeach; ?>
</div>

<form method="post">
    <h3>Add task</h3>
    <?php if (isset($errors)) { ?>
        <div class="error">
            <?php echo $errors; ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="exampleFormControlInput1">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="name">
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Task text</label>
        <textarea class="form-control" name="goal_text" id="goal_text" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary mb-2 bg-success border-0">Add task</button>
</form>
</body>
</html>						