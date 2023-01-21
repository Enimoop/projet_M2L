<?php


    if(isset($_POST['submit']))
    {
       
        $email=$_POST['email'];
        $mdp=sha1($_POST['mdp']);
	    
        $salarie = $controleur ->login($email,$mdp);
        
        if(isset($_POST['remember']))
        {
            setcookie('Auth',$salarie['id_u']."-----".sha1($salarie['email'].$salarie['mdp'].$_SERVER['REMOTE_ADDR']),
            time()+(3600*24*3),'/','localhost',false,true);
            //Le dernier argument evite que le cookie soit editable en javascript
            
        }

       header('Location:index.php');
    }

    if(isset($_COOKIE['Auth']))
    {  
        $auth=$_COOKIE['Auth'];
        $auth=explode('-----',$auth);

        $user = $controleur->loginId((int)$auth[0]);
        
        $key = $user['email'].$user['mdp'].$_SERVER['REMOTE_ADDR'];

        if ($key==$auth[1])
        {
            $_SESSION['id'] = $user['id_u'];
            setcookie('Auth', $user['id_u'].'-----'.sha1($user['email'].$user['mdp'].$_SERVER['REMOTE_ADDR']),
            time()+(3600*24*3),'/','localhost',false,true);
        
        }
        else 
        {
            setcookie('Auth','',time()-3600,'/','localhost',false,true);
            //A mettre sur la page de déconnexion
        }
        header('Location:index.php');
    }

    require_once("vue/vue_login.php");

?>