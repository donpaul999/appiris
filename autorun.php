<?php
    include_once('run.php');
    $trainNames = [];
    $trainValues = [];
    while(True) {
      run($trainNames, $trainValues);
      sleep(60);
    }
?>