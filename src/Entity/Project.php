<?php
namespace App\Classes;

/*use App\Classes\Host;
use App\Classes\Customer;
use App\Interfaces\AllInterface;
use App\Traits\HasId;
use App\Traits\HasName;
use App\Traits\HasNotes;
use App\Traits\HasCode;*/




class Project implements AllInterface
{
    /*use HasId;
    use HasName;
    use HasNotes;
    use HasCode;*/



    private int $id;
    private string $name;
    private string $code;
    private string $lastpassFolder;
    private string $linkMockUps;
    private bool $managedServer;
    private string $note;
    private Host $host;
    private Customer $customer;
    
    public function __construct( int $id, string $name, string $code, string $lastpassFolder, string $linkMockUps, bool $managedServer, string $note, Host $host, Customer $customer)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->lastpassFolder = $lastpassFolder;
        $this->linkMockUps = $linkMockUps;
        $this->managedServer = $managedServer;
        $this->note = $note;
        $this->host = $host;
        $this->customer = $customer;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getLastpassFolder(): string
    {
        return $this->lastpassFolder;
    }
    public function setLastPassFolder(string $lastPassFolder): void
    {
        $this->lastpassFolder = $lastPassFolder;
    }

    public function getLinkMockUps(): string
    {
        return $this->linkMockUps;
    }
    public function setLinkMockUps(string $linkMockUps): void
    {
        $this->linkMockUps = $linkMockUps;
    }

    public function getManagedServer(): bool
    {
        return $this->managedServer;
    }
    public function setManagedServer(bool $managedServer): void
    {
        $this->managedServer = $managedServer;
    }

    public function getNotes(): string
    {
        return $this->note;
    }
    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getHost(): Host
    {
        return $this->host;
    }

    public function setHost(Host $host): void
    {
        $this->host = $host;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function echoAll(){
        echo "<h2> Project : </h2>";
        echo "<ul>";
        echo "<li>id : " . $this->getId() . "</li>";
        echo "<li>code : " . $this->getName() . "</li>";
        echo "<li>lastpassFolder : " . $this->getLastpassFolder() . "</li>";
        echo "<li>lien mocks up : " . $this->getLinkMockUps() . "</li>";
        echo "<li>serveur actif (bool) : " . $this->getManagedServer() . "</li>";
        echo "<li>notes : " . $this->getNotes() . "</li>";
        echo "<li>nom Host : " . $this->getHost()->getName() . "</li>";
        echo "<li>nom Customer : " . $this->getCustomer()->getName() . "</li>";
        echo "</ul>";
    }
}