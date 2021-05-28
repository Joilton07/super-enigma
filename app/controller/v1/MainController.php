<?php

    namespace Controller\V1;

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    final class MainController
    {   
        /** @api {GET} /v1/ Status
         * 
         * @apiVersion  1.0.0
         * @apiDescription Método retorna uma string
         * 
         * @apiGroup Status
         * 
         * @apiSuccess (200) {json} status Informando que esta no sistema
         * @apiSuccessExample {json} Success-Response:
         *      {
         *          "status": "OK"
         *      }
         * 
         */
        public static function status(Request $req, Response $res, array $args)
        {
            return $res->withJson([
                "status" => "OK"
            ]);
        }

        /** @api {POST} v1/maior O numero maior!
         * @apiVersion  1.0.0
         * 
         * @apiDescription Metodo verifica qual é o numero maior.
         * 
         * @apiGroup Math
         * 
         * @apiParam  {Integer} Numeros Informar um array de numeros.
         * @apiParamExample  {JSON} Request-Example:
         *      HTTP/1.1 200 OK
         *      [
         *          -1,
         *          -27,
         *          -7
         *      ]
         * 
         * @apiSuccess (200) {Integer} Maior O valor maior.
         * @apiSuccessExample {JSON} Success-Response:
         *      {
         *          "O numero maior é": -1
         *      }
         * 
         * @apiError (404) {String} Error Os numeros não foi informados.
         * @apiErrorExample {type} Error-Response:
         *      HTTP/1.1 404 Not Found
         *      {
         *          "erro": "Não foi informado os numeros!"
         *      }
         *  
         */
        public static function maior(Request $req, Response $res, array $args)
        {

            $dadosReq = $req->getParsedBody();
            $maior = null;


            if (!empty($dadosReq)){
                
                for ($i=0; $i < count($dadosReq); $i++) { 
                    if ($dadosReq[$i] > $maior) {
                        $maior = $dadosReq[$i];
                    }
                }

                return $res->withJson([
                    "O numero maior é" => $maior
                ]);
            } else {

                return $res->withJson([
                    "erro" => "Não foi informado os numeros!"
                ], 404);

            }
        }

        /** @api {GET} v1/parImpar/:valor Impar ou Par
         * 
         * @apiVersion  1.0.0
         * @apiDescription Método verifica se o valor é impar ou par
         *
         * @apiGroup Math
         * 
         * @apiParam  {Integer} numero
         * @apiParamExample  {url} Request-Example:
         *    http://localhost/super-enigma/v1/parImpar/7
         * 
         * @apiSuccess (200) {JSON} Resultado Informando se é par ou impar
         * @apiSuccessExample {JSON} Success-Response:
         *      {
         *          "Resultado": "Impar"
         *      }
         * 
         * @apiError (404) {String} erro Não informou um numero
         * @apiErrorExample {HTML} Error-Response:
         *      Page Not Found
         *      The page you are looking for could not be found. Check the address bar to ensure your URL is spelled correctly. If all else fails, you can visit our home page at the link below.
         *   
         *      Visit the Home Page
         */
        public static function parImpar(Request $req, Response $res, array $args)
        {

            if($args["valor"] % 2 == 0){
                $resultado = "Par";
            }else {
                $resultado = "Impar";
            }

            return $res->withJson([
                "Resultado" => $resultado
            ]);
            
        }

        /** @api {POST} v1/ordenar/crescente Ordenar Cresente
         * @apiVersion  1.0.0
         * @apiDescription Ordenar os numeros informadas do menor para o maior.
         * 
         * @apiGroup V1/Ordenar
         * 
         * @apiParam  {Array} Numeros Informa uma array de numeros
         * @apiParamExample  {JSON} Request-Example:
         *      HTTP/1.1 200 OK
         *      [
         *	        4,
	     *          2,
	     *          7
         *      ]  
         * 
         * @apiSuccess (200) {Array} Resultado Os numeros ordenados em ordem crescente.
         * @apiSuccessExample {JSON} Success-Response:
         *      HTTP/1.1 200 OK
         *      {
         *          "1": 2,
         *          "0": 4,
         *          "2": 7   
         *      }
         * @apiError (404) error Não informou o array de numeros.      
         * @apiErrorExample {String} Error-Response:
         *      HTTP/1.1 404 Not Found
         *      {
         *          "erro": "Não foi informado os numeros!"
         *      }
         *        
         */
        public static function ordenarCrescente(Request $req, Response $res, array $args)
        {

            $dadosReq = $req->getParsedBody();

            if(!empty($dadosReq)){
                asort($dadosReq);

                return $res->withJson($dadosReq);
            } else {

                return $res->withJson([
                    "erro" => "Não foi informado os numeros!"
                ], 404);    
                
            }
        }

        /** @api {POST} v1/ordenar/decresente Ordenar Decresente 
         * 
         * @apiVersion  1.0.0
         * @apiDescription Ordenar os numeros em ordem decresente
         * 
         * @apiGroup V1/Ordenar
         * 
         * @apiParam  {Array} Numeros Informa um array de numeros
         * @apiParamExample  {JSON} Request-Example:
         *      [
         *          4,
         *          7,
         *          6
         *      ]
         * 
         * @apiSuccess (200) {JSON} Numeros Os numeros ordenados em ordem decresente
         * @apiSuccessExample {JSON} Success-Response:
         *    HTTP/1.1 200 OK
         *      {
         *          4,
         *          7,
         *          6
         *      }
         * 
         * @apiError (404) error Não informou os numeros
         * @apiErrorExample {HTML} Error-Response:
         *      HTTP/1.1 404 Not Found
         *      {
         *          "erro": "Não foi informado os numeros!"
         *      }
         *   
        */
        public static function ordenarDecrescente(Request $req, Response $res, array $args)
        {

            $dadosReq = $req->getParsedBody();

            if (!empty($dadosReq)){

                arsort($dadosReq);
    
                return $res->withJson($dadosReq);

            } else {

                return $res->withJson([
                    "erro" => "Não foi informado os numeros!"
                ], 404);

            }
        }
    }
    