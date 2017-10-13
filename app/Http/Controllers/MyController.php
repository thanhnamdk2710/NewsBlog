<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyController extends Controller
{
    public function XinChao(){
        echo 'Xin Chao Cac Ban';
    }

    public function KhoaHoc($ten){
        echo 'Khoa hoc: '. $ten;
        return redirect()->route('MyRoute');
    }

    public function GetURL(Request $request){
        // Trả về đường dẫn URL
//        return $request->url();
        // Kiểm tra phương thức
//        if ($request->isMethod('get'))
//            echo 'Phương thức get';
//        else
//            echo 'Không phải phương thức get';
        //Kiểm tra có chuỗi trong đường dẫn hay không
        if ($request->is('My*'))
            echo 'Co My trong duong dan';
        else
            echo 'Khong co My trong duong dan';
    }

    public function postForm(Request $request){
        echo $request->yourname;
    }

    public function setCookie(){
        $response = new Response();
        $response->withCookie('KhoaHoc', 'Laravel - NewsBlog', 1);
        return $response;
    }

    public function getCookie(Request $request){
        return $request->cookie('KhoaHoc');
    }

    public function postFile(Request $request){
        if ($request->hasFile('myFile')) {
            $file = $request->file('myFile');
            $file_name = $file->getClientOriginalName();
            $file->move('images', "$file_name");
            echo $file_name;
        } else {
            echo 'Khong co File';
        }
    }

    public function getJson(){
        $array = ['KhoaHoc'=>'Laravel', 'TrungTam'=>'KhoaPham Tranning', 'ASP.NET', 'HTML&CSS'];
        return response()->json($array);
    }

    public function myView(){
        return view('view.KhoaPham');
    }

    public function getTime($t){
        return view('myView', ['t'=>$t]);
    }

    public function Blade($str){
        $khoahoc1 = '';
        if ($str == 'laravel'){
            return view('pages.laravel', ['khoahoc1'=>$khoahoc1]);
        } elseif ($str == "php"){
            return view('pages.php', ['khoahoc1'=>$khoahoc1]);
        }
    }
}
