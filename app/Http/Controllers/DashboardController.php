<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;


class DashboardController extends Controller
{
        //
        public function index(){
            $usid = Product::select("users_id")->where('users_id', '=', Auth::user()->id)->groupBY('users_id')->get();
            $newfar = json_decode($usid);
            $kyaa = 0;
            $takeech = '';
            foreach($newfar as $uid){
               $takeech = $uid->users_id;
            }
            $anothervar = Product::select("id")->where('users_id','=',$takeech)->get();
            $anotheanothervar = json_decode($anothervar);
            $prodvar = [];
            foreach ($anotheanothervar as $var ) {
                // $prodvar = Arr::add($prodvar, $var->id, $var );
                $kyaa = TransactionDetail::where('products_id', '=', $var->id)->get()->count();
            }
            $hitungtranscuruser = $kyaa;
            $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                                                ->whereHas('product', function($product){
                                                    $product->where('users_id', Auth::user()->id);
                                                });
            $revenue = $transactions->get()->reduce(function($carry, $item){
                return $carry + $item->price;
            });
            $curruser = Auth::user()->id;
            return view('pages.dashboard',[
        'transaction_count' => $transactions->count(),
            'transaction_data' =>$transactions->get(),
            'revenue' => $revenue,
        'customer' => $hitungtranscuruser ?? 0]);
        }
}
