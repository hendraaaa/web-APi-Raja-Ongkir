<?php
    $apikeyrajaongkir = "f5e0552661b9e20fe7392b68e87105b4";
    function curl_post($url,$origin,$destination,$weight,$courier){
        global $apikeyrajaongkir;
        if (!function_exists('curl_init')){ 
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', "key: $apikeyrajaongkir"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('origin'=> $origin, 'destination'=> $destination,'weight'=>$weight,'courier'=>$courier)));
        $result=curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    $provinsi = $_POST['provinsi'];
    $kota =  $_POST['kota'];
    $provinsi_penerima = $_POST['provinsiPenerima'];
    $kota_penerima = $_POST['kotaPenerima'];
    $ekspedisi = $_POST['ekspedisi'];
    $gram = $_POST['gram'];
    
    $stts = curl_post('https://api.rajaongkir.com/starter/cost',$kota,$kota_penerima,$gram,$ekspedisi);
    $decode = json_decode($stts,true);
    //print_r($decode['rajaongkir']['results'][0]['costs']);
    $dataJson['data'] = $decode['rajaongkir']['results'][0]['costs'];
   // echo json_encode($dataJson);
    file_put_contents('data.txt',json_encode($dataJson));
    // header("Location: http://localhost:8080/apiweb/api.php");
    // die();
?>