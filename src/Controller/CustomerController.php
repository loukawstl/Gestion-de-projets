<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Article;
use App\Repository\ArticleRepository;

final class HomeController extends AbstractController
{

    #[Route(path:"/Customers", name: "customers")]
    public  function customers(): Response
    {
        return $this->render('home/customers.html.twig',[
            'customers' => CustomerRepository::listCustomer(),
        ]);
    }

    #[Route(path:"/CreateCustomer", name:"customer", methods: ['GET'])]
    public function createCustomer(string $slug): Response
    {
        return $this->render('CreateCustomer./Customer.html.twig', ["customer" => CustomerRepository::getCustomer($slug)]);
    }

    #[Route(path:"/UpdateCustomer{slug}", name:"customer", methods: ['GET'])]
    public function updateCustomer(string $slug): Response
    {
        if (CustomerRepository::isCustomer($slug)) {
            return $this->render('UpdateCustomer./Customer.html.twig', ["customer" => CustomerRepository::getCustomer($slug)]);
        }

        throw new NotFoundHttpException(sprintf('client avec slug %s non trouvé.', $slug));
    }

    #[Route(path:"/DeleteCustomer{slug}", name:"customer", methods: ['GET'])]
    public function deleteCustomer(string $slug): Response
    {
        if (CustomerRepository::isCustomer($slug)) {
            return $this->render('CreateCustomer./Customer.html.twig', ["customer" => CustomerRepository::getCustomer($slug)]);
        }

        throw new NotFoundHttpException(sprintf('client avec slug %s non trouvé.', $slug));
    }

}