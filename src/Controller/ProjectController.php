<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Project;
use App\Repository\ProjectRepository;

final class HomeController extends AbstractController
{

    #[Route(path:"/Projects", name: "projects")]
    public  function projects(): Response
    {
        return $this->render('home/projects.html.twig',[
            'projects' => ProjectRepository::listproject(),
        ]);
    }

    #[Route(path:"/CreateProject", name:"project", methods: ['GET'])]
    public function createProject(string $slug): Response
    {
        return $this->render('CreateProject./Project.html.twig', ["project" => ProjectRepository::getProject($slug)]);
    }

    #[Route(path:"/UpdateProject{slug}", name:"project", methods: ['GET'])]
    public function updateProject(string $slug): Response
    {
        if (ProjectRepository::isProject($slug)) {
            return $this->render('UpdateProject./Project.html.twig', ["project" => ProjectRepository::getProject($slug)]);
        }

        throw new NotFoundHttpException(sprintf('client avec slug %s non trouvé.', $slug));
    }

    #[Route(path:"/DeleteProject{slug}", name:"project", methods: ['GET'])]
    public function deleteProject(string $slug): Response
    {
        if (ProjectRepository::isProject($slug)) {
            return $this->render('CreateProject./Project.html.twig', ["project" => ProjectRepository::getProject($slug)]);
        }

        throw new NotFoundHttpException(sprintf('client avec slug %s non trouvé.', $slug));
    }

}
