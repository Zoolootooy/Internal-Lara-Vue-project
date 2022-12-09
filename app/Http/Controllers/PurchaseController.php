<?php

namespace App\Http\Controllers;

use App\Models\Order as Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Http\Requests\OrderRequest as Request;
use App\Models\Product;
use App\Payments\LiqPay;

class PurchaseController extends Controller
{
    public function makeOrder(Request $request)
    {
        $order = new Model;
        $order->fill($request->all());
        if ($request->input('extern_cards') == 1) {
            $order->total_price = $request->extra_card_price + $request->price;
            $order->extra_cards_price = $request->extra_card_price;
        }

        if ($request->extern_cards == 0) {
            $order->total_price = $request->extra_card_price;
        }

        foreach ($request->extern_cards_list as $extra) {
            $order->extern_cards_list .= $extra . "\n";
        }
        echo($order);
        $order->save();

        $mail = ['user_email' => $request->email,
            'user_name' => $request->full_name,
            'sender_site' => "http://internal-english-bg",
            'extern_cards' => $request->extern_cards,
            'extern_cards_list' => $request->extern_cards_list,
            'address' => $request->address,
            'price' => $request->price,
            'external_cards_price' => $request->extra_card_price,
            'total_price' => $request->extra_card_price + $request->price,
            'order_id' => $order["id"],
            'phone' => $request->phone];
        return Mail::to($request->email)->send(new ContactMail($mail));
    }

    public function deliveryPayment(Request $request)
    {
        $order = new Model;
        $request_url = $request->request_url;
        $order->fill($request->all());
        if ($request->input('extern_cards') == 1) {
            $order->total_price = $request->extra_card_price + $request->price;
            $order->extra_cards_price = $request->extra_card_price;
        }

        if ($request->extern_cards == 0) {
            $order->total_price = $request->extra_card_price;
        }

        foreach ($request->extern_cards_list as $extra) {
            $order->extern_cards_list .= $extra . "\n";
        }

        $order->save();
        $description = "Вы покупаете:\n Основной набор карт.\n";
        if ($request->extern_cards_list) {
            if (count($request->extern_cards_list) > 1)
                $description .= "С дополнительными наборами:\n";
            else
                $description .= "С дополнительным набором карт:\n";
            foreach ($request->extern_cards_list as $extra) {
                $description .= "\t" . $extra . "\n";
            }
            $description .= "На сайте http://internal-english-bg";
        }
        $privareKey = 'sandbox_7RyCMX21JosBxFeGdLbCdxiL7BRmpnQYtEYZfwlw';
        $publicKey = 'sandbox_i59228289026';
//        $liqpay = new LiqPay($publicKey, $privareKey);//use this part of code to check data generation
//        $payForm = $liqpay->cnb_form(array(
//            'public_key' => $publicKey,
//            'action' => 'pay',
//            'language' => 'ru',
//            'amount' => intval($request->extra_card_price + $request->price),
//            'currency' => 'UAH',
//            'description' => $description,
//            'server_url' => 'http://127.0.0.1:8000/updateOrderStatus',
//            'order_id' => $order->id,
//            'version' => '3',
//            'result_url' => $request->site
//        ));
        $data = base64_encode('{"public_key":"' . $publicKey . '","action":"pay","language":"ru","amount":' . intval($request->extra_card_price + $request->price) . ',"currency":"UAH","description":"' . $description . '","order_id":' . $order->id . ',"version":"3","result_url":"' . $request_url . '","server_url":"' . $request_url . '"}');
        $signature = sha1($privareKey . $data . $privareKey, 1);
        $sign_string = base64_encode($signature);
        return ['data' => $data,
            'signature' => $sign_string];
    }


    public function updateOrderStatus()
    {
        $data = base64_decode($_POST["data"]);
        if($data != null){
            preg_match('/(?<=\"payment_id\":)(.+?)(?=,)/', $data, $output_array);
            $payment_id = $output_array;
            preg_match('/(?<=\"order_id\":\")(.+?)(?=\",)/', $data, $output_array);
            $order_id = $output_array[0];
            preg_match('/(?<=\"status\":\")(.+?)(?=\",)/', $data, $output_array);
            $status = $output_array[0];

            $order = Model::find($order_id);
            if ($status == "success")
                $order->status = 1;
            else
                $order->status = 5;
            $order->transaction_id = $payment_id;
            $order->save();
            $mail = ['user_email' => $order->email,
                'user_name' => $order->full_name,
                'sender_site' => "http://internal-english-bg",
                'extern_cards' => $order->extern_cards,
                'extern_cards_list' => explode("\n", $order->extern_cards_list),
                'address' => $order->address,
                'price' => ($order->total_price - $order->extra_cards_price) . " грн",
                'external_cards_price' => $order->extra_card_price,
                'total_price' => $order->total_price,
                'order_id' => $order["id"],
                'phone' => $order->phone];
            Mail::to($order->email)->send(new ContactMail($mail));
            return $this->view('home.paymentSuccessfully', ['status' => $status]);
        }
        return $this->view('home.paymentSuccessfully', ['status' => 'error']);
    }

    public function getTags()
    {
        return Product::where('type', '1')->orderBy('name')->get();
    }
}
