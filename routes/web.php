<?php

use App\http\Livewire\HomeComponent;
use App\http\Livewire\ShopComponent;
use App\http\Livewire\CartComponent;
use App\http\Livewire\AboutusComponent;

use App\http\Livewire\CheckoutComponent;
use App\http\Livewire\User\userDashboardComponent;
use App\http\Livewire\Admin\AdminDashboardComponent;
use App\http\Livewire\DetailsComponent;
use App\http\Livewire\CategoryComponent;
use App\http\Livewire\SearchComponent;
use App\http\Livewire\Admin\AdminCategoryComponent;
use App\http\Livewire\Admin\AdminAddCategoryComponent;
use App\http\Livewire\Admin\AdminEditCategoryComponent;
use App\http\Livewire\Admin\AdminProductComponent;
use App\http\Livewire\Admin\AdminAddProductComponent;
use App\http\Livewire\Admin\AdminEditProductComponent;

use App\http\Livewire\Admin\AdminHomeSlidercomponent;
use App\http\Livewire\Admin\AdminAddHomeSlidercomponent;
use App\http\Livewire\Admin\AdminEditHomeSlidercomponent;


use App\http\Livewire\Admin\AdminHomeCategorycomponent;

use App\http\Livewire\Admin\AdminSaleComponent;

use App\http\Livewire\WishListComponent;


use App\http\Livewire\Admin\AdminCouponsComponent;
use App\http\Livewire\Admin\AdminAddCouponComponent;
use App\http\Livewire\Admin\AdminEditCouponComponent;



use App\http\Livewire\ThankyouComponent;




use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',HomeComponent::class);
Route::get('/shop',ShopComponent::class);
Route::get('/cart',CartComponent::class)->name('product.cart');
Route::get('/checkout',CheckoutComponent::class)->name('checkout');
Route::get('/about-us',AboutusComponent::class);
Route::get('/project/{slug}',DetailsComponent::class)->name('product.details');
Route::get('/product-category/{category_slug}',CategoryComponent::class)->name('product.cetegory');


Route::get('/search',SearchComponent::class)->name('product.search');

Route::get('/thankyou',ThankyouComponent::class)->name('thankyou');




// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');



//for admin 
Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function () {
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/Categories',AdminCategoryComponent::class)->name('admin.category');
    Route::get('/admin/Category/add',AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/Category/edit/{category_slug}',AdminEditCategoryComponent::class)->name('admin.editcategory');
    Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/products/add',AdminAddProductComponent::class)->name('admin.addproducts');
    Route::get('/admin/products/edit/{product_slug}',AdminEditProductComponent::class)->name('admin.editproduct');


    //for home
    Route::get('/admin/slider',AdminHomeSlidercomponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add',AdminAddHomeSlidercomponent::class)->name('admin.addhomeslider');
    Route::get('/admin/slider/edit/{slide_id}',AdminEditHomeSlidercomponent::class)->name('admin.edithomeslider');

    Route::get('/admin/home-categories',AdminHomeCategorycomponent::class)->name('admin.homecategories');

    //for sale
    Route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale');

    //wishlist

    Route::get('/wishlist',WishListComponent::class)->name('product.wishlist');

    //for coupons

    Route::get('admin/coupons',AdminCouponsComponent::class)->name('admin.coupons');
    Route::get('admin/coupons/add',AdminAddCouponComponent::class)->name('admin.addcoupon');
    Route::get('admin/coupons/edit/{coupon_id}',AdminEditCouponComponent::class)->name('admin.editcoupon');



});



//for user or customer

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard',userDashboardComponent::class)->name('user.dashboard');
});
