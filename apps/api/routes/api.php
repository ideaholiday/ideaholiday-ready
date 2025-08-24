<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TenantMiddleware;
use App\Http\Controllers\Api\PingController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\WebhookController;

Route::middleware([TenantMiddleware::class])->group(function () {
    Route::get('/ping', [PingController::class, 'ping']);
    Route::post('/v1/search/flights', [SearchController::class, 'search']);
    Route::post('/v1/offers/{id}/price', [SearchController::class, 'price']);
    Route::post('/v1/bookings', [BookingController::class, 'book']);
    Route::get('/v1/bookings/{id}', [BookingController::class, 'show']);
    Route::post('/v1/payments/razorpay/webhook', [WebhookController::class, 'razorpay']);
    Route::post('/v1/payments/easebuzz/webhook', [WebhookController::class, 'easebuzz']);
});
