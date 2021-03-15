<?php

include 'header.php';
if (isset($_GET["page"])){
    if ($_GET["page"]==1){
       include 'main_listpost.php';
    }
    elseif ($_GET["page"]==2) {
        include 'main_contact.php';
}
else {
    include 'main_index.php';
}
}
else{
    include 'main_index.php';
}

include 'footer.php';

  ?>