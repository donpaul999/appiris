<?php
    require 'conectare.php';
    function remove_delay($id, $date){
        global $conectare;
        $data = select_all_delays($id);
       // echo $date."\n";
        $date = strtotime($date);
        //print_r($data);
        $size = count($data);
        $list = [];
        if(!empty($data)){
            for($i = 0; $i < $size; ++$i){
                $date1 = strtotime($data[$i]["DATE"]);
                //echo $date1."\n";
                //echo "date1: ".$date1," date: ".$date.PHP_EOL;
               // echo ($date - $date1) / 86400;
                if(($date - $date1) / 86400 > 30){
                    array_push($list, $data[$i]["ID"]);
                }

            }
            $size = count($list);
            for($i = 0; $i < $size; ++$i){
                $sql = "DELETE FROM delays WHERE ID= '$list[$i]'";
                $result = mysqli_query($conectare, $sql);
            }
        }

    }
    function add_delay($id, $delay, $date, $station){
        global $conectare;
        if($date){
            $date = trim(preg_replace('/\t/', '', $date));
        }
        $sql = "SELECT * FROM delays WHERE ID_TREN = '$id' ORDER BY ID DESC";
        $result = mysqli_query($conectare, $sql);
        $ok = 1;
        if($result){
            foreach ($result as $row){
                //echo $row["ID"].": ".$row["DELAY"];
                if($row["DATE"] == $date)
                    $ok = 0;
                break;
            }
        }
        if($ok == 1){
            $sql = "INSERT INTO delays(ID_TREN, DELAY, DATE, STATION) VALUES ('$id', '$delay', '$date' , '$station')";
            $result = mysqli_query($conectare, $sql);
        }
    }

    function select_delays($id, $data){
        global $conectare;
        $txt = $data;
        $txt[0] = $data[3];
        $txt[1] = $data[4];
        $txt[2] = '.';
        $txt[5] = '.';
        $txt[3] = $data[0];
        $txt[4] = $data[1];
        $data = $txt;
        //echo $data;
        $sql = "SELECT * FROM delays WHERE ID_TREN = '$id' AND DATE LIKE '{$data}%' ORDER BY DATE ASC";
        $result = mysqli_query($conectare, $sql);
        $data = array();
        foreach ($result as $row) {
        	$data[] = $row;
        }
        return $data;
   }

   function select_all_delays($id){
           global $conectare;
           $sql = "SELECT * FROM delays WHERE ID_TREN = '$id' ORDER BY DATE ASC";
           $result = mysqli_query($conectare, $sql);
           $data = array();
           if($result != null){
               foreach ($result as $row) {
                $data[] = $row;
               }
           }
           return $data;
      }
?>