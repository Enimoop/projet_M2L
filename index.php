<?php require_once 'includes/header.php'; 
    
    require "controleur/controleur.class.php";
    require "core/auth.class.php";
    $controleur=new Controleur();
   
    /*
    $lesFormations=$controleur->allFormations();
    $lesSalaries=$controleur->allSalaries();

    if ($_GET['method']=='delete')
    {
       
        $controleur->deleteSalarie($_GET['id_u']);
    }
    ?>
    */



    if(isset($_GET['page'])){
        $page = $_GET['page'];

        if(!file_exists($page))
            $page = "404.php";
    }else{
        
        if(isset($_SESSION['id']) && $_SESSION['id'] == true)
            $page = "home.php";
        else
            $page = "login.php";
    }

    require_once($page);
	
    require_once 'includes/footer.php';   
