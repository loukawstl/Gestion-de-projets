<?php
namespace App\Repository;
use App\Entity\Customer;
use App\Repository\Connection;


class CustomerRepository
{

     private const CUSTOMERS = ["customer1"=>["desc"=>"un client"],"customer2"=>["desc"=>"un client"]];

    public static function isCustomer(string $slug): bool
    {
        if(isset(self::CUSTOMERS[$slug])) {
            return true;
        }
        return false;
    }

    public static function getAllCustomers(): array
    {
        return self::CUSTOMERS;
    }

    public static function getCustomer(string $slug): array 
    {
        return self::CUSTOMERS[$slug];
    }
    /*

    //liste les clients
    public static function listCustomer(){
        $co = new Connection();
        echo '<table class="table table-striped table-bordered">';
            echo '<thead>';
                echo '<tr>';
                    echo'<th>id</th>';
                    echo'<th>Code</th>';
                    echo'<th>Name</th>';
                    echo'<th>Notes</th>';
                    echo'<th>Actions</th>';
                echo'</tr>';
            echo'</thead>';
            echo'<tbody>';
                $co->connectionBDD();
                $statement = $co->query('SELECT id, code, name, notes FROM customer ORDER BY id ASC');
                while($item = $statement->fetch()) {
                    echo '<tr>';
                    echo '<td>'. $item['id'] . '</td>';
                    echo '<td>'. $item['code'] . '</td>';
                    echo '<td>'. $item['name'] . '</td>';
                    echo '<td>'. $item['notes'] . '</td>';
                    echo '<td>';
                    echo '<a class="btn btn-primary" href="UpdateCustomer.php?id=' . $item['id'] . '">Modifier</a>';
                    echo '<a class="btn btn-primary" href="DeleteCustomer.php?id=' . $item['id'] . '">Supprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                $co->deconnectionBDD();
            echo'</tbody>';
        echo'</table>';
    }


    public static function createdCustomer(){
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->query('SELECT id, name FROM customer ORDER BY id ASC');
        echo '<label class="form-label">Client: </label>';
        echo '<select name="customer">';
        while($item = $statement->fetch()) {


            echo ' <option value = '. $item['id'].'>'. $item['id'] . ' - '. $item['name'] .'</option>';


        }
        $co->deconnectionBDD();
        echo '</select>';
    }

    //permet d'insérer un client dans la bdd
    public static function insertCustomer(Customer $myCustomer): Customer{
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("INSERT INTO customer (code, name, notes) values(?, ?, ?)");
        $statement->execute(array($myCustomer->getCode(), $myCustomer->getName(), $myCustomer->getNotes()));
        $co->deconnection();
        return $myCustomer;
    }

    //permet de sélectionner les données d'un client et de les insérer dans myCustomer
    public static function selectCustomer(Customer $myCustomer): Customer {
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("SELECT code, name, notes from customer WHERE id = ?");
        $statement->execute(array($myCustomer->getId()));
        $item = $statement->fetch();
        $myCustomer->setCode($item['code']);
        $myCustomer->setNotes($item['notes']);
        $myCustomer->setName($item['name']);
        $co->deconnectionBDD();
        return $myCustomer;
    }

    //permet de modifier les données du client mit en paramètre
    public static function updateCustomer(Customer $myCustomer){
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("UPDATE customer  set code = ?, name = ?, notes = ? WHERE id = ?");
        $statement->execute(array($myCustomer->getCode(), $myCustomer->getName(), $myCustomer->getNotes(), $myCustomer->getId()));
        $co->deconnectionBDD();
    }

    //permet d'initialiser l'array utilisé pour deleteCustomer
    public static function initializeArrayDelete(): array{
        $myArray = array(
            'isSuccess' => 1,
            'projectError' => '',
            'contactError' => '',
        );
        return $myArray;
    }

    //permet de supprimer un utilisateur, sauf si celui-ci est utilisé dans une autre table
    public static function deleteCustomer(int $id): array{

        $myArray = array(
            'isSuccess' => 0,
            'projectError' => '',
            'contactError' => '',
        );
        $isSuccess = true;

        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("SELECT * FROM project WHERE customer_id = ?");  
        $statement->execute(array($id));
        $count = $statement->fetchColumn();

        if($count>0){
            $myArray['projectError'] = 'Ce client est déjà lié à un ou des projet(s). Pour le supprimer, supprimez déjà le ou les projet(s) en question.';
            $isSuccess = false;
        }

        $statement = $co->prepare("SELECT * FROM contact WHERE customer_id = ?");
        $statement->execute(array($id));
        $count = $statement->fetchColumn();

        if($count>0){
            $myArray['contactError'] = 'Ce client est déjà lié à un ou des contact(s). Pour le supprimer, supprimez déjà le ou les contact(s) en question.';
            $isSuccess = false;
        }

        if($isSuccess){
            $statement = $co->prepare("DELETE FROM customer WHERE id=?");
            $statement->execute(array($id));
        }
        else{
            $myArray['isSuccess'] = 1;
        }

        $co->deconnectionBDD();
        return $myArray;
    }

    public static function initializeArrayValidate(): array{
        $myArray = array(
            'codeError' => '',
            'nameError' => '',
            'notesError' => '',
        );
        return $myArray;
    }

    //retourne un array qui contient dans l'ordre: 0/1, erreur code, erreur name, erreur notes
    public static function validateCustomer(Customer $myCustomer): array{
        
        $myArray = array(
            'isSuccess' => 0,
            'codeError' => '',
            'nameError' => '',
            'notesError' => '',
        );

        $isSuccess = true;

        if (Validator::checkEmpty($myCustomer->getCode())) {
            $myArray['codeError'] = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else if (Validator::checkLength255($myCustomer->getCode())){
            $myArray['codeError'] = 'Ce champ ne peut pas contenir plus de 255 caractères.';
            $isSuccess = false;
        }

        if (Validator::checkEmpty($myCustomer->getName())) {
            $myArray['nameError'] = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else if (Validator::checkLength255($myCustomer->getName())){
            $myArray['nameError']= 'Ce champ ne peut pas contenir plus de 255 caractères.';
            $isSuccess = false;
        }

        if (Validator::checkLength1000($myCustomer->getNotes())){
            $myArray['notesError'] = 'Ce champ ne peut pas contenir plus de 1000 caractères.';
            $isSuccess = false;
        }

        if ($isSuccess == false){
            $myArray['isSuccess'] = '1';
        }

        return $myArray;

    }
    */
}
