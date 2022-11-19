<?php

        $link = $_GET['v'];

        $ch =   curl_init();
                curl_setopt($ch, CURLOPT_URL, $link);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);

        if(preg_match_all('/id="OptL1"><iframe class="no-you" width="560" height="315" data-src="(.*)"/s', $resultado, $matches)){
            $explode = explode('"', $matches[1][0]);

            $respuesta = str_replace("\/", "/", $explode[0]);
        }
    echo $respuesta;
?>
