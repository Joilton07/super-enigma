<?php

    namespace Config;

    use Slim\App;
    use Controller\V1\MainController;

    final class RotasConfig
    {
        private static RotasConfig $RConfig;
        private App $app;

        private function __construct(App $app) {
            $this->app = $app;
            $this->initRotas();
        }

        public static function getInstancies(App $app)
        {
            if(empty(self::$RConfig)){
                self::$RConfig = new RotasConfig($app);
            }
            return self::$RConfig;
        }

        public function initRotas()
        {
            $appM = $this->app;
            $appM->group("/v1", function ($appM)
            {
                $appM->get("/", array(MainController::class, "status"));
                $appM->post("/maior", array(MainController::class, "maior"));
                $appM->get("/parImpar/{valor:[0-9.]+}", array(MainController::class, "parImpar"));
                $appM->group("/ordenar", function($appM){
                    $appM->post("/crescente", array(MainController::class , "ordenarCrescente"));
                    $appM->post("/decrescente", array(MainController::class , "ordenarDecrescente"));
                });
            });
        }
    }
    