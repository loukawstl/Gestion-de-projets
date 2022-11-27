<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\HostRepository;

final class HostController extends AbstractController
{
    #[Route(path:"/hosts", name:"hosts")]
    public function hosts():Response
    {
        return $this->render('Host/Hosts.html.twig',[
            'hosts'=> HostRepository::getAllHosts(),
        ]);
    }

    #[Route(path:"/host/{slug}", name:"host", methods:['GET'])]
    public function host(string $slug):Response
    {
        if (HostRepository::isHost($slug)) {

            return $this->render('Host/Host.html.twig', [
                "host"=> HostRepository::getHost($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Host with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/deleteHost/{slug}", name:"deleteHost", methods:['GET'])]
    public function deleteHost(string $slug):Response
    {
        if (HostRepository::isHost($slug)) {

            return $this->render('Host/DeleteHost.html.twig', [
                "host"=> HostRepository::getHost($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Host with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/updateHost/{slug}", name:"updatehost", methods:['GET'])]
    public function updateHost(string $slug):Response
    {
        if (HostRepository::isHost($slug)) {

            return $this->render('Host/UpdateHost.html.twig', [
                "host"=> HostRepository::getHost($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Host with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/insertHost/{slug}", name:"inserthost", methods:['GET'])]
    public function insertHost(string $slug):Response
    {
        if (HostRepository::isHost($slug)) {

            return $this->render('Host/InsertHost.html.twig', [
                "host"=> HostRepository::getHost($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Host with slug %s dosent exists.', $slug));
    }


}
