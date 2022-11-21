<?php
namespace App\Classes;
use App\Connection\Connection;
use App\Interfaces\AllInterface;
use App\Traits\HasId;
use App\Traits\HasName;
use App\Traits\HasNotes;
use App\Traits\HasCode;


class Customer implements AllInterface{

    use HasId;
    use HasName;
    use HasNotes;
    use HasCode;

    private int $id;
    private string $code; 
    private string $name;
    private string $notes;

    public function __construct(int $id, string $code, string $name, string $notes)
    {
        $this-> id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->notes = $notes;
    }

    public function echoAll(){
        echo "<h2> Customer : </h2>";
        echo "<ul>";
        echo "<li>Id: " . $this->getId() . "</li>";
        echo "<li>Code: " . $this->getCode() . "</li>";
        echo "<li>Name: " . $this->getName() . "</li>";
        echo "<li>Notes: " . $this->getNotes() . "</li>";
        echo "</ul>";
    }
}
