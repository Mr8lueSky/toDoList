<?php

function card($item=null, $is_admin=false){
    if ($item == null)
        $item = array(
            'username' => '',
            'email' => '',
            'goal_text' => '',
            'done' => false
            );
    $icon = "";
    if ($item['done'] == true)
        $icon = "<i class='fa fa-check' id='done-{$item['id']}'></i>";
    return "<div class='card' style='width: 18rem;' id='task-{$item['id']}'>
      <div class='card-body'>
        <h3 class='card-title'>{$item['username']}{$icon}</h5>
        <h5 class='card-title'>{$item['email']}</h5>
        <p class='card-text' id='text-{$item['id']}'>{$item['goal_text']}</p>" . (($is_admin)?"<a href='#' id='button-{$item['id']}' onclick='editTask({$item['id']})' class='btn btn-primary bg-success border-0'>Edit</a>":"") . "
      </div>
    </div>";
}
?>	