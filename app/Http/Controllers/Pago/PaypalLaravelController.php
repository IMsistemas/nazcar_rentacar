<?php

namespace App\Http\Controllers\Pago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;


/** Librerias Paypal **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalLaravelController extends Controller
{
   /**
     *
     *
     * Vista de ejmplo paypal
     *
     */
    public function index()
    {

        if (\Illuminate\Support\Facades\Session::has('users') == false) {

            return view('login');

        } else {

            return view('Paypal.Home');

        }

    }
    /**
     *
     *
     * Variables principales para Paypal
     *
     */
    private $_api_context;
    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     *
     *
     * pagar paypal
     *
     */
    public function store(Request $request){

        $data = $request->all();
        $items=$data["Items"];
        $valortt=$data["ValorTotal"];
        $descripcion=$data["Descripcion"];

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        //cargando items 
        $aux_listitem= array();
        foreach ($items as $i) {
            $item = new Item();
            $item->setName($i["Nombre"])  //nombre del item
            ->setCurrency('USD')            // formato dinero
            ->setQuantity($i["Cantidad"])   //cantidad del producto
            ->setPrice($i["PrecioU"]);      //Precio unitario del item
            array_push($aux_listitem, $item);
        }

        //añadiendo a la lista 
        $item_list = new ItemList();
        $item_list->setItems($aux_listitem);

        //valor total de la compra 
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($valortt);        

        $transaction = new Transaction();

        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($descripcion);


        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) 
            ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                $data = array(
                    'url' => 'Paypallaravel2' , 
                    'estado'=> 'Error',
                    'Info'=> 'Connection timeout'
                    );
                return $data;
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                $data = array(
                    'url' => 'Paypallaravel2' , 
                    'estado'=> 'Error',
                    'Info'=> 'Some error occur, sorry for inconvenient'
                    );
                return $data;
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            return $redirect_url;
        }
        \Session::put('error','Unknown error occurred');
        return Redirect::route('addmoney.Paypallaravel2');

    }

    /**
     *
     *
     * Respuesta pago paypal
     *
     */
    public function getPaymentStatus()
    {
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
             $data = array(
                    'url' => 'Paypallaravel2' , 
                    'estado'=> 'Error',
                    'Info'=> 'Payment failed'
                    );
             return view('Paypal.Home' ,compact('data')); // Vista donde se visualiza la respuesta de paypal
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { 
            \Session::put('success','Payment success');
            $data = array(
                    'url' => 'Paypallaravel2' , 
                    'estado'=> 'Ok',
                    'Info'=> 'Payment success'
                    );
             return view('Paypal.Home' ,compact('data')); // Vista donde se visualiza la respuesta de paypal
        }
        \Session::put('error','Payment failed');
        $data = array(
                    'url' => 'Paypallaravel2' , 
                    'estado'=> 'Error',
                    'Info'=> 'Payment failed'
                    );
        return view('Paypal.Home' ,compact('data')); // Vista donde se visualiza la respuesta de paypal
    }

   

}
