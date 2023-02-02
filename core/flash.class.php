<?php

class Flash{
    public static function setFlash($type,$message){
        $_SESSION['message']= "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
  <strong>".$message."</strong> 
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        
    }

    public static function getFlash(){
        if(isset($_SESSION['message'])){
        $message=$_SESSION["message"];
        unset($_SESSION["message"]);
        return $message;
        }
    }
}