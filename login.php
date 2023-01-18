<?php
	
    
    if(isset($_POST['submit']))
    {
       
        $email=$_POST['email'];
        $mdp=sha1($_POST['mdp']);
	    $salarie = $controleur ->login($email,$mdp);

    }

    require_once("vue/vue_login.php");

?>