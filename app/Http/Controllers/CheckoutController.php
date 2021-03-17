<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {   
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->makePagSeguroSession();

        $cartItems = array_map(function($line){
            return $line['amount']*$line['price'];
        }, session()->get('cart'));

        $cartItems = array_sum($cartItems);
        return view('checkout', compact('cartItems'));
    }   

    public function proccess(Request $request)
    {
        
        $dataPost = $request->all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $reference = 'XPTO';
        $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
        $result = $creditCardPayment->doPayment();
        var_dump($result);
        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'store_id' => 42,
        ];

        $user->orders()->create($userOrder);

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido Criado com Sucesso!'            ]
        ]);
    }   

    private function makePagSeguroSession(){

        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
            
    }
}
