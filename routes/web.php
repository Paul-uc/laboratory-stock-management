<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadPdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LossStockPdfController;
use App\Http\Controllers\PDFController;

use App\Http\Controllers\ReturnStockPdfController;
use App\Http\Controllers\SentLossStockPdfController;
use App\Http\Controllers\SentReturnStockPdfController;
use App\Http\Controllers\TermsAndConditionsController;

use App\Models\Approval;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/loans', LoanController::class,);

    Route::get('/{record}/DowloadApproval/download', [DownloadPdfController::class, 'download'])->name('approval.pdf.download');
    Route::get('/{record}/DowloadReturnStock/dowload', [ReturnStockPdfController::class, 'download'])->name('returnStock.pdf.download');
    Route::get('/{record}/DowloadLossStock/dowload', [LossStockPdfController::class, 'download'])->name('lossStock.pdf.download');

    Route::get('/categories/{category}', function (Category $category) {
        return response()->json($category);
    });

    Route::get('/{record}/SentApproval/index', [PDFController::class, 'index'])->name('approval.download');
    Route::get('/{record}/SentReturnStock/index', [SentReturnStockPdfController::class, 'index'])->name('returnStock.download');
    Route::get('/{record}/SentLossStock/index', [SentLossStockPdfController::class, 'index'])->name('lossStock.download');

    Route::get('/terms-and-conditions/index', [TermsAndConditionsController::class, 'index'])->name('terms-and-conditions');
    Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact');
    Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.send');
   


    Route::middleware(['auth', 'admin'])->group(function () {
        // Admin and Superadmin-specific routes here
    });
});


require __DIR__ . '/auth.php';
