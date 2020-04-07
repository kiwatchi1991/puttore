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
use app\User;
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
    $discount_price = Discount::where('product_id', $id)
      ->where('start_date', '<', Carbon::now())
      ->where('end_date', '>', Carbon::now())
      ->first();

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
      $order->price_flg = 1;
    } else {
      $order->sale_price = Product::find($id)->default_price;
      $order->price_flg = 0;
    }
    $order->msg_updated_at = Carbon::now();
    $order->save();

    if ($discount_price) {
      //割引価格の時は手数料は3%（今後変更あり）
      $order->transfer_price = $order->sale_price * (1 - SystemCommission::where('id', 2)->value('commission_rate'));
    } else {
      //通常価格の時は手数料は10%（今後変更あり）
      $order->transfer_price = $order->sale_price * (1 - SystemCommission::where('id', 1)->value('commission_rate'));
    }

    $order->save();

    Log::debug('この処理1');
    //購入者にメール送信する
    User::find($order->user_id)->buyEmail($order);
    //出品者にメール送信する
    $sale_user_id = Product::find($id)->user_id;
    Log::debug('$sale_user_id');
    Log::debug($sale_user_id);
    User::find($sale_user_id)->saleEmail($order);

    Log::debug('この処理4');

    // リダイレクトする
    // その時にsessionフラッシュにメッセージを入れる
    return redirect()->route('products.show', $id)->with('flash_message', ('購入しました！'));
  }
}
