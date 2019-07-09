<?php
namespace App\Controller;

use \Core\Controller\Controller;

class ShopController extends Controller
{
    public function __construct() {
        $this->loadModel('beer');
        $this->loadModel('config');
        $this->loadModel('user');
        $this->loadModel('user_infos');
        $this->loadModel('orders_line');
        $this->loadModel('config');
        $this->loadModel('orders');
    }

    public function index()
    {
        return $this->render('shop/index');
    }

    public function all() {

        $beers = $this->beer->all();
        
        return $this->render('shop/boutique', [
            'beers' => $beers
        ]);
    }

    public function purchaseOrder() {
        //dump($this->config->last());
        //Récupération de la dernière Id
        $id_config = $this->config->last();
        //dump($id_config);
        //Récupération de la ligne complète correspondant à l'ID
        $infos_config = $this->config->find($id_config);
        //dump($infos_config);
        $Tva = $infos_config->getTva();
        //dump($Tva);
        $port = $infos_config->getport();
        if(count($_POST) > 0) {
            foreach($_POST['qty'] as $key => $value) {
                if($value > 0) {
                    $ids[] = $key;
                    $qty[] = $value;
                }
            }
            $ids = implode($ids, ',');

            $beers = $this->beer->getAllInIds($ids);
            

            //$beerPriceHT = $this->orders_line->getBeerPriceHT();
            //dump($beerPriceHT);
            $user_id = $_SESSION['user']->getId();
            $token = substr(md5(uniqid()), 0, 10);
            $orderTotal = 0;
            foreach($beers as $key => $value) {
                $orderTotal += $value->getPriceHT() * $Tva * $qty[$key]; 
                $orderHtTotal += $value->getPriceHT() * $qty[$key]; 
                $beerOrderLine=[
                    'user_id' => $user_id,
                    'beer_id' => $value->getId(),
                    'beerPriceHT' => $value->getPriceHT(),
                    'beerQty' =>  $qty[$key],
                    'token' => $token
                ];
                $order_line = $this->orders_line->create($beerOrderLine);
            }
                $status_id=1;
                $beerOrder=[
                    'userInfos_id' => $user_id,
                    'PriceHT' => $orderHtTotal,
                    'port' => $port,
                    'ordersTva' =>  $Tva,
                    'status_id' => $status_id,
                    'token' => $token
                ];

                //dump($beerOrder);
                $orderComplete = $this->orders->create($beerOrder);
                //dump($orderComplete);
            //dump($_SESSION);

            $user_infos = $this->user_infos->find($user_id, "user_id");

            return $this->render('shop/confirmationDeCommande', [
                'beers' => $beers,
                'data' => $_POST,
                'qty' => $qty,
                'Tva' => $Tva,
                'user' => $user_infos,
                'order' => $orderTotal
            ]);
        }

        $beers = $this->beer->all();
        //dump($_SESSION);
        //dump($_SESSION['user']);
        //dump($_SESSION['user']->getId());
        $mail = $_SESSION['user']->getMail();
        $user_id = $_SESSION['user']->getId();
        //dump($user_id);
        $user_infos = $this->user_infos->find($user_id, "user_id");
        //dump($user_infos);

        return $this->render('shop/bondecommande', [
            'beers' => $beers,
            'user' => $user_infos,
            'Tva' => $Tva,
            'mail' => $mail
        ]);
    }

    public function contact() {
        return $this->render('shop/contact', [
        ]);
    }
}