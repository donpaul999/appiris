<?php
    function process_list(&$array){
        $file = "trains.txt";

        $fopen = fopen($file, 'r');

        $fread = fread($fopen,filesize($file));

        fclose($fopen);

        $remove = "\n";

        $split = explode($remove, $fread);

        $array[] = null;
        $tab = "\t";

        foreach ($split as $string)
        {
            array_push($array,$string);
            //echo $string;
        }

    }

    function add_train($train){

        $file = "trains.txt";
        file_put_contents($file, $train . PHP_EOL, FILE_APPEND | LOCK_EX);

    }

?>