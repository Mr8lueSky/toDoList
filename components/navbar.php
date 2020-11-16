<?php
//
function navbar($logged_in=false){
    if($logged_in)
        $span = '<span class="link"><a href="?&logout=true"><p>Log out<p></a></span>';
    else
        $span = '<span class="link"><a href="auth.php"><p>Log in<p></a></span>';
    return "<nav class='p-3 mb-2 bg-success text-white'>
    <span class='navbar-brand mb-0 h1 link'><a href='index.php'>ToDoList</a></span>" . $span . "</nav>";
}	