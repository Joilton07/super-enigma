<?php
    require_once "vendor/autoload.php";

    use Slim\App;
    use Slim\Container;
    use Config\RotasConfig;

    $app = new App(new Container([
        "settings" => [
            "displayErrorDetails" => true
        ]
    ]));

    RotasConfig::getInstancies($app);

    $app->run();