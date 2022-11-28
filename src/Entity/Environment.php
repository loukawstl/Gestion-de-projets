<?php
namespace App\Classes;

use Project;
class Environment implements AllInterface{

    /*use HasId;
    use HasName;*/

    private int $id; 
    private string $name;
    private string $link;
    private string $ipAdress;
    private string $ssPort;
    private string $sshUsername;
    private string $phpmyadminLink;
    private bool $ipRestriction;
    private Project $project;


    public function __construct(int $id, string $name, string $link, string $ipAdress, string $sshPort, string $sshUsername, string $phpmyadminLink, bool $ipRestriction, Project $project)
    {
        $this->id = $id;
        $this->name = $name;
        $this->link = $link;
        $this->ipAdress = $ipAdress;
        $this->sshPort = $sshPort;
        $this->sshUsername = $sshUsername;
        $this->phpmyadminLink = $phpmyadminLink;
        $this->ipRestriction = $ipRestriction;
        $this->project = $project;
    }

    public function getLink () : string{
        return $this ->link;
    }

    public function getIpAdress () : string{
        return $this ->ipAdress;
    }

    public function getSshPort () : string{
        return $this ->sshPort;
    }

    public function getSshUsername () : string{
        return $this ->sshUsername;
    }

    public function getPhpmyadminLink () : string{
        return $this ->phpmyadminLink;
    }

    public function getIpRestriction () : string{
        return $this ->ipRestriction;
    }

    public function getProject () : Project {
        return $this->project;
    }
    
    public function setLink (string $link): void{
        $this->link = $link;
    }

    public function setIpAdress (string $ipAdress): void{
        $this->ipAdress = $ip_adress;
    }

    public function setSshPort (string $sshPort): void{
        $this->sshPort = $sshPort;
    }

    public function setSshUsername (string $sshUsername): void{
        $this->sshUsername = $sshUsername;
    }

    public function setPhpmyadminLink (string $phpmyadminLink): void{
        $this->phpmyadminLink = $phpmyadminLink;
    }

    public function setIpRestriction (bool $ipRestriction): void{
        $this->ipRestriction = $ipRestriction;
    }

    public function setProject (Project $project): void{
        $this->project = $project;
    }

    public function echoAll(){
        echo "<h2> Environment : </h2>";
        echo "<ul>";
        echo "<li>id : " . $this->getId() . "</li>";
        echo "<li>lien : " . $this->getLink() . "</li>";
        echo "<li>adresse ip : " . $this->getIpAdress() . "</li>";
        echo "<li>port ssh : " . $this->getSshPort() . "</li>";
        echo "<li>pseudo ssh : " . $this->getSshUsername() . "</li>";
        echo "<li>lien phpmyadmin : " . $this->getPhpmyadminLink() . "</li>";
        echo "<li>restriction adresse ip (bool) : " . $this->getIpRestriction() . "</li>";
        echo "<li>code projet : " . $this->getProject()->getCode() . "</li>";
        echo "</ul>";
    }
    
}
