<?php
    include_once('process_db.php');
    global $data;
    function delay($id){
            $data = select_delays($id);
    }
    echo json_encode($data);
    //echo json_last_error_msg();
?>