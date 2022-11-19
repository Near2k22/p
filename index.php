<?php

        $link = $_GET['v'];

        $ch =   curl_init();
                curl_setopt($ch, CURLOPT_URL, $link);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);

        if(preg_match_all('/id="OptL1"><iframe class="no-you" width="560" height="315" data-src="(.*)"/s', $resultado, $matches)){
            $explode = explode('"', $matches[1][0]);

            $respuesta = str_replace("//apialfa.tomatomatela.club/ir/player.php?h=", "", $explode[0]);
        }
    echo $respuesta;
?>
<?php

$url = "https://apialfa.tomatomatela.club/ir/rd.php";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "url=$respuesta";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
if(preg_match_all('/type="hidden" id="url" name="url" value="(.*)"/s', $resp, $matches)){
    $explode = explode('"', $matches[1][0]);

    $respuesta = str_replace("//apialfa.tomatomatela.club/ir/player.php?h=", "", $explode[0]);
}
echo $respuesta;
?>
