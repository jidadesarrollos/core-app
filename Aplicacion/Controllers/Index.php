<?php

namespace App\Controllers;

use Jida\Medios\Arrays;
use Jida\Medios\Debug;
use MercadoPago as MercadoPago;
use App\Modelos\ApiGraphs;

require_once 'vendor/autoload.php';

const PUBLIC_KEY = 'TEST-e4289df6-a3da-4adb-85da-6f832cddd884';
const ACCESS_TOKEN = 'TEST-409334675311299-102919-067bca712e38d9d87b5c7d05f3299f7c-341398051';

class Index extends App {

    function index() {

        if (!$this->get('order_id')) {
            return $this->sendResponseError(3, 'order_id');
        }

        $apiGraphs = new ApiGraphs();

        $order = $this->checkStatus();

        if (!$order) return $order;

        $ids = $apiGraphs->getIds($order->id);
        $products = $apiGraphs->getProducts($order->id, $ids);
        MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
        $preference = new MercadoPago\Preference();

        $items = [];
        foreach ($products as $product) {

            $item = new MercadoPago\Item();
            $item->title = $product['document']['name'];
            $item->unit_price = $product['document']['price'];
            $item->quantity = $product['document']['quantity'];

            array_push($items, $item);

        }

        $preference->items = $items;
        $preference->save();

        $this->data(
            ['products'   => $items,
             'preference' => $preference,
             'orderId'    => $this->get('order_id'),
             'token'      => $this->get('access_token')
            ]
        );

    }

    function finished() {

        if (!$this->get('order_id')) {
            return $this->sendResponseError(3, 'order_id');
        }

        $order = $this->checkStatus();

        if ($order) {
            $apiGraphs = new ApiGraphs();
            $apiGraphs->setStatus($order->id, $this->get('access_token'));
        }

    }

    private function checkStatus() {

        $apiGraphs = new ApiGraphs();
        $order = $apiGraphs->getOrder($this->get('order_id'));
        $order = Arrays::convertirAObjeto($order);

        if ($order->document->status !== 2) {
            $this->vista = 'order-closed';
            return false;
        }

        return $order;

    }

}
