<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class CoreController 
{
    /**
     * Fonction qui permet d'afficher la vue
     * $viewData = les données que je veux récupérer dans ma vue
     */
    public function show($viewName, $viewData = [])
    {
        $absoluteURL = $_SERVER['BASE_URI'];
        global $router;
        // $typeModel = new Type();
        // $types = $typeModel->findAll();

        // // Ci dessous on va créer un tableau qui sera ue "copie" de $types (liste des types)
        // // Grace a ce tableau on pourra piocher facilement dans les types de produits
        // // Par ex, si on veut afficher le type 7 on afficher le $type[7]
        // // Pour faire simple dans ce tableau, les index seront = aux id
        // foreach($types as $elem) {
        //     $typeListById[$elem->getId()] = $elem;
        // }
        // dump($typeListById);
        // Ci dessous je créer une instance du model Category
        $categoryModel = new Category();
        // Ci dessous j'execute la methode findAll pour récupérer toutes les categories depuis la bdd
        $categories = $categoryModel->findAll();
        $viewData['categories'] = $categories;

        $brandModel = new Brand();
        // Ci dessous j'execute la methode findAll pour récupérer toutes les categories depuis la bdd
        $brands = $brandModel->findAll();
        $viewData['brands'] = $brands;

        $typeModel = new Type();
        // Ci dessous j'execute la methode findAll pour récupérer toutes les categories depuis la bdd
        $types = $typeModel->findAll();
        $viewData['types'] = $types;
        // dump($categories);
        // $brandModel = new Brand();
        // // Ci dessous j'execute la methode findAll pour récupérer toutes les categories depuis la bdd
        // $brands = $brandModel->findAll();

        require_once __DIR__ . "/../views/partials/header.tpl.php";
        require_once __DIR__ . "/../views/$viewName.tpl.php";
        require_once __DIR__ . "/../views/partials/footer.tpl.php";
    }
}