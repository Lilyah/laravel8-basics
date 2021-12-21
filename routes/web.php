<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MultipicController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ChangePassController;
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

    // Accessing table 'multipics'
    $multipic_app = DB::table('multipics')->where('filter', 'app')->get();
    $multipic_app_count = DB::table('multipics')->where('filter', 'app')->count();
    $multipic_card = DB::table('multipics')->where('filter', 'card')->get();
    $multipic_card_count = DB::table('multipics')->where('filter', 'card')->count();
    $multipic_web = DB::table('multipics')->where('filter', 'web')->get();
    $multipic_web_count = DB::table('multipics')->where('filter', 'web')->count();

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
        'multipic_app',
        'multipic_app_count',
        'multipic_card',
        'multipic_card_count',
        'multipic_web',
        'multipic_web_count',
    ));
})->name('home');

Route::get('/home', function () {
    echo "This is home page";
});

Route::get('/about', function () {
    return view('about');
});//->middleware('age');


/* Front-end Contact page Routes
*/
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


/* Front-end Portfolio page Routes
*/
Route::get('/portfolio', [MultipicController::class, 'Portfolio'])->name('portfolio');


/* Category Routes
*/
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PermanentDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);


/* Admin Brand Routes
*/
Route::get('/admin/brand/all', [BrandController::class, 'AllBrand'])->name('admin.all.brand');
Route::post('/admin/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/admin/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/admin/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/admin/brand/delete/{id}', [BrandController::class, 'Delete']);


/* Admin Multi Image Routes
*/
Route::get('/admin/multi/image/all', [MultipicController::class, 'Multipic'])->name('admin.multi.image')->middleware('auth');
Route::post('/admin/multi/add', [MultipicController::class, 'AddImg'])->name('store.image')->middleware('auth');
Route::get('/admin/multi/edit/{id}', [MultipicController::class, 'Edit'])->middleware('auth');
Route::post('/admin/multi/update/{id}', [MultipicController::class, 'Update'])->middleware('auth');
Route::get('/admin/multi/delete/{id}', [MultipicController::class, 'Delete'])->middleware('auth');



 
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
Route::get('/admin/slider/all', [HomeController::class, 'HomeSlider'])->name('admin.all.slider');
Route::get('/admin/slider/add', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/admin/slider/store', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/admin/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('/admin/slider/update/{id}', [HomeController::class, 'Update']);
Route::get('/admin/slider/delete/{id}', [HomeController::class, 'Delete']);


/* Admin About Routes
*/
Route::get('/admin/about/all', [AboutController::class, 'HomeAbout'])->name('admin.all.about');
Route::get('/admin/about/add', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/admin/about/store', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/admin/about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('/admin/about/update/{id}', [AboutController::class, 'Update']);
Route::get('/admin/about/delete/{id}', [AboutController::class, 'Delete']);


/* Admin Services Routes
*/
Route::get('/admin/services/all', [ServicesController::class, 'HomeServices'])->name('admin.all.services');
Route::get('/service/edit/{id}', [ServicesController::class, 'Edit']);
Route::post('/services/update/{id}', [ServicesController::class, 'Update']);


/* Admin Contact Routes
*/
Route::get('/admin/contact/all', [ContactController::class, 'AdminContact'])->name('admin.all.contact')->middleware('auth');
Route::get('/admin/contact/add', [ContactController::class, 'AddContact'])->name('add.contact')->middleware('auth');
Route::post('/admin/contact/store', [ContactController::class, 'StoreContact'])->name('store.contact')->middleware('auth');
Route::get('/admin/contact/edit/{id}', [ContactController::class, 'Edit'])->middleware('auth');
Route::post('/admin/contact/update/{id}', [ContactController::class, 'Update'])->middleware('auth');
Route::get('/admin/contact/delete/{id}', [ContactController::class, 'Delete'])->middleware('auth');


/* Admin Contact Form Routes
*/
Route::get('/admin/contact/messages', [ContactController::class, 'AdminContactMessage'])->name('admin.contact.messages')->middleware('auth');


/* Admin Profile
*/
Route::get('/admin/user/password', [ChangePassController::class, 'ChangePassword'])->name('change.password')->middleware('auth');






