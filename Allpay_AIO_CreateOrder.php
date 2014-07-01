<?php

//------------------------------------------傳送交易------------------------------------------------------
//訂單編號
$trade_no = "000001";
//交易金額
$total_amt = "500";
//交易描述
$trade_desc = "test_shop";
//如果商品名稱有多筆，需在金流選擇頁一行一行顯示商品名稱的話，商品名稱請以井號分隔(#)
$item_name = "test1";
//交易返回頁面
$return_url = "http://test.com.tw";
//交易通知網址
$client_back_url = "http://test.com.tw";
//選擇預設付款方式
$choose_payment = "WebATM";
//交易網址
$gateway_url = "http://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
//商店代號
$merchant_id = "2000132";
//hashkey
$hash_key = "5294y06JbISpM5x9";
//iv
$hash_iv = "v77hoKGq4kWxNNIS";


$form_array = array(
    "MerchantID" => $merchant_id,
    "MerchantTradeNo" => $trade_no,
    "MerchantTradeDate" => date("Y/m/d H:i:s"),
    "PaymentType" => "aio",
    "TotalAmount" => $total_amt,
    "TradeDesc" => $trade_desc,
    "ItemName" => $item_name,
    "ReturnURL" => $return_url,
    "ChoosePayment" => $choose_payment,
    "ClientBackURL" => $client_back_url,
);
ksort($form_array);
$encode_str = "HashKey=" . $hash_key . "&" . urldecode(http_build_query($form_array)) . "&HashIV=" . $hash_iv;
$encode_str = urlencode($encode_str);
$encode_str = strtolower($encode_str);
$CheckMacValue = strtoupper(md5($encode_str));

$form_array["CheckMacValue"] = $CheckMacValue;
$html_code = '<form target="_blank" method=post action="' . $gateway_url . '">';
foreach ($form_array as $key => $val) {
    $html_code .= "<input type='text' name='" . $key . "' value='" . $val . "'><BR>";
}
$html_code .= "<input type='submit' value='送出'>";
$html_code .= "</form>";
echo $html_code;
?>
