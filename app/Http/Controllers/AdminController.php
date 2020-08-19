<?php

namespace App\Http\Controllers;

use Dotenv\Result\Result;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    public function show_dashboard()
    {
        return view('admin.dashboard');
    }
    public function login()
    {
        return view('admin_login');
    }

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return view('admin.dashboard');
        } else {
            Session::put('message', 'Mật khẩu hoặc tài khoản sai. Vui lòng nhập lại');
            return Redirect::to('/login');
        }
    }

    public function logout()
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/login');
    }
    //thong tin chi tiet san pham
    public function show_product()
    {
        $products = DB::table('products')->get();
        return view('admin.product')->with(['products' => $products]);
    }
    //add products
    public function add_product()
    {
        return view('admin.add_product');
    }

    public function postadd(Request $request)
    {
        // nhận tất cả tham số vào mảng products
        $products = $request->all();
        //xử lý upload hình vào thư mục
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
                return redirect('products/create')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $imageName = $file->getClientOriginalName();
            $file->move("images", $imageName);
        } else {
            $imageName = null;
        }

        $id = $request->input('id');
        $tensanpham = $request->input('tensanpham');
        $xuatsu = $request->input('xuatsu');
        $thuonghieu = $request->input('thuonghieu');
        $images = $request->input('images');
        $giagoc = $request->input('priceold');
        $giagiam = $request->input('pricenew');
        $mota = $request->input('mota');
        DB::table('products')->insert([
            'id' => intval($id),
            'tensanpham' => $tensanpham,
            'xuatsu' => $xuatsu,
            'thuonghieu' => $thuonghieu,
            'images' => $images,
            'giagoc' => intval($giagoc),
            'giagiam' => $giagiam,
            'mota' => $mota
        ]);

        return redirect()->action('AdminController@show_product');
    }
    //cap nhat san pham
    public function update_product($id)
    {
        $products = DB::table('products')
            ->where('id', intval($id))
            ->first();
        return view('admin.update_product', ['products' => $products]);
    }


    public function postUpdate(Request $request, $id)
    {
        $tensanpham = $request->input('tensanpham');
        $xuatsu = $request->input('xuatsu');
        $thuonghieu = $request->input('thuonghieu');
        // xử lý upload hình vào thư mục
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
                return redirect('products/update')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $imageName = $file->getClientOriginalName();
            $file->move("public/images", $imageName);
        } else { // không upload hình mới => giữ lại hình cũ
            $products = DB::table('products')
                ->where('id', intval($id))
                ->first();
            $imageName = $products->images;
        }
        $giagoc = $request->input('priceold');
        $giagiam = $request->input('pricenew');
        $mota = $request->input('mota');

        $products = DB::table('products')
            ->where('id', intval($id))
            ->update(['tensanpham' => $tensanpham, 'xuatsu' => intval($xuatsu), 'thuonghieu' => $thuonghieu, 'images' =>
            $imageName, 'giagoc' => $giagoc, 'giagiam' => $giagiam, 'mota' => $mota]);
        return redirect()->action('productController@show_product');
    }
    //xoa san pham
    public function delete($id)
    {
        $products = DB::table('products')
            ->where('id', $id)
            ->delete();

        //return view('products.delete')->with(['productss' => $productss]);
        return redirect()->action('AdminController@show_product');
    }
}
