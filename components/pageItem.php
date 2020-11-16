<?php

function pageItem($number, $isActive=false) {
    $activeTag = "";
    $bg_color = "";
    $text_color = "";
    if($isActive){
        $activeTag = "active";
        $bg_color = "bg-success";
    } else{
        $text_color = "text-success";
    }
    return "<li class='page-item {$activeTag}'><a class='page-link border-success {$bg_color} {$text_color}' href='#' onclick='pageClick({$number})'>{$number}</a></li>";
}

?>	