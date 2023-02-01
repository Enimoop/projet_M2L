<?php
class Modele
{
    private $PDO ; // instance de la classe PDO

    public function __construct (){
        $this -> PDO=null;
        try{
            $url ="mysql:host=localhost;dbname=M2L";
            $user="root";
            $mdp=""; 
            $this->PDO=new PDO($url, $user, $mdp);
        }
        catch(PDOException $exp){
            echo "Erreur de connexion à la bdd";
            echo $exp->getMessage();
        }
    }
    /************** Les Formations **************/
    public function allFormations(int $id_u) {
        if ($this -> PDO != null ){
            $requete = "select * from formation left join suivre on formation.id_f=suivre.id_f 
            and suivre.id_u=".$id_u.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $lesFormations = $select -> fetchAll();
            return $lesFormations;
        }else{
            return null;
        }

    }

    public function allFormationsWaiting(int $id_u)
    {
        if ($this -> PDO != null ){
            $requete = "select * from formation inner join suivre on formation.id_f=suivre.id_f 
            inner join users on suivre.id_u=users.id_u 
            and users.id_chef=".$id_u." and etat = 2;";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $lesFormations = $select -> fetchAll();
            return $lesFormations;
        }else{
            return null;
        }
    }

    public function accepter(int $id_u, int $id_f)
    {
        if ($this -> PDO != null ){
            $requete = "update suivre set etat = 1  
            where id_u=".$id_u." and id_f=".$id_f.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();  
            
        }
    }

    public function refuser(int $id_u, int $id_f)
    {
        if ($this -> PDO != null ){
            $requete = "update suivre set etat = 3  
            where id_u=".$id_u." and id_f=".$id_f.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();  
            
        } 
    }

     /************** Les Salaries **************/
     public function allSalaries() {
        if ($this -> PDO != null ){
            $requete = "select * from users;";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $lesSalaries = $select -> fetchAll();
            return $lesSalaries;
        }else{
            return null;
        }
        }
    

    public function deleteSalarie(int $id_u){
        if ($this -> PDO != null ){
            $requete = "delete from users where id_u=".$id_u.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
        }else{
            return null;
        }
    }

    public function findSalarie(string $email, $mdp) 
    {
        if ($this -> PDO != null ){
            $requete = "select * from users where email='".$email."' and mdp='".$mdp."';";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $salarie = $select -> fetch();
            return $salarie;
        }else{
            return null;
        }
    }

    public function loginId(int $id)
    {
        if ($this -> PDO != null ){
            $requete = "select * from users where id_u=".$id.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $salarie = $select -> fetch();
            return $salarie;
        }else{
            return null;
        }
    }

    public function countSalarie()
    {
    if ($this -> PDO != null ){
        $requete = "select count(id_u) as nb from users;";
        $select = $this-> PDO-> prepare($requete);
        $select-> execute();
        $count = $select -> fetch();
        return $count;
    }else{
        return null;
    }
    }

    public function countSubordonne()
    {
        if ($this -> PDO != null ){
            $requete = "select count(id_u) as nb_sub from users where id_chef=".$_SESSION['id'].";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $countSub = $select -> fetch();
            return $countSub;
        }else{
            return null;
        }
    }

    public function allSubordonnes()
    {
        if ($this -> PDO != null ){
            $requete = "select * from users where id_chef=".$_SESSION['id'].";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $lesSubordonnes = $select -> fetchAll();
            return $lesSubordonnes;
        }else{
            return null;
        } 
    }

    public function banSubordonnes(int $id_u)
    {
        if ($this -> PDO != null ){
            $requete = "update users set lvl= '0' where id_u=".$id_u.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
        }else{
            return null;
        }
    }

    public function insertSalarie(string $email, string $mdp, string $nom_u, string $prenom_u, int $lvl)
    {
        if ($this -> PDO != null ){
            $requete = "insert into users (email, mdp, nom_u, prenom_u, lvl) values
            ('".$email."','".$mdp."','".$nom_u."','".$prenom_u."', ".$lvl.");";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
        }else{
            return null;
        }
    }

    public function editSalarie(string $email, string $nom, string $prenom, string $mdpconfirm, int $id_u)
    {
        if ($this -> PDO != null ){
            $requete = "update users set email='".$email."',nom_u='".$nom."',prenom_u='".$prenom."', mdp='".$mdpconfirm."' where id_u=".$id_u.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
        }else{
            return null;
        }
    }
    

    public function infoSalarie(int $id_u) 
    {
        if ($this -> PDO != null ){
            $requete = "select * from users where id_u=".$id_u.";";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $infoSalarie = $select -> fetch();
            return $infoSalarie;
        }else{
            return null;
        }
    }

    public function rechercher(string $libelle_f)
    {
        if ($this -> PDO != null){
            $requete = "select * from formation where libelle_f like '%".$libelle_f."%';";
            $select = $this-> PDO-> prepare($requete);
            $select-> execute();
            $recherche = $select -> fetch();
            return $recherche;
        }else{
            return null;
        }
    }

  



}