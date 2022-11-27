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

    #[Route(path:"/articles", name: "articles")]
    public  function articles(): Response
    {
        return $this->render('home/articles.html.twig',[
            'articles' => ArticleRepository::getAllArticles(),
        ]);
    }

    #[Route(path:"/article/{slug}", name:"article", methods: ['GET'])]
    public function article(string $slug): Response
    {
        if (ArticleRepository::isArticle($slug)) {
            return $this->render('home/article.html.twig' , [
                "article"=> ArticleRepository::getArticle($slug),
            ]);
        }

        throw new NotFoundHttpException(sprintf('the Article with slug %s dosent exists.', $slug));
    }

    #[Route(path:"/", name: 'home')]
    public function home(Request $request): Response
    {
        $firstname = $request->query->get('prenom');

        return $this->render('home/home.html.twig', [
            'name' => $firstname,
        ]);
    }

    // #[Route(path: '/presentation/{firstname}', methods: ['GET'])]
    // public function show (string $firstname): Response
    // {
    //     dd($firstname);
    // }
}