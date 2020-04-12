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
use Illuminate\Support\Carbon;
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

    $keyword = $request->keyword;
    $users = User::when($request->keyword, function ($query) use ($keyword) {
      $query->where('email', 'like', '%' . $keyword . '%');
    })
      ->orderBy('users.id', $request->sort == 0 ? 'asc' : 'desc')
      ->get();

    return view('admin.users.index', [
      'users' => $users,
    ]);
  }

  //＝＝＝＝＝＝＝＝＝＝＝＝＝　ユーザー 編集　＝＝＝＝＝
  public function userEdit($id)
  {
    $user = User::find($id);
    return view('admin.users.edit', [
      'user' => $user,
    ]);
  }

  // ================== ユーザー 更新　＝＝＝＝＝＝＝＝
  public function userUpdate(Request $request, $id)
  {
    Log::debug('<< userUpdate >>');
    $user = User::find($id);
    if (!empty($request->group)) {
      $user->group = $request->group;
      $user->save();
    }
    return redirect()->route('admin.user')->with('flash_message', 'ユーザー情報を更新しました');
  }

  // =================  ユーザー　削除前確認 =============
  public function userDeleteConfirm(Request $request, $id)
  {
    Log::debug('<< deleteConfirm >>');

    //一括ボタンからの場合

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');

      $users = User::whereIn('id', $deleteIds)->get();
    } else if (!empty($id)) {
      $users = User::where('id', $id)->get();
    }

    return view('admin.users.delete', [
      'users' => $users,
    ]);
  }

  // ==============  ユーザー削除 =========
  public function userDelete(Request $request)
  {

    Log::debug('<< deleteData >>');

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');
      $users = User::whereIn('id', $deleteIds)->delete();
    } else if (!empty($id)) {
      $users = User::find($id)->delete();
    }

    return redirect('/admin/users')->with('flash_message', '削除しました');
  }

  // =================================
  // =======    プロダクト  ============
  // =================================

  //  =========== プロダクト一覧表示  ========== 
  public function productIndex(Request $request)
  {
    // product情報の取得
    $keyword = $request->keyword;
    $products = Product::join('users', 'products.user_id', '=', 'users.id')
      ->select('products.id', 'products.name', 'products.user_id', 'users.email')
      ->when($request->keyword, function ($query) use ($keyword) {
        $query->where('email', 'like', '%' . $keyword . '%');
      })
      ->orderBy('products.id', $request->sort == 0 ? 'asc' : 'desc')
      ->get();

    return view('admin.products.index', [
      'products' => $products,
    ]);
  }

  //========== プロダクト詳細（閲覧のみ） ========
  public function productShow(Request $request, $id)
  {
    Log::debug('<< productShow >>');

    $product = Product::find($id);

    return view('admin.products.show', [
      'product' => $product,
    ]);
  }

  //===========  プロダクト削除前確認 ============
  public function productDeleteConfirm(Request $request, $id)
  {
    Log::debug('<< productdeleteConfirm >>');

    //一括ボタンからの場合

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');

      $products = Product::whereIn('id', $deleteIds)->get();
    } else if (!empty($id)) {
      $products = Product::where('id', $id)->get();
    }

    return view('admin.products.delete', [
      'products' => $products,
    ]);
  }

  // =======  プロダクト削除　==============
  public function productDelete(Request $request)
  {

    Log::debug('<< deleteData >>');

    if (!empty($request->get('delete_id'))) {

      $deleteIds = $request->get('delete_id');
      $users = Product::whereIn('id', $deleteIds)->delete();
    }

    return redirect('/admin/products')->with('flash_message', '削除しました');
  }


  // =================================
  // =======   注文台帳  ==============
  // =================================

  //================  注文一覧表示 ==========
  public function orderIndex(Request $request)
  {
    Log::debug('orderIndex');

    //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
    $orders = Order::join('products', 'orders.product_id', 'products.id')
      ->join('users', 'products.user_id', 'users.id')
      ->select('orders.id', 'orders.user_id as buy.u_id', 'sale_price', 'products.user_id as sale.u_id', 'products.name')
      ->orderBy('orders.id', $request->sort == 0 ? 'asc' : 'desc')
      ->get();

    return view('admin.orders.index', [
      'orders' => $orders,
    ]);
  }

  // ===========  注文詳細（閲覧のみ） =========-
  public function orderShow(Request $request, $id)
  {
    Log::debug('<< orderShow >>');

    $order = Order::find($id);

    return view('admin.orders.show', [
      'order' => $order,
    ]);
  }

  // =================================
  // =======   お問い合わせ  ===========
  // =================================

  // =========  お問い合わせ一覧表示 ==========
  public function contactIndex(Request $request)
  {
    //キーワード検索
    $keyword = $request->keyword;
    $contacts = Contact::when($request->keyword, function ($query) use ($keyword) {
      $query->where('email', 'like', '%' . $keyword . '%');
    })
      //並べかえ（降順/昇順が押された場合）
      ->orderBy('id', $request->sort == 0 ? 'asc' : 'desc')
      ->get();

    return view('admin.contacts.index', [
      'contacts' => $contacts,
    ]);
  }

  //============　お問い合わせ詳細（閲覧のみ） =========
  public function contactShow(Request $request, $id)
  {
    Log::debug('<< contactShow >>');

    $cotact = Contact::find($id);

    return view('admin.contacts.show', [
      'contact' => $cotact,
    ]);
  }

  // =================================
  // =======   振込依頼  ==============
  // =================================

  //  ========  振込依頼一覧表示 ============
  public function transferIndex(Request $request)
  {
    $keyword = $request->keyword;

    //注文台帳・プロダクト・ユーザーテーブル結合して情報取得
    $transfers = Transfer::join('users', 'transfers.user_id', 'users.id')
      ->select('transfers.id', 'transfer_price', 'payment_date', 'users.email', 'transfers.status')
      ->when($request->keyword, function ($query) use ($keyword) {
        $query->where('email', 'like', '%' . $keyword . '%');
      })
      ->orderBy('transfers.id', $request->sort == 0 ? 'asc' : 'desc')
      ->get();

    return view('admin.transfers.index', [
      'transfers' => $transfers,
    ]);
  }

  // =========  振込依頼 内容確認   ==========
  public function transferShow(Request $request, $id)
  {
    Log::debug('<< transferShow >>');

    $transfer = Transfer::join('users', 'transfers.user_id', 'users.id')
      ->join('from_banks', 'transfers.from_bank_id', 'from_banks.id')
      ->where('transfers.id', $id)
      ->select('transfers.id', 'transfers.transfer_price', 'transfers.commission', 'transfers.created_at', 'transfers.status', 'transfers.payment_date', 'users.id as u.id', 'users.account_name', 'users.email', 'from_banks.name as bank_name') //振込元銀行情報は今後変更していく
      ->first();

    return view('admin.transfers.show', [
      'transfer' => $transfer,
    ]);
  }

  // =========  振込依頼 更新前確認   ==========
  public function transferUpdateConfirm(Request $request, $id)
  {
    Log::debug('<< transferUpdateConfirm >>');

    //一括ボタンからの場合
    $transfers = Transfer::join('users', 'transfers.user_id', 'users.id')
      ->join('from_banks', 'transfers.from_bank_id', 'from_banks.id')
      ->select('transfers.id', 'transfers.transfer_price', 'transfers.transferred_price', 'transfers.commission', 'transfers.created_at', 'transfers.payment_date', 'users.id as u.id', 'users.account_name', 'users.email', 'from_banks.name as bank_name'); //振込元銀行情報は今後変更していく
    if (!empty($request->get('update_id'))) {
      $updateIds = $request->get('update_id');
      $transfers = $transfers->whereIn('transfers.id', $updateIds)->get();
    } else if (!empty($id)) {
      $transfers = $transfers->where('transfers.id', $id)->get();
    }

    return view('admin.transfers.update', [
      'transfers' => $transfers,
    ]);
  }

  // ========  振込依頼　更新 ==============
  public function transferUpdate(Request $request)
  {

    Log::debug('<< transferUpdate >>');

    if (!empty($request->get('update'))) {

      $updateIds = $request->get('update');
      foreach ($updateIds as $updateId) {
        Transfer::whereIn('id', $updateId)->update(['status' => 2, 'paid_date' => Carbon::parse($updateId['paid_date'])]);
      }
    }

    return redirect('/admin/transfer')->with('flash_message', 'ステータスを更新しました');
  }
}
