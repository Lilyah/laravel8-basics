<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MultipicController;
use App\Http\Controllers\ServicesController;
use App\Models\Services;
use Illuminate\Support\Facades\Route;
use App\Models\User; // Activate this in case of using type $users = User::all();
use Illuminate\Support\Facades\DB; // Activate this in case of usin Query builder of type $users = DB::table('users')->get();

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

// Activate this route if you nead clearance 
// Route::get('/clear', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
//     Artisan::call('view:clear');
//     return "Cleared!";
// });


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get(); // Accessing table 'brands'
    $abouts = DB::table('home_abouts')->where('visability', '=', 'active')->orderby('updated_at', 'desc')->first(); // accessing table 'home_abouts' and get last updated record with visability 'active' record from the db

    // Accessing table 'services' in way that every record can be displated alone
    $services_subtitle = DB::table('services')->where('id', '7')->first();
    $service1 = DB::table('services')->where('id', '1')->first();
    $service2 = DB::table('services')->where('id', '2')->first();
    $service3 = DB::table('services')->where('id', '3')->first();
    $service4 = DB::table('services')->where('id', '4')->first();
    $service5 = DB::table('services')->where('id', '5')->first();
    $service6 = DB::table('services')->where('id', '6')->first();


    // Compact is for passing the data from $brands, abouts, services
    return view('home', compact(
        'brands', 
        'abouts', 
        'services_subtitle',
        'service1', 
        'service2',
        'service3',
        'service4',
        'service5',
        'service6',
    ));
});

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});//->middleware('age');

Route::get('/contact', [ContactController::class, 'index'])->name('con');

/* Category Routes
*/
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PermanentDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);


/* Brand Routes
*/
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

/* Multi Image Routes
*/
Route::get('/multi/image', [MultipicController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [MultipicController::class, 'AddImg'])->name('store.image');



 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    /* Two ways of getting data from DB 
    */
    // First: 
    // $users = User::all(); // User:: is the model in app/Models | Eloquent method

    // Second:
    // $users = DB::table('users')->get(); // | Query builder method

    return view('admin.index'); // compact() passing all data from $users = User::all()
})->name('dashboard');


Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');


/* Admin Slider Routes
*/
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);
Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);


/* Admin About Routes
*/
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('/about/update/{id}', [AboutController::class, 'Update']);
Route::get('/about/delete/{id}', [AboutController::class, 'Delete']);


/* Admin Services Routes
*/
Route::get('/home/services', [ServicesController::class, 'HomeServices'])->name('home.services');
Route::get('/service/edit/{id}', [ServicesController::class, 'Edit']);
Route::post('/services/update/{id}', [ServicesController::class, 'Update']);






