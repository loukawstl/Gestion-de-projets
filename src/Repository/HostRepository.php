<?php
namespace App\Repository;
use App\Classes\Host;
use App\Connection\Connection;
use App\Classes\Project;

class HostRepository
{

    //liste les clients
    public static function listHost(){
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
        $statement = $co->query('SELECT id, code, name, notes FROM host ORDER BY id ASC');
        while($item = $statement->fetch()) {
            echo '<tr>';
            echo '<td>'. $item['id'] . '</td>';
            echo '<td>'. $item['code'] . '</td>';
            echo '<td>'. $item['name'] . '</td>';
            echo '<td>'. $item['notes'] . '</td>';
            echo '<td>';
            echo '<a class="btn btn-primary" href="UpdateHost.php?id=' . $item['id'] . '">Modifier</a>';
            echo '<a class="btn btn-primary" href="DeleteHost.php?id=' . $item['id'] . '">Supprimer</a>';
            echo '</td>';
            echo '</tr>';
        }
        $co->deconnectionBDD();
        echo'</tbody>';
        echo'</table>';
    }

    public static function createdHost(){
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->query('SELECT id, name FROM host ORDER BY id ASC');
        echo '<label class="form-label">Hotes: </label>';
        echo '<select name="host">';
        while($item = $statement->fetch()) {


                echo ' <option value = '. $item['id'].'>' . $item['id'] . ' - '. $item['name'] .'</option>';


        }
        $co->deconnectionBDD();
        echo '</select>';
        }


    //permet d'insérer un client dans la bdd
    public static function insertHost(Host $myHost): Host{
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("INSERT INTO host (code, name, notes) values(?, ?, ?)");
        $statement->execute(array($myHost->getCode(), $myHost->getName(), $myHost->getNotes()));
        $co->deconnection();
        return $myHost;
    }

    //permet de sélectionner les données d'un client et de les insérer dans myCustomer
    public static function selectHost(Host $myHost): Host {
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("SELECT code, name, notes from host WHERE id = ?");
        $statement->execute(array($myHost->getId()));
        $item = $statement->fetch();
        $myHost->setCode($item['code']);
        $myHost->setNotes($item['notes']);
        $myHost->setName($item['name']);
        $co->deconnectionBDD();
        return $myHost;
    }

    //permet de modifier les données du client mit en paramètre
    public static function updateHost(Host $myHost){
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("UPDATE host  set code = ?, name = ?, notes = ? WHERE id = ?");
        $statement->execute(array($myHost->getCode(), $myHost->getName(), $myHost->getNotes(), $myHost->getId()));
        $co->deconnectionBDD();
    }

    //permet d'initialiser l'array utilisé pour deleteCustomer
    public static function initializeArray(): array{
        $myArray = array(
            'isSuccess' => 1,
            'projectError' => '',
            'contactError' => '',
        );
        return $myArray;
    }

    //permet de supprimer un utilisateur, sauf si celui-ci est utilisé dans une autre table
    public static function deleteHost(int $id): array{

        $myArray = array(
            'isSuccess' => 0,
            'projectError' => '',
            'contactError' => '',
        );
        $isSuccess = true;

        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("SELECT * FROM project WHERE host_id = ?");
        $statement->execute(array($id));
        $count = $statement->fetchColumn();

        if($count>0){
            $myArray['projectError'] = 'Ce client est déjà lié à un ou des projet(s). Pour le supprimer, supprimez déjà le ou les projet(s) en question.';
            $isSuccess = false;
        }

        $statement = $co->prepare("SELECT * FROM contact WHERE host_id = ?");
        $statement->execute(array($id));
        $count = $statement->fetchColumn();

        if($count>0){
            $myArray['contactError'] = 'Ce client est déjà lié à un ou des contact(s). Pour le supprimer, supprimez déjà le ou les contact(s) en question.';
            $isSuccess = false;
        }

        if($isSuccess){
            $statement = $co->prepare("DELETE FROM host WHERE id=?");
            $statement->execute(array($id));
        }
        else{
            $myArray['isSuccess'] = 1;
        }

        $co->deconnectionBDD();
        return $myArray;
    }
}