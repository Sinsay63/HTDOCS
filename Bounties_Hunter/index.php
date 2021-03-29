    <?php
    session_name("Sinsay");
    session_start();
    
    require_once('header.php');
    
    require_once("tools/SuperController.php");
    
    if(!empty($_GET['page'])) {
        $page = $_GET['page'];
    }
    SuperController::callPage($page);
        
    require_once('footer.php');
    ?>		
