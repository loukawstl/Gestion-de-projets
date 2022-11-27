<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Host;
use App\Repository\HostRepository;

final class HomeController extends AbstractController
{

    #[Route(path:"/Hosts", name: "hosts")]
    public  function hosts(): Response
    {
        return $this->render('home/hosts.html.twig',[
            'hosts' => HostRepository::listHost(),
        ]);
    }

    #[Route(path:"/CreateHost", name:"host", methods: ['GET'])]
    public function createHost(string $slug): Response
    {
        return $this->render('CreateHost./Host.html.twig', ["host" => HostRepository::getHost($slug)]);
    }

    #[Route(path:"/UpdateHost{slug}", name:"host", methods: ['GET'])]
    public function updateHost(string $slug): Response
    {
        if (HostRepository::isHost($slug)) {
            return $this->render('UpdateHost./Host.html.twig', ["host" => HostRepository::getHost($slug)]);
        }

        throw new NotFoundHttpException(sprintf('client avec slug %s non trouvé.', $slug));
    }

    #[Route(path:"/DeleteHost{slug}", name:"host", methods: ['GET'])]
    public function deleteHost(string $slug): Response
    {
        if (HostRepository::isHost($slug)) {
            return $this->render('CreateHost./Host.html.twig', ["host" => HostRepository::getHost($slug)]);
        }

        throw new NotFoundHttpException(sprintf('client avec slug %s non trouvé.', $slug));
    }

}
