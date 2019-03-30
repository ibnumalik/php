<?php

use App\Core\App;

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();

// Load all config to the app
App::bind('config', require 'config.php');

// Start query builder and bind the class to QB
new \Pixie\Connection('mysql', App::get('config')['database'], 'QB');

// @TODO extract to helper
function view($name, $val = [])
{
    extract($val);
    return require "views/{$name}.views.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}
