<?php

/**
 * Created by PhpStorm.
 * User: bzgras
 * Date: 13.07.2016
 * Time: 07:32
 */
class Dispatcher
{
    /**
     * Diese Methode wertet die Request URI aus leitet die Anfrage entsprechend
     * weiter.
     */
    public static function dispatch()
    {
        // Die URI wird aus dem $_SERVER Array ausgelesen und in ihre
        //   Einzelteile zerlegt.
        // /user/index/foo --> ['user', 'index', 'foo']
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?'); // Erstes ? und alles danach abschneiden
        $uri = trim($uri, '/'); // Alle / am anfang und am Ende der URI abschneiden
        $uriFragments = explode('/', $uri); // In einzelteile zerlegen
        // Den Namen des gewünschten Controllers ermitteln
        $controllerName = 'DefaultController';
        if (!empty($uriFragments[0])) {
            $controllerName = $uriFragments[0];
            $controllerName = ucfirst($controllerName); // Erstes Zeichen grossschreiben
            $controllerName .= 'Controller'; // "Controller" anhängen
        }
        // Den Namen der auszuführenden Methode ermitteln
        $method = 'index';
        if (!empty($uriFragments[1])) {
            $method = $uriFragments[1];
        }
        $args = array_slice($uriFragments, 2);
        // Den gewünschten Controller laden
        //   Achtung! Hier stützt PHP ab, sollte der Controller nicht existieren
        require_once "controller/$controllerName.php";
        // Eine neue Instanz des Controllers wird erstellt und die gewünschte
        //   Methode darauf aufgerufen.
        $controller = new $controllerName();
        $controller->$method();
    }
}