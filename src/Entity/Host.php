<?php
namespace App\Classes;
/*se App\Connection\Connection;
use App\Interfaces\AllInterface;
use App\Traits\HasId;
use App\Traits\HasName;
use App\Traits\HasNotes;
use App\Traits\HasCode;*/

class Host implements AllInterface{

    /*use HasId;
    use HasName;
    use HasNotes;
    use HasCode;*/

    private int $id;
    private string $code;
    private string $name;
    private string $notes;
    
    public function __construct(int $id, string $code, string $name, string $notes){   
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->notes = $notes;
    }

    public function echoAll(){
        echo "<h2> Host : </h2>";
    echo "<ul>";
    echo "<li>id : " . $this->getId() . "</li>";
    echo "<li>code : " . $this->getCode() . "</li>";
    echo "<li>nom : " . $this->getName() . "</li>";
    echo "<li>notes : " . $this->getNotes() . "</li>";
    echo "</ul>";
    }
    
}

?>
