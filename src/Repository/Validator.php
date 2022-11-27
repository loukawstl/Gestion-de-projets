<?php
namespace App\Validators;

use Respect\Validation\Validator as v;
use Cocur\Slugify\Slugify as s;

//utilisation de la bibliothèque Respect/Validation et Cocur\Slugify
// https://github.com/Respect/Validation
// https://github.com/cocur/slugify

abstract class Validator{

    public static function checkEmpty(string $data) : bool{
        if (!(v::notBlank()->validate($data))){
            return true;
        }
        else{
            return false;
        }
    }

    //utilisé pour code, transforme un string en "slug"
    public static function SlugifyData(string $data): string{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $s = new s();
        $s->activateRuleSet('french');
        $data = $s->slugify($data);
        return $data;
    }

    //enlève /, balises, etc
    public static function trimData(string $data): string{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //vérifie sur $data ne contient pas plus de 250 caractères
    public static function checkLength255(string $data): bool{
        if (!(v::stringType()->length(null, 255)->validate($data))){
            return true;
        }
        else{
            return false;
        }
    }

    //vérifie sur $data ne contient pas plus de 1000 caractères
    public static function checkLength1000(string $data): bool{
        if (!(v::stringType()->length(null, 1000)->validate($data))){
            return true;
        }
        else{
            return false;
        }
    }

}
