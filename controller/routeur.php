<?php
require_once File::build_path(array("controller", "ControllerBouteille.php"));
require_once File::build_path(array("controller", "ControllerCommande.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerOldHTML.php"));

// On recupère l'action passée dans l'URL
/*
$all_classes = get_declared_classes();
$controller="ControllerBouteille";
$action="acceuil";

if(isset($_GET["controller"])){
	$controller = "Controller".ucfirst($_GET['controller']);
		if(!in_array($controller, $all_classes)){
			$controller = "ControllerBouteille";
			$action = "erreur";
		}
}

$tab_methode = get_class_methods($controller);
if(isset($_GET["action"])){
		if(in_array($_GET['action'], $tab_methode)){
			$action = $_GET['action'];}
		else {
			$controller = "ControllerBouteille";
			$action = "erreur";
		}
}
*/


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = "acceuil";
}

if (isset($_GET['controller'])) {
    $controller = 'Controller' .$_GET['controller'];
} else if (isset($_POST['controller'])) {
    $controller = 'Controller' .$_POST['controller'];
} else {
    $controller = 'ControllerBouteille';
}

if (in_array($action, get_class_methods($controller), false)) {
     $controller::$action();
}else{
    $controller = "ControllerBouteille";
    $action = "error";
    $controller::$action();
}


// Appel de la méthode statique $action de ControllerBouteille


?>
