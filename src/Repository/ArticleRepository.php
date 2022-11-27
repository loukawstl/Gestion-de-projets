<?php

namespace App\Repository;

use App\Entity\Article;

class ArticleRepository{

    private const ARTICLES = [ "test-test-test"=>[ 'desc' => "un test"], "test-2"=>[ 'desc' => "un tfqfqfqest"]];
    
    public static function getAllArticles(): array{
        return ArticleRepository::ARTICLES;
    }

    public static function isArticle(): bool{
        if (isset(self::ARTICLES[$slug])){
            return true;
        }
        return false;
    }

    public static function getArticle(string $slug): array
    {
        return ArticleRepository::ARTICLES[$slug];
    }

}