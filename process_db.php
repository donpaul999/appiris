<?php
    require 'conectare.php';
    function remove_delay($id){
        global $conectare;
        $sql = "DELETE FROM delays WHERE ID_TREN= '$id'";
        $result = mysqli_query($conectare, $sql);
    }
    function add_delay($id, $delay, $date){
        global $conectare;
        $date = trim(preg_replace('/\t/', '', $date));
        $sql = "SELECT * FROM delays WHERE ID_TREN = '$id' ORDER BY ID DESC";
        $result = mysqli_query($conectare, $sql);
        $ok = 1;
        foreach ($result as $row){
            //echo $row["ID"].": ".$row["DELAY"];
            if($row["DATE"] == $date)
                $ok = 0;
            break;
        }
        if($ok == 1){
            $sql = "INSERT INTO delays(ID_TREN, DELAY, DATE) VALUES ('$id', '$delay', '$date')";
            $result = mysqli_query($conectare, $sql);
        }
    }
    function select_delays($id){
        global $conectare;
        $sql = "SELECT * FROM delays WHERE ID_TREN = '$id' ORDER BY DATE ASC";
        $result = mysqli_query($conectare, $sql);
        $data = array();
        foreach ($result as $row) {
        	$data[] = $row;
        }
        return $data;
   }
?>