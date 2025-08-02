<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use App\Models\Form;

class MamoPaymentController extends Controller
{
    public function payment(){

        return view('payment');
    }
   public function handle(Request $request)
    {
        $payload = $request->all();
        //\Log::info('Mamo webhook received', $payload);

        $mamoId = $payload['id'] ?? null;
        $status = $payload['status'] ?? null;

        if ($mamoId && $status === 'paid') {
            $payment = Payment::where('mamo_id', $mamoId)->first();

            if ($payment && $payment->status !== 'paid') {
                $payment->status = 'paid';
                $payment->save();
            }
        }

        return response()->json(['message' => 'Webhook handled']);
    }

        public function paymentSuccess(Request $request)
        {
            $chargeUID = $request->input('chargeUID');
            $status = $request->input('status'); // captured, failed, etc.
            $paymentLinkId = $request->query('paymentLinkId');

            if ($status === 'captured') {
                $payment = Payment::where('mamo_id', $paymentLinkId)->first();

                if ($payment && $payment->status !== 'paid') {
                    $payment->mamo_id = $chargeUID;
                    $payment->status = 'paid';
                    $payment->save();
                }
            }

            return view('payments.success');
        }
    public function createPayment(Request $request)
    {

        $application = Form::findOrFail(decrypt($request->application_id));
        //dd($application);

        $payload = [
            'title' => 'Yemen Embassy',
            'description' => 'Application payment',
            'active' => true,
            'return_url' => route('payment.success'), // You can change this
            'failure_return_url' => 'https://failureurl.com/paymentFailure',
            'processing_fee_percentage' => 0,
            'amount' => 2.00,
            'amount_currency' => 'AED',
            'link_type' => 'standalone',
            'enable_tabby' => false,
            'enable_message' => false,
            'enable_tips' => false,
            'save_card' => 'off',
            'enable_customer_details' => false,
            'enable_quantity' => false,
            'enable_qr_code' => false,
            'send_customer_receipt' => false,
            'hold_and_charge_later' => false
        ];

        $response = Http::withToken(config('certificate.mamo_api_secret'))->withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ])->post(config('certificate.mamo_api_url'), $payload);
        
        $data = $response->json();

            if ($response->successful() && isset($data['payment_url'])) {
                // Store in DB
                Payment::create([
                    'mamo_id' => $data['id'],
                    'short_url' => $data['payment_url'],
                    'user_id' => auth()->id(),
                    'form_id' => $application->id, // pass from frontend
                    'amount' => 2.00, // in fils (2.00 AED)
                    'currency' => 'AED',
                    'description' => 'Application payment',
                    'status' => 'pending',
                ]);

                return redirect()->away($data['payment_url']);
            }

            return back()->with('error', 'Payment initiation failed.');
            }
}
