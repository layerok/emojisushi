<?php
namespace App\Libraries;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class Poster {

    private $token = "";

    public function __construct($token){
        $this->token = $token;
    }

    public function sendRequest($url, $type = 'get', $params = [], $json = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if ($type == 'post' || $type == 'put') {
            curl_setopt($ch, CURLOPT_POST, true);

            if ($json) {
                $params = json_encode($params);

                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($params)
                ]);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            }
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Poster (http://joinposter.com)');

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public function query($name){
        $url = "https://joinposter.com/api/{$name}"
            . '?token='.$this->token;

        $response = $this->sendRequest($url);

        return $response;
    }

    public function sendOrder($data) {
        $url = 'https://joinposter.com/api/incomingOrders.createIncomingOrder'
            . '?token='.$this->token;

        $response = $this->sendRequest($url, 'post', $data);

        return $response;
    }

    public function sendOrderById($id){
        if(isset($id)){
            $order = Order::with(['products.product', 'products.attributeValue', 'delivery', 'payment'])->find($id);

            if($order){

                $products = [];

                foreach($order->products as $value){


                    $product = [
                        'product_id' => $value->product->poster_id,
                        'count'      => $value->quantity
                    ];

                    $modificator = [];
                    if(isset($value->attribute_value_id)){
                        $modificator = [
                            'modificator_id' => $value->attributeValue->poster_id
                        ];
                    }

                    $products[] = array_merge($product, $modificator);
                }

                $payment = [];

                if($order->payment_status_id == 3){// id успешного статуса оплаты
                    $payment = [
                        'payment'=> [
                            'type' => 1,
                            'sum' => $order->sum,
                            'currency' => 'UAH'
                        ]
                    ];
                }

                $comment = "|| Способ оплаты: " . $order->payment->name
                    ." || Способ доставки: " . $order->delivery->name;

                $order_params = [
                    'spot_id' => 1,
                    'first_name' => $order->first_name,
                    'phone'      => $order->phone,
                    'email'      => $order->email,
                    'comment'    => $order->comment . $comment,
                    'address'    => $order->address,
                    'products'   => $products
                ];

                $order_params = array_merge($order_params, $payment);



                $bot = new Telegram(env('TELEGRAM_BOT_ID'), env('TELEGRAM_CHAT_ID'));
                $bot->sendOrder($id);

                $response = $this->sendOrder($order_params);

                $decoded_response = json_decode($response, true);

                if(!isset($decoded_response['error'])){
                    $order->update(['is_sent_to_poster' => 1]);
                    Log::channel('single')->debug('Заказа №'. $order->id . " отправлен на постер");
                }

                return $response;

            }
            return false;
        }
        return false;
    }
}
