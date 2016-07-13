<?php
/**
 * Created by PhpStorm.
 * User: bzgras
 * Date: 13.07.2016
 * Time: 07:31
 */


require_once 'lib/Dispatcher.php';
require_once 'lib/View.php';
require_once 'lib/Model.php';
$dispatcher = new Dispatcher();
$dispatcher->dispatch();