<?php

class Auth{
    public  static function verif(int $level)
    {
        if(!isset($_SESSION['connecte']) || $_SESSION['connecte']!=true) //vérification de la connexion
	    {
		
		    header('Location:index.php');
		
	    }
	    else 
	    {
		    if ($_SESSION['lvl']<$level) 		//vérification du level
			header('Location:index.php');
	    }
    }
}