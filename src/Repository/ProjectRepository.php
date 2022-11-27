<?php
namespace App\Repository;
use App\Entity\Project;
use App\Repository\Connection;
use App\Entity\Customer;
use  App\Entity\Host;
class ProjectRepository
{

    private const PROJECTS = ["project1"=>["desc"=>"un projet"],"project2"=>["desc"=>"un projet"]];

    public static function isProject(string $slug): bool
    {
        if(isset(self::PROJECTS[$slug])) {
            return true;
        }
        return false;
    }

    public static function getAllProjects(): array
    {
        return self::PROJECTS;
    }

    public static function getProject(string $slug): array 
    {
        return self::PROJECTS[$slug];
    }
    /*

    //liste les clients
    public static function listProject()
    {
        $co = new Connection();
        echo '<table class="table table-striped table-bordered">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Id</th>';
        echo '<th>Nom</th>';
        echo '<th>Code</th>';
        echo '<th>Dernier dossier de passe</th>';
        echo '<th>lien maquettes</th>';
        echo '<th>Le serveur est-il géré?</th>';
        echo '<th>Notes</th>';
        echo '<th>Hôte</th>';
        echo '<th>Client</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $co->connectionBDD();
        $statement = $co->query('SELECT project.id, project.name, project.code, lastpass_folder, link_mock_ups, managed_server, project.notes, host.name as host_name, host.id as host_id, customer.name as customer_name, customer.id as customer_id  FROM project INNER JOIN customer on project.customer_id = customer.id JOIN host on project.host_id = host.id ORDER BY project.id ASC');
        while ($item = $statement->fetch()) {
            echo '<tr>';
            echo '<td>' . $item['id'] . '</td>';
            echo '<td>' . $item['name'] . '</td>';
            echo '<td>' . $item['code'] . '</td>';
            echo '<td>' . $item['lastpass_folder'] . '</td>';
            echo '<td>' . $item['link_mock_ups'] . '</td>';
            if ($item['managed_server'] == 0){
                echo '<td> Non </td>';
            }
            else{
                echo '<td> Oui </td>';
            }
            echo '<td>' . $item['notes'] . '</td>';
            echo '<td>' . $item['host_id'] . ' - ' . $item['host_name'] . '</td>';
            echo '<td>' . $item['customer_id'] . ' - ' . $item['customer_name'] . '</td>';
            echo '<td>';
            echo '<a class="btn btn-primary" href="UpdateProject.php?id=' . $item['id'] . '">Modifier</a>';
            echo '<a class="btn btn-primary" href="DeleteProject.php?id=' . $item['id'] . '">Supprimer</a>';
            echo '</td>';
            echo '</tr>';
        }
        $co->deconnectionBDD();
        echo '</tbody>';
        echo '</table>';
    }

    //permet d'insérer un client dans la bdd
    public static function insertProject(Project $myProject): Project
    {
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("INSERT INTO project (name, code, lastpass_folder, link_mock_ups, managed_server, notes, host_id, customer_id) values(?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array($myProject->getName(), $myProject->getCode(), $myProject->getLastPassFolder(), $myProject->getLinkMockUps(), $myProject->getManagedServer(),  $myProject->getNotes(), $myProject->getHost()->getId() , $myProject->getCustomer()->getId()));
        $co->deconnection();
        return $myProject;
    }

    //permet de sélectionner les données d'un client et de les insérer dans myProject
    public static function selectProject(Project $myProject): Project
    {
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("SELECT name, code, lastpass_folder, link_mock_ups, managed_server, notes, host_id, customer_id from project WHERE id = ?");
        $statement->execute(array($myProject->getId()));
        $item = $statement->fetch();
        $myCustomer = new Customer ($item['customer_id'], "", "", "");
        $myHost = new Host ($item['host_id'], "","","");
        HostRepository::selectHost($myHost);
        customerRepository::selectCustomer($myCustomer);
        $myProject->setName($item['name']);
        $myProject->setCode($item['code']);
        $myProject->setLastPassFolder($item['lastpass_folder']);
        $myProject->setLinkMockUps($item['link_mock_ups']);
        $myProject->setManagedServer($item['managed_server']);
        $myProject->setNote($item['notes']);
        $myProject->setHost($myHost);
        $myProject->setCustomer($myCustomer);
        $co->deconnectionBDD();
        return $myProject;
    }

    //permet de modifier les données du client mit en paramètre
    public static function updateProject(Project $myProject)
    {
        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("UPDATE project  set name = ?, code = ?, lastpass_folder = ?, link_mock_ups = ?, managed_server = ?, notes = ?, host_id = ?, customer_id = ? WHERE id = ?");
        $statement->execute(array($myProject->getName(), $myProject->getCode(), $myProject->getLastPassFolder(), $myProject->getLinkMockUps(), $myProject->getManagedServer(),  $myProject->getNotes(), $myProject->getHost()->getId(), $myProject->getCustomer()->getId(), $myProject->getId()));
        $co->deconnectionBDD();
    }

    //permet d'initialiser l'array utilisé pour deleteCustomer
    public static function initializeArray(): array
    {
        $myArray = array(
            'isSuccess' => 1,
            'projectError' => '',
            'contactError' => '',
        );
        return $myArray;
    }

    //permet de supprimer un utilisateur, sauf si celui-ci est utilisé dans une autre table
    public static function deleteProject(int $id): array
    {

        $myArray = array(
            'isSuccess' => 0,
            'environmentError' => '',

        );
        $isSuccess = true;

        $co = new Connection();
        $co->connectionBDD();
        $statement = $co->prepare("SELECT * FROM environment WHERE project_id = ?");
        $statement->execute(array($id));
        $count = $statement->fetchColumn();

        if ($count > 0) {
            $myArray['projectError'] = 'Ce projet est déjà lié à un ou des environnement(s). Pour le supprimer, supprimez déjà le ou les projet(s) en question.';
            $isSuccess = false;
        }
        if ($isSuccess) {
            $statement = $co->prepare("DELETE FROM project WHERE id=?");
            $statement->execute(array($id));
        } else {
            $myArray['isSuccess'] = 1;
        }

        $co->deconnectionBDD();
        return $myArray;
    }
    */
}
