<?php

include_once 'pageItem.php';

function paggination($page, $max){
    $pages = '';
    $isActive = false;
    for($i = 1; $i <= $max; $i++){
        if($page == $i)
            $isActive = true;
        $pages .= pageItem($i, $isActive);
        $isActive = false;
    }
    return "<nav>
    <ul class='pagination pagination justify-content-center'>
        {$pages}
    </ul>
    </nav>";
}


?>	