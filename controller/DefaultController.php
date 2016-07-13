<?php
/**
 * Created by PhpStorm.
 * User: bzgras
 * Date: 13.07.2016
 * Time: 07:47
 */

class DefaultController
{
    /**
     * Die index Funktion des DefaultControllers sollte in jedem Projekt
     * existieren, da diese ausgeführt wird, falls die URI des Requests leer
     * ist. (z.B. http://mvc.local/). Weshalb das so ist, ist und wann welchr
     * Controller und welche Methode aufgerufen wird, ist im Dispatcher
     * beschrieben.
     */
    public function index()
    {
        $view = new View('main_gallery');
        $view->title = 'Hauptseite | ';
        $view->heading = 'Startseite';
        $view->display();
    }
}