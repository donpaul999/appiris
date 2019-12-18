<?php

    include('process_db.php');
    function TrainCharac($nrTren, &$trainName, &$trainValues){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://appiris.infofer.ro');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=%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%2BQoQTRtCS%2Bnaaq6fYY3XPyxUqhvT&__VIEWSTATEGENERATOR=86BE64DB&TextTrnNo=".$nrTren."&Button1=Informatii+tren");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        //echo $result;
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $tags = explode('<td',$result);
        $index = strpos($result, "Trenul nu este în programul curent de circulație.");
        if($index != null){
             throw new Exception('Trenul selectat nu exista in programul curent de circulatie!');
        }
         foreach ($tags as $tag)
         {
           // get text
           $text = strip_tags('<'.$tag);
           $text = preg_replace("/\<([^)]+\>)/","",$text);
           $text = preg_replace( "/\r|\n/", "", $text);
           // only if text present remember
           if (trim($text) != '') $texts[] = $text;
         }
         //DATE FIX
         if($texts[17]){
            $mod = $texts[17];
            $aux1 = $mod[0];
            $aux2 = $mod[1];
            $mod[0] = $mod[3];
            $mod[1] = $mod[4];
            $mod[3] = $aux1;
            $mod[4] = $aux2;
            $texts[17] = $mod;
        }

        //RANG FIX
        $texts[5] = preg_replace('/\s+/', '',$texts[5]);
        if(count($texts) > 20){
            $trainName=["ID", $texts[4], $texts[6], $texts[8], $texts[10], $texts[12], $texts[14], $texts[16], $texts[18]];
            $trainValues=[$nrTren, $texts[5], $texts[7], $texts[9], $texts[11], $texts[13], $texts[15], $texts[17], $texts[19]];
            if(strpos($texts[13],"destinatie") != null){
                 remove_delay($nrTren, $texts[17]);
                 //echo $nrTren;
                 array_push($trainName, $texts[20], $texts[21], $texts[22], $texts[23], $texts[24], $texts[26]);
                 array_push($trainValues, " ", " ", " ", " ", $texts[25], $texts[27]);

            }
            else{
                 //echo $nrTren;
                 add_delay($nrTren, $texts[19], $texts[17], $texts[15]);
                 array_push($trainName, $texts[20], $texts[22], $texts[24], $texts[26], $texts[28], $texts[30]);
                 array_push($trainValues, $texts[21], $texts[23] , $texts[25], $texts[27], $texts[29], $texts[31]);
            }
        }

        //print_r($trainName);
        //print_r($trainValues);
        //print_r($texts);
    }
?>
