<?php

namespace App;

//route for each page

class Controller
{
    public function produits()
    {
        $this->render('produits.php');
    }

    public function about()
    {
        $this->render('about.php');
    }

    public function settings()
    {
        $this->render('settings.php');
    }

    public function history()
    {
        $this->render('history.php');
    }

    public function tracking()
    {
        $this->render('tracking.php');
    }

    public function update()
    {
        $this->render('update.php');
    }

    public function panier()
    {
        $this->render('panier.php');
    }

    public function page404()
    {
        $this->render('page404.php');
    }

    public function checkout()
    {
        $this->render('checkout.php');
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