<?php
    require('config.php');
    require('app/model/app_model.php');
    require('app/controller/app_controller.php');

    if (!isset($_GET['module'])) {
        $_GET['module'] = 'user';
    }
 
    if (isset($_GET['module'])) {

         //preluam modulul cerut
         $module = htmlentities($_GET['module']);

          //includem modelul 
         if (file_exists(MODEL.$module.'_model.php')) {
            include_once (MODEL.$module.'_model.php');
         } else{
            die (MODEL.$module.'_model.php Nu exista');
         }

         //includem modelul 
         if (file_exists(CONTROLLER.$module.'_controller.php')) {
            include_once (CONTROLLER.$module.'_controller.php');
         } else{
            die (CONTROLLER.$module.'_controller.php Nu exista');
         }
    } 

    if (isset($_GET['module'])  &&  isset($_GET['action']) ) {
              $action = htmlentities($_GET['action']);
    } else {
           $action  = 'index';
    } 
    //creem un obiect pentru  controller sii model
    $module = ucfirst($module);
    $controller = $module.'Controller';
    try {
         $ObjController  = new  $controller;
    } catch (Exception $e) {
        die($e->getMessage());
    }
    try {
        $ObjModel =   new $module;
    }  catch (Exception $e) {
        die($e->getMessage());
    }
    try {
        $ObjController->model_obj($module,$ObjModel);
    } catch (Exception $e) {
        die($e->getMessage());
    }
    try {
         $ObjController->$action();
    } catch (Exception $e) {
        die($e->getMessage());
    }
    $value = $ObjController ->getvar();
    ${$value['name']} = $value['value'];

    //preluam continutul din view
    $content = file_get_contents(VIEW.strtolower($module)."/".$action);
    //preluam tremplateul
    $template = file_get_contents(TEMPLATE);
    eval("\$content = \"$content\";");
    $tema = str_replace("{CONTINUT}",$content,$template);

   print $tema;

?>