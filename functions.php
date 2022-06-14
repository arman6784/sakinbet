<?php

function new_order($api_token, $api_card_id, $amount, $callback_url, $order_id, $mobile = "")
{
    $send_data = array(
        "api" => $api_token,
        "amount" => $amount,
        "callback_url" => $callback_url,
        "card_id" => $api_card_id,
        "order_id" => $order_id,
        "mobile" => $mobile,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://market-shope.com/api/new_order');
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($send_data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//curl_setopt($ch, CURLOPT_SSL_VERBOSE, TRUE);  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function verify($api_token, $transId)
{
    $send_data = array(
        "api" => $api_token,
        "trans_id" => $transId,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://market-shope.com/api/verify');
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($send_data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

?>