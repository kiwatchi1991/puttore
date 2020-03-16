<?php

namespace App\Http\Controllers;

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
use App\CategoryProduct;
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
      // $users =  collect([User::find($id)]);
      $users = User::where('id', $id)->get();
      // $users = User::whereIn('id', $id)->get();
    }

    Log::debug('$users');
    Log::debug($users);
    Log::debug('$users->count()');
    // Log::debug($users->get()->count());

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

    // ユーザー情報の取得
    $products = DB::table('products')
      ->join('users', 'products.user_id', '=', 'users.id')
      ->select('products.id', 'products.name', 'products.user_id', 'users.email')
      ->get();

    $sortFlg = $request->sort;
    if (isset($sortFlg)) {
      if ($sortFlg == '1') {
        $products = $products::latest()->get();
      } elseif ($sortFlg == '0') {
        $products = $products;
      }
    } else {
      $products = $products;
    }


    //キーワード検索
    $keyword = $request->keyword;
    if (!empty($keyword)) {
      Log::debug('キーワード検索の処理に入ってる');
      $products = Product::where('email', 'like', '%' . $keyword . '%')->get();
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
    Log::debug($request);
    //並べかえ（降順/昇順が押された場合）

    //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
    $id = Auth::user()->id;
    $bords = Order::join('products', 'orders.product_id', 'products.id')
      ->orWhere('products.user_id', $id)
      ->join('users', 'products.user_id', 'users.id')
      ->select('orders.id', 'orders.user_id', 'users.pic', 'products.id as p.id', 'products.user_id as p.user_id', 'products.name')
      ->get();


    $sortFlg = $request->sort;
    if (isset($sortFlg)) {
      if ($sortFlg == '1') {
        $orders = $orders::latest()->get();
      } elseif ($sortFlg == '0') {
        $orders = $orders;
      }
    } else {
      $orders = $orders;
    }
  }
}
