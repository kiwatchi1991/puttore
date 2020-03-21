<?php

namespace App\Http\Controllers;

use AddTransferIdToOrders;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProductRequest;

use App\Product;
use App\Category;
use App\Difficulty;
use App\Discount;
use App\Cart;
use App\Follow;
use App\Like;
use App\Lesson;
use App\Order;
use App\User;
use App\Contact;
use App\CategoryProduct;
use App\Transfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class adminController extends Controller
{
  // =================================
  // =======   ユーザー  ==============
  // =================================
  public function userIndex(Request $request)
  {
    Log::debug($request);
    //並べかえ（降順/昇順が押された場合）
    $sortFlg = $request->sort;
    if (isset($sortFlg)) {
      if ($sortFlg == '1') {
        $users = User::latest()->get();
      } elseif ($sortFlg == '0') {
        $users = User::all();
      }
    } else {
      $users = User::all();
    }


    //キーワード検索
    $keyword = $request->keyword;
    if (!empty($keyword)) {
      Log::debug('キーワード検索の処理に入ってる');
      $users = User::where('email', 'like', '%' . $keyword . '%')->get();
    }

    return view('admin.users.index', [
      'users' => $users,
    ]);
  }



  public function userEdit($id)
  {
    $user = User::find($id);
    return view('admin.users.edit', [
      'user' => $user,
    ]);
  }

  public function userUpdate(Request $request, $id)
  {
    Log::debug('<< userUpdate >>');
    Log::debug($request);
    $user = User::find($id);
    if (!empty($request->group)) {
      $user->group = $request->group;
      $user->save();
    }
    return redirect()->route('admin.user')->with('flash_message', 'ユーザー情報を更新しました');
  }

  //削除前確認）
  public function userDeleteConfirm(Request $request, $id)
  {
    Log::debug('<< deleteConfirm >>');
    Log::debug($request);

    //一括ボタンからの場合

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');
      Log::debug('$deleteIds');
      Log::debug($deleteIds);

      $users = User::whereIn('id', $deleteIds)->get();
    } else if (!empty($id)) {
      $users = User::where('id', $id)->get();
    }

    Log::debug('$users');
    Log::debug($users);
    Log::debug('$users->count()');

    return view('admin.users.delete', [
      'users' => $users,
    ]);
  }

  //削除
  public function userDelete(Request $request)
  {
    // GETパラメータが数字かどうかをチェックする
    // 事前にチェックしておくことでDBへの無駄なアクセスが減らせる（WEBサーバーへのアクセスのみで済む）
    // if(!empty($id)){
    //   if (!ctype_digit($id)) {
    //     return redirect('/admin/users')->with('flash_message', __('もう一度やり直してください'));
    //   }
    // }
    Log::debug('<< deleteData >>');
    Log::debug($request);

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');
      Log::debug('$deleteIds');
      Log::debug($deleteIds);
      $users = User::whereIn('id', $deleteIds)->delete();
    } else if (!empty($id)) {
      $users = User::find($id)->delete();
    }

    return redirect('/admin/users')->with('flash_message', '削除しました');
  }

  // =================================
  // =======    プロダクト  ==============
  // =================================
  // プロダクト一覧表示
  public function productIndex(Request $request)
  {
    Log::debug($request);
    //並べかえ（降順/昇順が押された場合）

    // product情報の取得
    $products = Product::join('users', 'products.user_id', '=', 'users.id')
      ->select('products.id', 'products.name', 'products.user_id', 'users.email');

    // 初期表示
    if (empty($request->sort) && empty($request->keyword)) {
      $products = $products->get();
    }

    $sortFlg = $request->sort;
    if (isset($sortFlg)) {
      if ($sortFlg == '1') {
        $products = $products->get();
      } elseif ($sortFlg == '0') {
        $products = $products->orderBy('products.id', 'desc')->get();
      }
    }


    //キーワード検索
    $keyword = $request->keyword;
    if (!empty($keyword)) {
      Log::debug('キーワード検索の処理に入ってる');
      $products = $products->where('email', 'like', '%' . $keyword . '%')->get();
    }

    return view('admin.products.index', [
      'products' => $products,
    ]);
  }

  //プロダクト詳細（閲覧のみ）
  public function productShow(Request $request, $id)
  {
    Log::debug('<< productShow >>');
    Log::debug($request);
    Log::debug($id);

    // $deleteIds[] = $request->get('delete_id');

    // foreach ($deleteIds as $deleteId) {
    $product = Product::find($id);
    // }

    return view('admin.products.show', [
      'product' => $product,
    ]);
  }

  //削除前確認）
  public function productDeleteConfirm(Request $request, $id)
  {
    Log::debug('<< productdeleteConfirm >>');
    Log::debug($request);

    //一括ボタンからの場合

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');
      Log::debug('$deleteIds');
      Log::debug($deleteIds);

      $products = Product::whereIn('id', $deleteIds)->get();
    } else if (!empty($id)) {
      // $products =  collect([User::find($id)]);
      $products = Product::where('id', $id)->get();
      // $products = User::whereIn('id', $id)->get();
    }

    Log::debug('$products');
    Log::debug($products);

    return view('admin.products.delete', [
      'products' => $products,
    ]);
  }

  //削除
  public function productDelete(Request $request)
  {

    Log::debug('<< deleteData >>');
    Log::debug($request);

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');
      Log::debug('$deleteIds');
      Log::debug($deleteIds);
      $users = Product::whereIn('id', $deleteIds)->delete();
    }
    // else if (!empty($id)) {
    //   $users = Product::find($id)->delete();
    // }

    return redirect('/admin/products')->with('flash_message', '削除しました');
  }


  // =================================
  // =======   注文台帳  ==============
  // =================================

  // 注文一覧表示
  public function orderIndex(Request $request)
  {
    Log::debug('orderIndex');

    //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
    $orders = Order::join('products', 'orders.product_id', 'products.id')
      ->join('users', 'products.user_id', 'users.id')
      ->select('orders.id', 'orders.user_id as buy.u_id', 'sale_price', 'products.user_id as sale.u_id', 'products.name');

    // 初期表示
    if (empty($request->sort) && empty($request->keyword)) {
      $orders = $orders->get();
    }

    Log::debug('$orders');
    Log::debug($orders);

    //並べかえ（降順/昇順が押された場合）
    $sortFlg = $request->sort;
    if (isset($sortFlg)) {
      if ($sortFlg == '1') {
        $orders = $orders->get();
      } elseif ($sortFlg == '0') {
        $orders = $orders->orderBy('orders.id', 'desc')->get();
      }
    }

    return view('admin.orders.index', [
      'orders' => $orders,
    ]);
  }

  //注文詳細（閲覧のみ）
  public function orderShow(Request $request, $id)
  {
    Log::debug('<< orderShow >>');
    Log::debug($request);
    Log::debug($id);

    // $deleteIds[] = $request->get('delete_id');

    // foreach ($deleteIds as $deleteId) {
    $order = Order::find($id);
    // }

    return view('admin.orders.show', [
      'order' => $order,
    ]);
  }

  // =================================
  // =======   お問い合わせ  ==============
  // =================================
  public function contactIndex(Request $request)
  {
    Log::debug($request);

    //並べかえ（降順/昇順が押された場合）

    $sortFlg = $request->sort;
    if (isset($sortFlg)) {
      if ($sortFlg == '1') {
        $contacts = Contact::latest()->get();
      } elseif ($sortFlg == '0') {
        $contacts = Contact::all();
      }
    } else {
      $contacts = Contact::all();
    }


    //キーワード検索
    $keyword = $request->keyword;
    if (!empty($keyword)) {
      Log::debug('キーワード検索の処理に入ってる');
      $contacts = Contact::where('email', 'like', '%' . $keyword . '%')->get();
    }

    return view('admin.contacts.index', [
      'contacts' => $contacts,
    ]);
  }

  //注文詳細（閲覧のみ）
  public function contactShow(Request $request, $id)
  {
    Log::debug('<< contactShow >>');
    Log::debug($request);
    Log::debug($id);

    $cotact = Contact::find($id);

    return view('admin.contacts.show', [
      'contact' => $cotact,
    ]);
  }


  // =================================
  // =======   振込依頼  ==============
  // =================================

  // 注文一覧表示
  public function transferIndex(Request $request)
  {
    Log::debug('transferIndex');

    //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
    $transfers = Transfer::join('users', 'transfers.user_id', 'users.id')
      ->select('transfers.id', 'transfer_price', 'payment_date', 'users.email',)
      ->get();

    // Order::join('products', 'orders.product_id', 'products.id')
    //   ->join('users', 'products.user_id', 'users.id')
    //   ->select('orders.id', 'orders.user_id as buy.u_id', 'sale_price', 'products.user_id as sale.u_id', 'products.name');


    // 初期表示
    // if (empty($request->sort) && empty($request->keyword)) {
    //   $orders = $orders->get();
    // }

    Log::debug('$transfers');
    Log::debug($transfers);

    //並べかえ（降順/昇順が押された場合）
    // $sortFlg = $request->sort;
    // if (isset($sortFlg)) {
    //   if ($sortFlg == '1') {
    //     $orders = $orders->get();
    //   } elseif ($sortFlg == '0') {
    //     $orders = $orders->orderBy('orders.id', 'desc')->get();
    //   }
    // }

    return view('admin.transfers.index', [
      'transfers' => $transfers,
    ]);
  }
  // =================================
  //  更新前確認 ======================
  // =================================
  public function transferUpdateConfirm(Request $request, $id)
  {
    Log::debug('<< transferUpdateConfirm >>');
    Log::debug($request);



    //一括ボタンからの場合


    $transfers = Transfer::join('users', 'transfers.user_id', 'users.id')
      ->join('from_banks', 'transfers.from_bank_id', 'from_banks.id')
      ->select('transfers.id', 'transfers.transfer_price', 'transfers.transferred_price', 'transfers.commission', 'transfers.created_at', 'transfers.payment_date', 'users.id as u.id', 'users.account_name', 'users.email', 'from_banks.name as bank_name'); //振込元銀行情報は今後変更していく
    if (!empty($request->get('update_id'))) {

      $updateIds = $request->get('update_id');
      Log::debug('$updateIds');
      Log::debug($updateIds);
      $transfers = $transfers->whereIn('transfers.id', $updateIds)->get();
    } else if (!empty($id)) {
      $transfers = $transfers->where('transfers.id', $id)->get();
    }



    Log::debug('$transfers');
    Log::debug($transfers);

    return view('admin.transfers.update', [
      'transfers' => $transfers,
    ]);
  }

  //削除
  public function transferUpdate(Request $request)
  {

    Log::debug('<< transferUpdate >>');
    Log::debug($request);

    if (!empty($request->get('update_id'))) {

      $updateIds = $request->get('update_id');
      Log::debug('$updateIds');
      Log::debug($updateIds);
      $transfers = Transfer::whereIn('id', $updateIds)->update(['status' => 2], ['payment_date' => $request->payment_date]);
    }

    // $transfers = 
    // else if (!empty($id)) {
    //   $users = Product::find($id)->delete();
    // }

    return redirect('/admin/transfer')->with('flash_message', 'ステータスを更新しました');
  }
}
