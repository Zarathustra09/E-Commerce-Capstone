<?php

use App\Http\Controllers\PaymentController;
use GlennRaya\Xendivel\Xendivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/checkout', function () {
    return view('guest.checkout');
});

Route::get('/checkout-xendit', function () {
    return view('vendor.xendivel.checkout');
});

Route::post('/pay-with-card', function (Request $request) {
    $invoice_data = [
        'invoice_number' => 1000023,
        'card_type' => 'VISA',
        'masked_card_number' => '400000XXXXXX0002',
        'merchant' => [
            'name' => 'Stark Industries',
            'address' => '152 Maple Avenue Greenfield, New Liberty, Arcadia USA 54331',
            'phone' => '+63 971-444-1234',
            'email' => 'xendivel@example.com'
        ],
        'customer' => [
            'name' => 'Mr. Glenn Raya',
            'address' => 'Alex Johnson, 4457 Pine Circle, Rivertown, Westhaven, 98765, Silverland',
            'email' => 'victoria@example.com',
            'phone' => '+63 909-098-654'
        ],
        'items' => [
            [
                'item' => 'MacBook Pro 16" M3 Max',
                'price' => $request->amount,
                'quantity' => 1
            ]
        ],
        'tax_rate' => 0.12,
        'tax_id' => '123-456-789',
        'footer_note' => 'Thank you for your recent purchase with us! We are thrilled to have the opportunity to serve you and hope that your new purchase brings you great satisfaction.'
    ];
  $payment = Xendivel::payWithCard($request)
      ->emailInvoiceTo('zarathustra@gmail.com',$invoice_data)
      ->send()
      ->getResponse();

  return $payment;
});

