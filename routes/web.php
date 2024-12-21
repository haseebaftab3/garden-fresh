<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
// Front End Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\MainProductController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// For Admin
Route::get('/admin/auth/login', [AdminController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
Route::post('/admin/auth/login', [AdminController::class, 'login'])->name('admin.login.submit')->middleware('guest:admin');
Route::post('/admin/auth/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('guest:admin');
Route::get('/admin', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
Route::post('/update-cart-quantity', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::post('/delete-cart-item', [CartController::class, 'deleteItem'])->name('cart.delete.item');
Route::post('/cart/update/{id}', [CartController::class, 'updateCartQuantity']);
Route::get('/get-cart-items', [CartController::class, 'getCartItems'])->name('cart.items');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order/success/{orderId}', [CheckoutController::class, 'orderSuccess'])->name('order.success');



// Main Website
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{id}/quick-view', [ShopController::class, 'quickView'])->name('product.quickview');
Route::get('/product/{slug}', [MainProductController::class, 'show'])->name('product.details');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::prefix('category')->group(function () {
    Route::get('/{slug}', [CategoryDetailController::class, 'show'])->name('category.show');
    Route::get('/', [CategoryDetailController::class, 'index'])->name('category.index');
});



// Dashboard
Route::middleware(['auth:admin'])->group(function () {
    // Dashboard

    // Products
    Route::prefix('admin/')->group(function () {
        Route::resource('products', ProductController::class)->names('admin.products');
        Route::get('/products/published', [ProductController::class, 'published'])->name('admin.products.published');
        Route::get('/products/scheduled', [ProductController::class, 'scheduled'])->name('admin.products.scheduled');
        Route::get('/products/draft', [ProductController::class, 'draft'])->name('admin.products.draft');
        Route::delete('/admin/products/gallery/{id}', [ProductController::class, 'deleteImage'])->name('products.gallery.delete');
        Route::get('/get-child-categories/{parentId}', [ProductController::class, 'LoadSubCategories']);
        Route::get('products/categories', [ProductController::class, 'categories'])->name('admin.products.categories');
        Route::resource('categories', CategoryController::class);
        Route::get('categories/inputs', [CategoryController::class, 'inputs'])->name('admin.categories.inputs');
        Route::post('categories/store/inputs', [CategoryController::class, 'storeInputs'])->name('categories.store.inputs');
        Route::get('categories/{category}/manage-inputs', [CategoryController::class, 'manageInputs'])->name('categories.manage.inputs');
        Route::post('/categories/multi-delete', [CategoryController::class, 'multiDelete'])->name('categories.multi-delete');
        Route::get('category/get-parent-categories', [CategoryController::class, 'getParentCategories']);
        Route::get('category/get-child-categories/{parentId}', [CategoryController::class, 'getChildCategories']);
        Route::get('/category/edit/get-child-categories/{parentId}', [CategoryController::class, 'getEditChildCategories']);
        Route::get('category/get-parent-categories/{grandparentId}', [CategoryController::class, 'getParentCategories']);
        Route::resource('admin/sales', SalesController::class, ['as' => 'admin']);
        Route::resource('admin/discounts', DiscountController::class, ['as' => 'admin']);
    });



    // Orders
    Route::prefix('admin/orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::get('/pending', [OrderController::class, 'pending'])->name('admin.orders.pending');
        Route::get('/approved', [OrderController::class, 'approved'])->name('admin.orders.approved');
        Route::get('/rejected', [OrderController::class, 'rejected'])->name('admin.orders.rejected');
        Route::get('orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
        Route::post('/change-address/{order}', [OrderController::class, 'changeAddress'])->name('change.address');
        Route::put('/change-status/{order}', [OrderController::class, 'changeStatus'])->name('change.status');
        Route::get('/orders/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.invoice');
    });


    // Customers
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers.index');

    // Sales
    Route::prefix('admin/sale/data')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('admin.sale.index');
        Route::get('/reports', [SalesController::class, 'reports'])->name('admin.sales.reports');
        Route::get('/transactions', [SalesController::class, 'transactions'])->name('admin.sales.transactions');
        Route::get('/invoices', [SalesController::class, 'invoices'])->name('admin.sales.invoices');
    });

    // Contacts
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
});




//Main Website Routes


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
