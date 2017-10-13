<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news', function () {
   return 'Welcome to NewsBlog';
});

Route::get('/news/hot', function () {
   return "<h1>Hello News Hot</h1>";
});

Route::get('/age/{age}', function ($age) {
    return 'My age is ' . $age;
})->where(['age' => '[0-9]+']);

//  Định danh cho Router
//  Cách đặt định danh 1
Route::get('Route1',['as'=>'MyRoute',function(){
    echo "Xin Chao Cac Ban";
}]);

//  Cách đặt định danh 2
Route::get('Route2', function () {
    echo 'Day la route 2';
})->name('MyRoute2');

//  Gọi định danh
Route::get('GoiTen', function () {
    return redirect()->route('MyRoute2');
});

//  Route Group
Route::group(['prefix'=>'MyGroup'], function (){
//    Muốn gọi User 1 => domain/MyGroup/User1
    Route::get('User1', function (){
        echo 'User1';
    });

    Route::get('User2', function (){
        echo 'User2';
    });

    Route::get('User3', function (){
        echo 'User3';
    });
});

//  Gọi Controller
Route::get('goiController', 'MyController@XinChao');

Route::get('ThamSo/{thamso}', 'MyController@KhoaHoc');

//  Gọi URL
Route::get('MyRequest', 'MyController@GetURL');

// Goi đến View Form
Route::get('getForm', function (){
    return view('postForm');
});

// Goi phuong thuc Post
Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']);

// Cookie
Route::get('setCookie','MyController@setCookie');

Route::get('getCookie','MyController@getCookie');

// Upload file
Route::get('uploadFile', function (){
    return view('postFile');
});

Route::post('postFile',['as'=>'postFile','uses'=>'MyController@postFile']);

// jSON
Route::get('getJson', 'MyController@getJson');

// View
Route::get('myView', 'MyController@myView');

Route::get('Time/{t}', 'MyController@getTime');

View::share('KhoaHoc', 'Laravel');

// Blade template
Route::get('blade', function (){
    return view('pages.laravel');
});

Route::get('php', function (){
    return view('pages.php');
});

Route::get('BladeTemplate/{str}', 'MyController@Blade');

// Database
Route::get('database', function (){
//    Schema::create('loaisp', function ($table){
//        $table->increments('id');
//        $table->string('ten',200);
//    });

    Schema::create('theloai', function ($table){
        $table->increments('id');
        $table->string('ten',200)->nullable();
        $table->string('nsx')->default('Nha san xuat');
    });
    echo 'Thuc hien thanh cong';
});

// Lien ket bang
Route::get('lienketbang', function (){
    Schema::create('sanpham', function ($table){
       $table->increments('id');
       $table->string('ten');
       $table->float('gia');
       $table->integer('soluong')->default(0);
       $table->integer('id_loaisp')->unsigned();
       $table->foreign('id_loaisp')->references('id')->on('loaisp');
    });

    echo 'Da tao bang thanh cong';
});

// Sua bang
Route::get('suabang', function (){
   Schema::table('theloai', function ($table){
      $table->dropColumn('nsx');
   });
});
Route::get('themcot', function (){
    Schema::table('theloai', function ($table){
        $table->string('email');
    });
});
// Doi ten bang
Route::get('doiten', function (){
    Schema::rename('theloai', 'users');
});

// Xoa bang
Route::get('xoabang', function (){
    Schema::dropIfExists('users');
    echo 'Da xoa thanh cong';
});

// Query Builder
// Lấy tất cả dữ liệu
Route::get('qb/get', function (){
    $data = DB::table('users')->get();
    foreach ($data as $row){
        foreach ($row as $key=>$value){
            echo $key . ' : '. $value . "<br>";
        }
        echo "<hr>";
    }
});

// Query Builder
// Lấy dữ liệu có điều kiện
Route::get('qb/where', function (){
    $data = DB::table('users')->where('id', '=', 8)->get();
    foreach ($data as $row){
        foreach ($row as $key=>$value){
            echo $key . ' : '. $value . "<br>";
        }
        echo "<hr>";
    }
});

// Lấy các cột dữ liệu theo yêu cầu: select id, name, ....
// Query Builder
Route::get('qb/select', function (){
    $data = DB::table('users')->select('id', 'name', 'password', 'email')->where('id',8)->get();
    foreach ($data as $row){
        foreach ($row as $key=>$value){
            echo $key . ' : '. $value . "<br>";
        }
        echo "<hr>";
    }
});

// Query Builder
// Select id, name as hoten,...
Route::get('qb/raw', function (){
    $data = DB::table('users')->select(DB::raw('id, name as hoten, email'))->get();
    foreach ($data as $row){
        foreach ($row as $key=>$value){
            echo $key . ' : '. $value . "<br>";
        }
        echo "<hr>";
    }
});

// Query Builder
// order by
Route::get('qb/orderby', function (){
    $data = DB::table('users')->orderBy('id', 'desc')->get();
    foreach ($data as $row){
        foreach ($row as $key=>$value){
            echo $key . ' : '. $value . "<br>";
        }
        echo "<hr>";
    }
});

// Query Builder
// limit 2, 5
Route::get('qb/skip', function (){
    $data = DB::table('users')->take(4)->get();
    foreach ($data as $row){
        foreach ($row as $key=>$value){
            echo $key . ' : '. $value . "<br>";
        }
        echo "<hr>";
    }
});

// update csdl
Route::get('qb/update', function (){
    DB::table('users')->where('id',1)->update(['name'=>'NamDeve']);
    echo 'Đã update';
});

// delete csdl
Route::get('qb/delete', function (){
    DB::table('users')->where('id',1)->delete();
    echo 'Xoa thanh cong';
});

// Xoa toan bo du lieu trong bang
Route::get('qb/truncate', function (){
    DB::table('users')->truncate();
    echo 'Xoa thanh cong';
});

//Model
Route::get('model/save', function (){
    $user = new App\User();
    $user->name = "NamDeve";
    $user->email = "thanhnamdk2710@gmail.com";
    $user->password = bcrypt('nam123');

    $user->save();

    echo 'Da thuc hien save()';
});

Route::get('model/query', function (){
    $user = \App\User::find(2);
    echo $user->name;
});

// San pham
Route::get('model/sanpham/save/{ten}', function ($ten){
    $sanpham = new \App\SanPham();
    $sanpham->ten = $ten;
    $sanpham->soluong = 10;

    $sanpham->save();
    echo 'Them thanh cong ' . $ten;
});

// San pham
Route::get('model/sanpham/all', function (){
    $sanpham = App\SanPham::all()->toArray();
    var_dump($sanpham);
});

Route::get('taocot', function (){
    Schema::table('sanpham', function ($table){
        $table->integer('id_loaisp')->unsigned();
    });
});

Route::get('lienket', function (){
    $data = \App\SanPham::find(1)->loaisp->toArray();
    var_dump($data);
});

Route::get('lienketloaisp', function (){
    $data = \App\LoaiSP::find(1)->sanpham->toArray();
    var_dump($data);
});