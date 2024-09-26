<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;

class PaymentController extends Controller
{
    var $apiInstance = null;

    public function __construct()
    {
        // Set the Xendit API key
        Configuration::setXenditKey(env('XENDIT_WRITE_KEY'));
    }


    public function store(Request $request)
    {
        Configuration::setXenditKey(env('XENDIT_WRITE_KEY'));
        $apiInstance = new InvoiceApi();

        $external_id = $request->input('external_id');
        $total = $request->input('total');
        $success_redirect_url = route('payment.success');
        $failure_redirect_url = route('payment.failed');

        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => $external_id,
            'description' => $external_id,
            'amount' => $total,
            'invoice_duration' => 172800,
            'currency' => 'PHP',
            'reminder_time' => 1,
            'success_redirect_url' => $success_redirect_url,
            'failure_redirect_url' => $failure_redirect_url
        ]);

        try {
            $result = $apiInstance->createInvoice($create_invoice_request);
            return response()->json(['message' => 'Invoice created successfully', 'data' => $result]);

        } catch (\Xendit\XenditSdkException $e) {
            return response()->json(['message' => 'Exception when calling InvoiceApi->createInvoice: ' . $e->getMessage(), 'full_error' => $e->getFullError()], 500);
        }
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
