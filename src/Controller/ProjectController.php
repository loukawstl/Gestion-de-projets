<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ProjectRepository;

final class ProjectController extends AbstractController
{
    #[Route(path:"/projects", name:"projects")]
    public function projects():Response
    {
        return $this->render('Project/Projects.html.twig',[
            'projects'=> ProjectRepository::getAllProjects(),
        ]);
    }

    #[Route(path:"/project/{slug}", name:"project", methods:['GET'])]
    public function project(string $slug):Response
    {
        if (ProjectRepository::isProject($slug)) {

            return $this->render('Project/Project.html.twig', [
                "project"=> ProjectRepository::getProject($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Project with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/deleteProject/{slug}", name:"deleteproject", methods:['GET'])]
    public function deleteProject(string $slug):Response
    {
        if (ProjectRepository::isProject($slug)) {

            return $this->render('Project/DeleteProject.html.twig', [
                "project"=> ProjectRepository::getProject($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Project with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/updateProject/{slug}", name:"updateproject", methods:['GET'])]
    public function updateProject(string $slug):Response
    {
        if (ProjectRepository::isProject($slug)) {

            return $this->render('Project/UpdateProject.html.twig', [
                "project"=> ProjectRepository::getProject($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Project with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/insertProject/{slug}", name:"insertproject", methods:['GET'])]
    public function insertProject(string $slug):Response
    {
        if (ProjectRepository::isProject($slug)) {

            return $this->render('Project/InsertProject.html.twig', [
                "project"=> ProjectRepository::getProject($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Project with slug %s dosent exists.', $slug));
    }


}
