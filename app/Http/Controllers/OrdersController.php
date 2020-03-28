<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Discount;
use App\Order;
use App\SystemCommission;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Payjp\Charge;

class OrdersController extends Controller
{
  /**
   * コンテンツ登録
   */
  public function create(Request $request, $id)
  {

    Log::debug('注文台帳：create');


    $request->validate([
      // 'name' => 'required|string|max:255',

    ]);

    Log::debug('これからDBへデータ挿入');
    Log::debug('リクエスト内容↓↓');
    Log::debug($request);

    $product = Product::find($id);

    //　割引価格情報取得
    $discount_price = Discount::where('product_id', $id)->first();

    // ----------------- コンテンツ登録 →　payjpでの支払い処理　↓↓↓--------------
    try {

      \Payjp\Payjp::setApiKey("sk_test_b2ea23efe6354c79bfa31070");
      if ($discount_price) {
        Log::debug('<<<<<<<< payjp discount_price  >>>>>>>>>>>>>');
        $charge = \Payjp\Charge::create(array(
          "customer" => $request->user_id,
          "amount" =>  $discount_price->discount_price,
          "card" => $request->{'payjp-token'},
          "currency" => "jpy",
        ));
      } else {
        Log::debug('<<<<<<<< payjp else  >>>>>>>>>>>>>');
        $charge = \Payjp\Charge::create(array(
          "customer" => $request->user_id,
          "card" => $request->{'payjp-token'},
          "amount" => $product->default_price,
          "currency" => "jpy",
        ));
      }
    } catch (\Payjp\Error\Card $e) {
      Log::debug('PAYJP決済失敗！');
    }

    // ----------------- コンテンツ登録 →　payjpでの支払い処理　↑↑↑--------------



    Log::debug('<<<<<<<<< payjp支払い完了　Orderテーブルへ登録 >>>>>>>');
    Log::debug($charge->id);

    $order = new Order;
    $order->user_id = Auth::user()->id;
    $order->product_id = $id;
    $order->payjp_id = $charge->id;

    if ($discount_price) {
      $order->sale_price = $discount_price->discount_price;
    } else {
      $order->sale_price = Product::find($id)->default_price;
    }
    $order->msg_updated_at = Carbon::now();
    $order->save();
    $order->transfer_price = $order->sale_price * (1 - SystemCommission::find(1)->value('commission_rate'));
    $order->save();

    Log::debug('$order->sale_price');
    Log::debug($order->sale_price);
    Log::debug('$order->transfer_price');
    Log::debug($order->transfer_price);


    // リダイレクトする
    // その時にsessionフラッシュにメッセージを入れる
    return redirect('/bords')->with('flash_message', ('購入しました！'));
  }
}
