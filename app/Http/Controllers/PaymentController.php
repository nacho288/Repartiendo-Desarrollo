<?php

namespace App\Http\Controllers;

use App\PaymentGateway;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function getPaymentGateways()
    {
        $paymentGateways = PaymentGateway::where('is_active', 1)->get();
        // sleep(3);
        return response()->json($paymentGateways);
    }

    /**
     * @param Request $request
     */
    public function togglePaymentGateways(Request $request)
    {
        $paymentGateway = PaymentGateway::where('id', $request->id)->first();

        $activeGateways = PaymentGateway::where('is_active', '1')->get();

        if (!$paymentGateway->is_active || count($activeGateways) > 1) {
            $paymentGateway->toggleActive()->save();
            $success = true;
            return response()->json($success, 200);
        } else {
            $success = false;
            return response()->json($success, 401);
        }
    }

    /**
     * @param $payment_id
     * @param $payment_amount
     */
    public function processRazorpay($payment_id, $payment_amount)
    {
        $api_key = config('settings.razorpayKeyId');
        $api_secret = config('settings.razorpayKeySecret');

        $api = new Api($api_key, $api_secret);

        try {
            $order = $api->order->create([
                'amount' => $payment_amount, // amount in the smallest currency unit $money *100 ->coming from frontend
                // https://razorpay.freshdesk.com/support/solutions/articles/11000065530-what-currencies-does-razorpay-support -- See the list of supported currencies
                'currency' => config('settings.currencyId'),
            ]);
            $payment = $api->payment->fetch($payment_id);
            $payment->capture(array('amount' => $payment_amount));
            $response = [
                'razorpay_success' => true,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'razorpay_success' => false,
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }
    }

    /**
     * @param Request $request
     */
    public function processMercadoPago(Request $request)
    {
        \MercadoPago\SDK::setAccessToken('TEST-5261646553829581-041804-0fa632494c8a4be840db2db55541286a-548770938');

        $preference = new \MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new \MercadoPago\Item();
        $item->title = 'Purchase';
        $item->quantity = 1;
        $item->unit_price = 100;
        $preference->items = array($item);
        $preference->save();
        dd($preference);
        return response()->json($preference->id);

    }
}
