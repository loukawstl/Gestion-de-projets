<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\CustomerRepository;

final class CustomerController extends AbstractController
{
    #[Route(path:"/customers", name:"customers")]
    public function customers():Response
    {
        return $this->render('Customer/Customers.html.twig',[
            'customers'=> CustomerRepository::getAllCustomers(),
        ]);
    }

    #[Route(path:"/customer/{slug}", name:"customer", methods:['GET'])]
    public function customer(string $slug):Response
    {
        if (CustomerRepository::isCustomer($slug)) {

            return $this->render('Customer/Customer.html.twig', [
                "customer"=> CustomerRepository::getCustomer($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Customer with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/deleteCustomer/{slug}", name:"deletecustomer", methods:['GET'])]
    public function deleteCustomer(string $slug):Response
    {
        if (CustomerRepository::isCustomer($slug)) {

            return $this->render('Customer/DeleteCustomer.html.twig', [
                "customer"=> CustomerRepository::getCustomer($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Customer with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/updateCustomer/{slug}", name:"updatecustomer", methods:['GET'])]
    public function updateCustomer(string $slug):Response
    {
        if (CustomerRepository::isCustomer($slug)) {

            return $this->render('Customer/UpdateCustomer.html.twig', [
                "customer"=> CustomerRepository::getCustomer($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Customer with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/insertCustomer/{slug}", name:"insertcustomer", methods:['GET'])]
    public function insertCustomer(string $slug):Response
    {
        if (CustomerRepository::isCustomer($slug)) {

            return $this->render('Customer/InsertCustomer.html.twig', [
                "customer"=> CustomerRepository::getCustomer($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Customer with slug %s dosent exists.', $slug));
    }


}
