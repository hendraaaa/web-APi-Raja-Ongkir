<?php
$apikeyrajaongkir = "f5e0552661b9e20fe7392b68e87105b4";
function curl_get($url){
	global $apikeyrajaongkir;
	if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', "key: $apikeyrajaongkir"));
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
	//return json_decode($result,true);
}
$nama =  $_GET['city'];
$data = json_decode($status = curl_get("https://api.rajaongkir.com/starter/city?&province=".$nama),true);
// print_r($data['rajaongkir']['results']);
echo '<option value="">Pilih kota</option>';
foreach($data['rajaongkir']['results'] as $kt){
	echo '<option value="'.$kt['city_id'].'">'.$kt['city_name'].'</option>';

}



?>