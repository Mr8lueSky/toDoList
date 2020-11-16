<?php

$dbname = 'users';

try {
    $dbh = new PDO('mysql:host=mrbluesky.zzz.com.ua;dbname=mrbluesky', 'mrbluesky', 'homapO44');
} catch(Exception $e) {
    echo $e;
    exit(1);
}

function user_exist($username, $password) {
    global $dbh, $dbname;
    $sth = $dbh->prepare("SELECT * FROM `" . $dbname . "` WHERE username='{$username}' AND password='{$password}'");
    $sth->execute();
    return $sth->fetchAll();
}