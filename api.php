<?php
//header("Refresh: 2;url=http://localhost:8080/apiweb/cost.php");

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

$status = curl_get("https://api.rajaongkir.com/starter/province");

$decode = json_decode($status,true);
//print_r($decode);
//$val = $_POST['value'];
//echo $_POST['selectBox'];
?>

<html>
<html lang=".'en'.">
<head>
    <meta charset=".'UTF-8'.">
    <meta http-equiv=".'X-UA-Compatible'." content=".'IE=edge'.">
    <meta name=".'viewport'." content=".'width=device-width, initial-scale=1.0'.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>

    <div class="container mt-4">
        <form method="POST" onsubmit="return false">
            <div class="row">
                <h4>Pengirim</h4>
                <div class="col">
                        <select class="form-select" aria-label="Default select example" name="provinsi" id="provinsi">
                        <option selected>Pilih Provinsi</option>
                        <?php 
                        foreach($decode['rajaongkir']['results'] as $idx => $prov){
                            echo '<option value="'.$prov['province_id'].'">'.$prov['province'].'</option>';
                        }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" id="kota" name="kota">
                            <option selected>Pilih Provinsi dulu</option>
                        </select>
                </div>
            </div>
            <div class="row mt-4">
                <h4>Penerima</h4>
                <div class="col">
                        <select class="form-select" aria-label="Default select example" name="provinsiPenerima" id="provinsiPenerima">
                        <option selected>Pilih Provinsi</option>
                        <?php 
                        foreach($decode['rajaongkir']['results'] as $idx => $prov){
                            echo '<option value="'.$prov['province_id'].'">'.$prov['province'].'</option>';
                        }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="kotaPenerima" id="kotaPenerima">
                            <option selected>Pilih Provinsi dulu</option>
                        </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                        <select class="form-select" aria-label="Default select example" name="ekspedisi" id="ekspedisi">
                            <option selected>Pilih Jasa</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS</option>
                        </select>
                </div>
                <div class="col">
                        <input class="form-control" id="gram" name="gram" type="number" placeholder="gram">
                </div>
            </div>
           <input type="submit"class="btn btn-primary mt-4" id="button">
        </form>
        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Service</th>
                <th>Description</th>
                <th>Harga</th>
                <th>Estimasi Hari</th>
            </tr>
        </thead>   
    </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<!-- <script src="./test.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    
   document.getElementById('provinsi').addEventListener('change',function(){
    const frmAddNumbers = new FormData(); // create single instance
       fetch("http://localhost:8080/apiweb/getCity.php/?city="+this.value,{
           method:'GET',
       })
       .then((response) => response.text())
       .then((data) => {
           console.log(data)
           document.getElementById('kota').innerHTML = data
       })
   })
   document.getElementById('provinsiPenerima').addEventListener('change',function(){
    const frmAddNumbers = new FormData(); // create single instance
       fetch("http://localhost:8080/apiweb/getCity.php/?city="+this.value,{
           method:'GET',
       })
       .then((response) => response.text())
       .then((data) => {
           console.log(data)
           document.getElementById('kotaPenerima').innerHTML = data
       })
   })

   document.getElementById('example').style.visibility = "hidden";

   document.getElementById('button').addEventListener('click',function(){
   

    var provinsi = $("select#provinsi").val()
    var kota = $("select#kota").val()
    var provinsi_terima = $("select#provinsiPenerima").val()
    var kota_terima = $("select#kotaPenerima").val()
    var ekspedisi = $("select#ekspedisi").val()
    var gram = $("input#gram").val()

    var data = 'provinsi='+provinsi+'&kota='+kota+'&provinsiPenerima='+provinsi_terima+'&kotaPenerima='+kota_terima+'&ekspedisi='+ekspedisi+'&gram='+gram
    $.ajax({
        type:"POST",
        url:'cost.php',
        data:data
    })
    document.getElementById('example').style.visibility = "visible";

    
     var table = $('#example').DataTable( {
            retrieve: true,
            paging: false,
            "ajax": './data.txt',
            "columns": [
        {"data": "service"},
        {"data": "description"},
        {"data":"cost.0.value"},
        {"data":"cost.0.etd"}
       
        ]
            
        } );
  

    setInterval( function () {
        table.ajax.reload();
    },1000 );

   
   })

   

   

</script>
</html>


