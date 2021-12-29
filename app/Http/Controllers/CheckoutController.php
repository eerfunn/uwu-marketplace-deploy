<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    //
    public function process(Request $request){
        //take user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //checkout process
        $code = 'INV-' . mt_rand(0000000000, 9999999999);
        $carts = Cart::with(['product','user'])
                        ->where('users_id', Auth::user()->id)
                        ->get();
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' =>$request->insurance_price,
            'shipping_price' => $request->shipping_price,
            'total_price' => $request->total_price,
            'transactions_status' => 'PENDING',
            'code' => $code,
            ]);
            foreach ($carts as $cart) {
                $trx = 'TRX'. mt_rand(0000000000, 9999999999);

                TransactionDetail::create([
                    'transactions_id' => $transaction->id,
                    'products_id' => $cart->product->id,
                    'price' => $cart->product->price,
                    'shipping_status' => 'PENDING',
                    'resi' => '',
                    'code' => $trx,
                ]);
            }
            
            //Delete Cart Data
            Cart::where('users_id', Auth::user()->id)->delete();

            //MIDTRANS CONFIGURATION
            // Set your Merchant Server Key
            Config::$serverKey = config('services.midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            Config::$isProduction = config('services.midtrans.isProduction');
            // Set sanitization on (default)
            Config::$isSanitized = config('services.midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            Config::$is3ds = config('services.midtrans.is3ds');

            $midtrans = [
                'transaction_details' => [
                    'order_id' => $code,
                    'gross_amount' => (int) $request->total_price
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,

                ],
                'enabled_payment' =>[
                    'gopay', 'permata_va',
                    'bca_va', 'bni_va', 'bri_va', 'other_va'
                ],
                'vtweb' => []
            ];

            try {
                // Get Snap Payment Page URL
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
                
                // Redirect to Snap Payment Page
                return redirect($paymentUrl);
                }
                catch (Exception $e) {
                echo $e->getMessage();
                }
        }
    public function callback(Request $request){

    }
}
