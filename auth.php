<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "components/navbar.php";
    include_once "models/UsersList.php";
    
    ob_start();
    session_start();

    if (count($_POST)) {
        $username = $_POST["username"];
        $password = $_POST['password'];
        if (empty($username)) {
            $errors = "You must fill in username";
        } elseif (empty($password)) {
            $errors = "You must fill in password";
        }
        elseif(user_exist($username, $password)){
            $_SESSION['login'] = true;
            header('Location: index.php');
        } else {
            $errors = "Wrong username or password";
        }
    }
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Auth page</title>
    <style>
    form{
        width: 60%;
        margin-left: 2%;
    }
    .error{
        color:red;
    }
    .link a{
        color:white;
    }
    .link a:hovered{
        color:white;
    }
    .link a:visited{
        color:white;
    }
    </style>
</head>


<body>
<?php echo navbar(); ?>

<form method="post">
    <?php if (isset($errors)) { ?>
        <div class="error">
            <?php echo $errors; ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <label for="exampleFormControlInput1">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary mb-2 bg-success border-0">Add task</button>
</form>
</body>
</html>	
