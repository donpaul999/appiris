<?php
    include_once('run.php');
    $trainNames = [];
    $trainValues = [];
    while(True) {
      sleep(60);
      run($trainNames, $trainValues);
    }
?>