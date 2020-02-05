<?php

namespace App;

//route for each page

class Controller
{
    public function accueil()
    {
        $this->render('accueil.php');
    }

    public function produits()
    {
        $this->render('produits.php');
    }

    public function blog()
    {
        $this->render('blog.php');
    }

    public function contact()
    {
        $this->render('contact.php');
    }

    public function about()
    {
        $this->render('about.php');
    }

    public function page404()
    {
        $this->render('404.php');
    }

    private function render($template,$params=null)
    {
        //transforme le tableau $params en variables portant le nom des clés du tableau
        //ces variables sont disponibles dans la vue
        if($params != null)
        {
            extract($params);
        }
        
        include COMPONENTS.'/template.php';
    }
}

?>