<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set the write API key by default
        Xendit::setApiKey(env('XENDIT_WRITE_KEY'));
    }

    public function checkout(Request $request)
    {
        // Use the write API key for creating an invoice
        Xendit::setApiKey(env('XENDIT_WRITE_KEY'));

        $params = [
            'external_id' => 'order-' . time(),
            'amount' => 13500, // Replace with the actual amount
            'payer_email' => $request->input('email'),
            'description' => 'Order Payment'
        ];

        $invoice = \Xendit\Invoice::create($params);

        return redirect($invoice['invoice_url']);
    }

    public function getInvoiceDetails($invoiceId)
    {
        // Use the read API key for fetching invoice details
        Xendit::setApiKey(env('XENDIT_READ_KEY'));

        $invoice = \Xendit\Invoice::retrieve($invoiceId);

        return response()->json($invoice);
    }

    public function success()
    {
        return view('guest.success');
    }

    public function failed()
    {
        return view('guest.failed');
    }
}
