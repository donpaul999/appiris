<?php

    include('script.php');
    include('process_list.php');
    process_list($list_trains);
    print_r($list_trains);
    $size = count($list_trains);
    for($i = 1; $i < $size; ++$i){
        TrainCharac($list_trains[$i], $trainName, $trainValues);
        print_r($trainName);
        print_r($trainValues);
    }

?>
