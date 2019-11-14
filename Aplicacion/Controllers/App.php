<?php
/**
 * Controlador Padre
 * aqui va toda la logica en comun que necesiten
 *  los controladores que extienden de el
 */

namespace App\Controllers;

use App\Modelos\ApiAuth;
use Jida\Core\Controlador\Control;
use Jida\Manager\Estructura;

class App extends Control {

    static private $_ce = 100;
    public $requestMethod;

    public function __construct() {

        parent::__construct();

        $this->layout('principal');

        $this->requestMethod = Estructura::$requestMethod;

        if (!$this->request('access_token')) {
            return $this->sendResponseError(1, 'access_token');
        }

        $apiAuth = new ApiAuth();
        $response = $apiAuth->checkToken($this->request('access_token'));

        if ($response['status'] === 'error') {
            return $this->sendResponseError(2, 'Invalid token or not validated.');
        }

    }

    public function sendResponseError($value = null, $param = null) {
//
//        $data = [
//            'status'  => 'error',
//            'code'    => self::$_ce . $value,
//            'message' => 'Missing required param: ' . $param
//        ];
//        return $this->respuestaJson($data);
        $this->_404();
    }

}
