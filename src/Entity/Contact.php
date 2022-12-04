<?php

namespace App\Entity;

use App\Repository\ContactRepostory;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Host;
use Customer;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Contact implements AllInterface{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column(length: 255)]
    private string $email; 
    #[ORM\Column(length: 10)]
    private string $phoneNumber;
    #[ORM\Column(type: bool)]
    private string $role;
    #[ORM\Column(type: int)]
    private Host $host;
    #[ORM\Column(type: int)]
    private Customer $customer;

    public function __construct(int $id, string $email, string $phoneNumber, string $role, Host $host, Customer $customer)
    {
        $this->id = $id;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->role = $role;
        $this->host = $host;
        $this->customer = $customer;
    }

    public function getEmail () : string{
        return $this ->email;
    }

    public function getPhoneNumber () : string{
        return $this ->phoneNumber;
    }

    public function getRole () : string{
        return $this ->role;
    }

    public function getHost () : Host{
        return $this ->host;
    }

    public function getCustomer () : Customer{
        return $this ->customer;
    }

    public function setEmail (string $email): void{
        $this->email = $email;
    }

    public function setPhoneNumber (string $phoneNumber): void{
        $this->phoneNumber = $phoneNumber;
    }

    public function setRole (string $role): void{
        $this->role = $role;
    }

    public function setHost (Host $host): void{
        $this->host = $host;
    }

    public function setCustomer (Customer $customer): void{
        $this->customer = $customer;
    }

    public function echoAll (){

        echo "<h2> Contact : </h2>";
        echo "<ul>";
        echo "<li>id : " . $this->getId() . "</li>";
        echo "<li>email : " . $this->getEmail() . "</li>";
        echo "<li>numéro téléphone : " . $this->getPhoneNumber() . "</li>";
        echo "<li>role : " . $this->getRole() . "</li>";
        echo "<li>nom Host : " . $this->getHost()->getName() . "</li>";
        echo "<li>nom Customer : " . $this->getCustomer()->getName() . "</li>";
        echo "</ul>";
        echo "<br>";

    }
    
}
