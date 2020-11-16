<?php
$dbname = 'todolist';

try {
    $dbh = new PDO('mysql:host=mrbluesky.zzz.com.ua;dbname=mrbluesky', 'mrbluesky', 'homapO44');
} catch(Exception $e) {
    echo $e;
    exit(1);
}


function task_push($task){
    global $dbh, $dbname;
    $stmt = $dbh->prepare("INSERT INTO {$dbname} (goal_text, username, email) VALUES (:text, :username, :email)");
    $stmt->bindParam(':username', $task['username']);
    $stmt->bindParam(':text', $task['goal_text']);
    $stmt->bindParam(':email', $task['email']);
    $stmt->execute();
}

function task_update($task_id, $goal_text, $done){
    global $dbh, $dbname;
    $stmt = $dbh->prepare("UPDATE {$dbname} SET `goal_text`='{$goal_text}', `done`={$done} WHERE `id`={$task_id}");
    $stmt->execute();
}