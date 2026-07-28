<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DownloadPageController;
use App\Http\Controllers\DownloadSectionController;
use App\Http\Controllers\SystemCommandController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SeoMetaController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/updateSlug',      [ProductController::class, 'updateSlug']);

/* ---------- Public ---------- */
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

/* ---------- Protected ---------- */
Route::middleware('auth:api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me',      [AuthController::class, 'me']);
        Route::post('/refresh',    [AuthController::class, 'refresh']);
        Route::post('/change-password', [AuthController::class, 'changePassword'])
        ->name('auth.change-password');
    });

    // Category
    Route::prefix('categories')->group(function () {
        Route::get('/',        [CategoryController::class, 'index']);
        Route::post('/store',       [CategoryController::class, 'store']);
        Route::post('{id}/update',     [CategoryController::class, 'update']);
        Route::delete('{id}/delete',  [CategoryController::class, 'destroy']);
    });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/',        [ProductController::class, 'index']);
        Route::post('/',       [ProductController::class, 'store']);
        Route::get('{id}/show',             [ProductController::class, 'show']);
        Route::get('{slug}/show',             [ProductController::class, 'showBySlug']);
        Route::post('{id}/update',     [ProductController::class, 'update']);
        Route::delete('{id}/delete',  [ProductController::class, 'destroy']);
        Route::get('by-category/{categoryId}', [ProductController::class, 'byCategory']);
        Route::delete('/{product}/image/{type}', [ProductController::class, 'deleteImage']);
        Route::delete('delete/galleryimages/{id}', [ProductController::class, 'deleteGalleryImage']);
    });

    Route::post(
        '/system/optimize-clear',
        [SystemCommandController::class, 'optimizeClear']
    );

    Route::prefix('downloads')->group(function () {
        /* ===== DOWNLOAD PAGES ===== */
        Route::get('/',        [DownloadPageController::class, 'index']);
        // Route::post('/',       [DownloadPageController::class, 'store']);
        Route::get('{slug}/',     [DownloadPageController::class, 'show']);
        // Route::put('{id}/update',     [DownloadPageController::class, 'update']);
        // Route::delete('{id}/delete',  [DownloadPageController::class, 'destroy']);

        Route::post('/',       [DownloadController::class, 'store']);
        Route::post('{id}/update',       [DownloadController::class, 'update']);

        Route::get('/page/{slug}', [DownloadController::class, 'show']);
        Route::delete('/page/{id}/delete',  [DownloadController::class, 'destroy']);

        /* ===== SECTION DOCUMENTS ===== */
        Route::post(
            '/sections/{sectionId}/documents',
            [DownloadController::class, 'attachDocument']
        );

        Route::delete(
            '/sections/{sectionId}/documents/{documentId}',
            [DownloadController::class, 'detachDocument']
        );

        Route::patch(
            '/sections/{sectionId}/documents/{documentId}/toggle',
            [DownloadController::class, 'toggleDocumentVisibility']
        );
        // Route::get('manual', [DownloadController::class, 'getManualDownloadList']);
    });
    Route::get('manual', [DownloadController::class, 'getManualDownloadList']);

    Route::prefix('download/section')->group(function () {
        /* ===== DOWNLOAD SECTIONS ===== */
        Route::get('/page/{pageId}', [DownloadSectionController::class, 'index']);
        Route::post('/',             [DownloadSectionController::class, 'store']);
        Route::get('{id}',           [DownloadSectionController::class, 'show']);
        Route::put('{id}',           [DownloadSectionController::class, 'update']);
        Route::delete('{id}',        [DownloadSectionController::class, 'destroy']);
    });

    Route::prefix('blogs')->group(function () {
        Route::get('/', [BlogController::class, 'index']);
        Route::post('/', [BlogController::class, 'store']);
        Route::get('/{id}', [BlogController::class, 'showById']);
        Route::get('/slug/{slug}', [BlogController::class, 'showBySlug']);
        Route::post('/{id}/update', [BlogController::class, 'update']);
        Route::delete('/{id}/delete', [BlogController::class, 'destroy']);
        Route::get('/categories/{categoryId}/blogs', [BlogController::class, 'blogsByCategory']);
    });

    Route::prefix('enquiry')->group(function () {
        Route::get('/', [EnquiryController::class, 'index']);
        Route::post('/', [EnquiryController::class, 'store']);
        Route::get('/{id}/show', [EnquiryController::class, 'show']);
        // Route::put('/{id}', [EnquiryController::class, 'update']);
        Route::delete('/{id}/delete', [EnquiryController::class, 'destroy']);
        Route::post('fetch-and-mark-read', [EnquiryController::class, 'fetchAndMarkRead']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}/show', [UserController::class, 'show']);
        Route::put('/{id}/update', [UserController::class, 'update']);
        Route::delete('/{id}/delete', [UserController::class, 'destroy']);
    });

    Route::prefix('accessary')->group(function () {
        Route::get('/', [AccessoryController::class, 'index']);
        Route::post('/', [AccessoryController::class, 'store']);
        Route::get('/{id}/show', [AccessoryController::class, 'show']);
        Route::post('/{id}/update', [AccessoryController::class, 'update']);
        Route::delete('/{id}/delete', [AccessoryController::class, 'destroy']);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index']);
        // Route::post('/', [UserController::class, 'store']);
        // Route::get('/{id}/show', [UserController::class, 'show']);
        // Route::put('/{id}/update', [UserController::class, 'update']);
        // Route::delete('/{id}/delete', [UserController::class, 'destroy']);
    });

    Route::prefix('service')->group(function () {
        Route::get('/', [ServiceController::class, 'index']);
    });
    Route::prefix('contact')->group(function () {
        Route::get('/', [EnquiryController::class, 'getContact']);
    });

    Route::prefix('seo')
        ->name('seo.')
        ->controller(SeoMetaController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::post('/', 'store')
                ->name('store');

            Route::get('/{id}/show', 'show')
                ->name('show');

            Route::post('/{id}/update', 'update')
                ->name('update');

            Route::delete('/{id}/delete', 'destroy')
                ->name('destroy');

            // Frontend SEO Fetch Routes
            Route::get('/page/{pageType}', 'getSeo')
                ->name('page');

            Route::get('/page/{pageType}/{referenceId}', 'getSeo')
                ->name('page.reference');
        });
});
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard']);
});
