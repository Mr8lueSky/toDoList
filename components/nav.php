<?php

function nav($number){
return "<li class='nav-item'>
    <a class='nav-link active' href='?&page={$number}'>{$number}</a>
  </li>";
}

?>