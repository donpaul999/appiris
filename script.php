<?php
    function remove($text){
        $end = strpos($text, '>');
        $text = substr($text, $end);
        echo $text.'\n';
        return $text;
    }

?>