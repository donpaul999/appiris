<?php
    require 'conectare.php';
    include_once('process_list.php');
    include_once('script.php');
    date_default_timezone_get();
    $date_def = date('m/d/Y', time());
    $date = date('m/d/Y', time());
    $trainName = [];
    $trainValues = [];
    $train = 0;
    process_list($list_trains);
    //print_r($list_trains);
    $size = count($list_trains);
    $data = [];
    if(isset($_POST['NRT'])){
        $ok = 0;
        $selected_val = $_POST['NRT'];
        for($i = 1; $i < $size && !$ok; $i++){
            if($selected_val == $list_trains[$i])
                {
                    TrainCharac($selected_val, $trainName, $trainValues);
                   // print_r($trainName);
                   // print_r($trainValues);
                    $data = select_delays($list_trains[$i], $date);
                    $ok = 1;
                    $train = $i;
                    //echo $trainValues[$train][1]."txt";
                }
        }
        if(!$ok)
            echo "Trenul selectat nu exista!";
    }

    if(isset($_POST['submit2'])){
        $train = $_POST['Tren'];
        $date = $_POST['date'];
        //echo $date;
        $data = select_delays($list_trains[$train], $date);
    }
   // print_r($trainName);
    //echo $date;
?>
<!DOCTYPE HTML>
<html>
<head>
<script>

    var data = <?php echo json_encode($data, JSON_HEX_TAG); ?>;
    var dpoints = [];
    var title_s = "Intarzieri tren " + "<?php echo $trainValues[$train][1]; ?> "+ "<?php echo $list_trains[$train];?>" ;
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
		includeZero: true
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
	<input type="text" name="NRT" placeholder="Numarul trenului" value=<?php echo $list_trains[$train]; ?> >
	<input type="submit" value="Cauta tren">
</form>
<?php
    if(isset($_POST['NRT']) && $train != 0 || isset($_POST['submit2'])){
        TrainCharac($list_trains[$train], $trainName, $trainValues);
        echo "<form action='#' method='post'>";
        echo "<select name='date'>";
        for($i = 0; $i <= 29; ++$i){
            $new_date = date('d/m/Y', strtotime('-'.$i.' day', strtotime($date_def)));
            echo "<option value=".$new_date.">".$new_date."</option>";
        }
        echo "</select>";
        echo "<input type=hidden value= ".$train." name='Tren' >"."</br>";
        echo "<input type=submit name=submit2>"."</br>";
        echo "</form>";
        for($i = 1; $i <= 8; $i++){
            echo $trainName[$i].": ".$trainValues[$i]."</br>";
        }
        if(strpos($trainValues[5], "destinatie")){
            echo $trainName[12].": ".$trainValues[12]."</br>";
            echo $trainName[13].": ".$trainValues[13]."</br>";
        }
        else{
           for($i = 9; $i <= 13; $i++){
                    echo $trainName[$i].": ".$trainValues[$i]."</br>";
                }
        }
    }
?>
<div id="chartContainer" style="height: 400px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>