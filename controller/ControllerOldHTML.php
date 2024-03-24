<?php

class ControllerOldHTML
{
    public static function printContact(){
    $controller ='oldHTML';
    $view='contact';
    $pagetitle='Contact';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printEquipe(){
    $controller ='oldHTML';
    $view='equipe';
    $pagetitle='Equipe';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printFAQ(){
    $controller ='oldHTML';
    $view='faq';
    $pagetitle='FAQ';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printMetier1(){
    $controller ='oldHTML';
    $view='metier1';
    $pagetitle='Metier1';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printMetier2(){
    $controller ='oldHTML';
    $view='metier2';
    $pagetitle='Metier2';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printMetier3(){
    $controller ='oldHTML';
    $view='metier3';
    $pagetitle='Metier3';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printProduit(){
    $controller ='oldHTML';
    $view='produit';
    $pagetitle='Produit';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printRejoindre(){
    $controller ='oldHTML';
    $view='rejoindre';
    $pagetitle='Rejoindre';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function printPresse(){
    $controller ='oldHTML';
    $view='presse';
    $pagetitle='Presse';
    require_once (File::build_path(array('view','view.php')));
    }

    public static function error()
    {
        $controller = 'erreur';
        $view = 'erreur';
        $pagetitle='ALEDWSH';
        require_once File::build_path(array('view','view.php'));
    }
}
?>