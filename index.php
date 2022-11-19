<?php

        $link = $_GET['v'];

        $ch =   curl_init();
                curl_setopt($ch, CURLOPT_URL, $link);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);

        if(preg_match_all('/apialfa.tomatomatela.club(.*)"/', $resultado, $matches)){
            $explode = explode('"', $matches[1][0]);

            $respuesta = str_replace("\/", "/", $explode[0]);
        }
    echo $link;
?>
