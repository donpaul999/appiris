<?php
    include('script.php');
    include('process_list.php');
    function run(&$trainName, &$trainValues){
            process_list($list_trains);
            //print_r($list_trains);
            $size = count($list_trains);
            for($i = 1; $i < $size; ++$i){
                $m = TrainCharac($list_trains[$i], $trainName[$i], $trainValues[$i]);
                //print_r($trainName);
                //print_r($trainValues);
                //echo "****\n";
            }
           return $list_trains;
    }
?>