<?php

$dbname = 'todolist';

try {
    $dbh = new PDO('mysql:host=mrbluesky.zzz.com.ua;dbname=mrbluesky', 'mrbluesky', 'homapO44');
} catch(Exception $e) {
    echo $e;
    exit(1);
}

function get_list($count=null, $sort_by=null, $order_by=null) {
    if(!$order_by)
        $order_by = 'DESC';
    else
        $order_by = 'ASC';
    global $dbh, $dbname;
    if($count != null)
        $sth = $dbh->prepare('SELECT * from ' . $dbname . ' ORDER BY ' . $sort_by . ' ' . $order_by . ' LIMIT ' . strval($count));
    elseif ($sort_by)
        $sth = $dbh->prepare('SELECT * from ' . $dbname . ' ORDER BY ' . $sort_by . ' ' . $order_by);
    else
        return $dbh->prepare('SELECT * from ' . $dbname);
    $sth->execute();
    return $sth->fetchAll();
}


function get_count(){
    global $dbh, $dbname;
    // SELECT COUNT(*) FROM `todolist`
    $count = $dbh->prepare("SELECT COUNT(*) FROM {$dbname}");
    $count->execute();
    return $count->fetchColumn();
}

function get_page($page, $sort_by=null, $order_by=null){
    $last_page = $page * 3;
    $tasks = get_list($page * 3, $sort_by, $order_by);
    $pages = array();
    for($i = $page * 3 - 3; $i < $page * 3; $i++){
        array_push($pages, $tasks[$i]);
    }
    return $pages;
}