<?php 
require_once "modele/modele.class.php";

class Controleur 
{

    private $modele;

        public function __construct()
        {
            $this->modele =new Modele();
        }

        public function allFormations(int $id_u)
        {
            $allFormations=$this->modele->allFormations($id_u);
            return $allFormations;
        }

        public function allFormationsWaiting(int $id_u)
        {
            $allFormationsWaiting=$this->modele->allFormationsWaiting($id_u);
            return $allFormationsWaiting;
        }

        public function accepter(int $id_u, int $id_f)
        {
            $accepter=$this->modele->accepter($id_u, $id_f);  
        }

        public function refuser(int $id_u, int $id_f)
        {
            $refuser=$this->modele->accepter($id_u, $id_f);  
        }

        public function findFormation()
        {

        }

        public function insertFormation()
        {

        }

        public function editFormation()
        {

        }

        public function deleteFormation()
        {

        }
        
        public function allSalaries()
        {
            $allSalaries=$this->modele->allSalaries();
            return $allSalaries;
        }



        public function insertSalarie(string $email, string $nom_u, string $prenom_u, int $lvl)
        {
            $chaine='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789?@!';
    $mdp=$chaine[rand(0,25)];
    $mdp.=$chaine[rand(0,25)];
    $mdp.=$chaine[rand(26,51)];
    $mdp.=$chaine[rand(26,51)];
    $mdp.=$chaine[rand(52,61)];
    $mdp.=$chaine[rand(52,61)];
    $mdp.=$chaine[rand(52,61)];
    $mdp.=$chaine[rand(62,64)];
    $mdp=str_shuffle($mdp);
    
      echo "<div class='alert alert-success' role='alert'>".$mdp."
    </div>";
            $insertSalarie=$this->modele->insertSalarie($email,sha1($mdp), $nom_u, $prenom_u, $lvl);
        }

        public function editSalarie(string $email, string $mdpconfirm, string $nom, string $prenom, int $id_u )
        {
            $this->modele->editSalarie($email, $mdpconfirm,$nom,$prenom,$id_u);
        }

        public function deleteSalarie(int $id_u)
        {
            $this->modele->deleteSalarie($id_u);
        }

        public function login($email, $mdp)
        {
            $salarie = $this->modele->findSalarie($email, $mdp);



            if($salarie == false)
            {
                echo "<div class='alert alert-danger' role='alert'>
                         Mauvais identifiant
                        </div>";
            }
            else
            {
                
                $_SESSION['connecte']=true;
                $_SESSION['id']=$salarie['id_u'];
                $_SESSION['lvl']=$salarie['lvl'];
               return $salarie;
            }
        }
        public function loginid(int $id){
            $salarie = $this->modele->loginId($id);
            
            $_SESSION['connecte']=true;
            $_SESSION['id']=$salarie['id_u'];
            $_SESSION['lvl']=$salarie['lvl'];
        }

        public function logout()
        {
            $_SESSION = array();
            session_destroy();
            setcookie('Auth','',time()-3600,'/','localhost',false,true);
            header('Location: index.php');
        }

        public function countSalarie()
        {
            $count=$this->modele->countSalarie();
            return $count;
        }

        public function countSubordonne()
        {
            $countSub=$this->modele->countSubordonne();
            return $countSub;
        }

        public function allSubordonnes()
        {
            $allSubordonnes=$this->modele->allSubordonnes();
            return $allSubordonnes;
        }

        public function banSubordonnes(int $id_u)
        {
            $banSubordonnes=$this->modele->banSubordonnes($id_u);
        }

        public function infoSalarie(int $id_u)
        {
            $infoSalarie=$this->modele->infoSalarie($id_u);
            return $infoSalarie;
        }

        public function rechercher(string $libelle_f)
        {
            $rechercher=$this->modele->rechercher($libelle_f);
            return $rechercher;
        }

        


}