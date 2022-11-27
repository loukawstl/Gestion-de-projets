<?php 
namespace App\Connection; 
use PDO;

class Connection{

    /*

    protected $server="localhost";
    protected $dbName="environgestion";
    protected $user="root";
    protected $pass="";

    private $co;

    //connexion à la BDD
    public function connectionBDD(){
        $dsn = "mysql:host=" . $this->server ."; charset=utf8; dbname=" . $this->dbName;
        $this->co = new PDO($dsn, $this->user, $this->pass);
        $this->co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //deconnexion
    public function deconnectionBDD(){
        $var = NULL;
        return $var;
    }

    //__call permet de récuperer toutes les fonctions de PDO comme query
    public function __call($name, array $arguments) {

        if(method_exists($this->co, $name)){
            try{
                return call_user_func_array(array(&$this->co, $name), $arguments);
            }
            catch(Exception $e){
                throw new Exception('Erreur: "'.$name.'" nexiste pas.');
            }
         }
     }

     */
}