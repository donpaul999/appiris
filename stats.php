<?php
    require 'conectare.php';
    require 'run.php';
    include_once('process_db.php');
    $trainName = [];
    $trainValues = [];
    $train = 0;
    $list_trains = run($trainName, $trainValues);
    $size = count($list_trains);
    $data = [];
    if(isset($_POST['NRT'])){
        $ok = 0;
        $selected_val = $_POST['NRT'];
        for($i = 1; $i < $size && !$ok; $i++){
            if($selected_val == $list_trains[$i])
                {
                    $data = select_delays($list_trains[$i]);
                    $ok = 1;
                    $train = $i;
                    //echo $trainValues[$train][1]."txt";
                }
        }
        if(!$ok)
            echo "Trenul selectat nu exista!";
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
    var data = <?php echo json_encode($data, JSON_HEX_TAG); ?>;
    var dpoints = [];
    var title_s = "Intarzieri tren " + "<?php echo $trainValues[$train][1]; ?> "+ <?php echo $list_trains[$train];?>;
   // dpoints.push({x: new Date(data[0].DATE), y:10});
    dpoints.push({x: new Date(data[0].DATE), y:parseInt(data[0].DELAY)});
                //console.log(data[0].DATE, data[0].DELAY);
    for (var i = 1; i < data.length; i++ ) {
         if(data[i].DATE != data[i - 1].DATE){
            dpoints.push({x: new Date(data[i].DATE), y:parseInt(data[i].DELAY)});
            //console.log(data[i].DATE, data[i].DELAY);
         }
        }
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: title_s
	},
	axisY:{
		includeZero: false
	},
	data: [{
		type: "line",
		dataPoints: dpoints,

	}]
});

chart.render();

}


</script>
</head>
<body>
<form method="post" action="#">
	<input type="text" name="NRT" placeholder="Numarul trenului">
	<input type="submit" value="Cauta tren">
</form>
<?php
    if(isset($_POST['NRT']) && $train != 0){

        for($i = 1; $i <= 8; $i++){
            echo $trainName[$train][$i].": ".$trainValues[$train][$i]."</br>";
        }
        if(strpos($trainValues[$train][5], "destinatie")){
            echo $trainName[$train][12].": ".$trainValues[$train][12]."</br>";
            echo $trainName[$train][13].": ".$trainValues[$train][13]."</br>";
        }
        else{
           for($i = 9; $i <= 13; $i++){
                    echo $trainName[$train][$i].": ".$trainValues[$train][$i]."</br>";
                }
        }
    }
?>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>