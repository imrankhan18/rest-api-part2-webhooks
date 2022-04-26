<?php
require_once '../../vendor/autoload.php';

use Phalcon\Mvc\Controller;
use GuzzleHttp\Client;
use Phalcon\Http\Response;



class TestapiController extends Controller
{
    public function indexAction()
    {
    }
    /**
     * test api by adding  order
     *
     * @return void
     */
    public function orderAction()
    {
        $order = $this->request->getQuery();
        $url = "http://192.168.2.55:8080/";
        $client = new Client(
            [


                'base_uri' => $url,
                'headers' => [
                    'Token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZXhhbXBsZS5vcmciLCJhdWQiOiJodHRwOi8vZXhhbXBsZS5jb20iLCJpYXQiOjEzNTY5OTk1MjQsIm5iZiI6MTM1NzAwMDAwMCwibmFtZSI6IkltcmFuIEtoYW4iLCJlbWFpbCI6ImlraWtAZ21haWwuY29tIiwiaWQiOiI2MjYyNmRhZDE1MzEyMjRmYTEwNjAxZDIiLCJyb2xlIjoiYWRtaW4ifQ.62zVeZBEom2FVW5bnAZV2mn50T8Up0gwQv5HlmwQdVg'
                ]

            ]

        );
        $response = $client->request('POST', '/api/addorder', ['form_params' => $order]);
        $response = json_decode($response->getBody()->getContents(), true);
        $this->response->redirect('/frontend/productlist/list');
    }
    /**
     * update order status
     *
     * @return void
     */
    public function updatestatusAction()
    {
        $orderstatus = $this->request->getPost();
        // print_r($orderstatus);
        // die;
        $url = "http://192.168.2.55:8080/";
        $client = new Client(
            [
                'base_uri' => $url,
            ]

        );
        $res = $client->request('PUT', '/api/order/update', ['form_params' => $orderstatus]);
        $res = json_decode($res->getBody()->getContents(), true);
        $response = new Response();
        $response->setStatusCode(200, 'OK')
            ->setJsonContent(
                [
                    'status' => 200,
                    'msg' => 'order status updated successfully'
                ],
                JSON_PRETTY_PRINT
            );
        return $response;
    }
    /**
     * add products
     *
     * @return void
     */
    public function addproductAction()
    {
        $product = $this->request->getPost();
        // print_r($orderstatus);
        // die;
        $url = "http://192.168.2.55:8080/";
        $client = new Client(
            [
                'base_uri' => $url,
            ]

        );
        $res = $client->request('POST', '/api/products/add', ['form_params' => $product]);
        $res = json_decode($res->getBody()->getContents(), true);
        $response = new Response();
        $response->setStatusCode(200, 'OK')
            ->setJsonContent(
                [
                    'status' => 200,
                    'data' => 'Product Added Sucessfuly!!!'
                ],
                JSON_PRETTY_PRINT
            );
        return $response;
    }
}
