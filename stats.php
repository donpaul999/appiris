<?php
    require 'conectare.php';
    include_once('process_list.php');
    include_once('script.php');
    date_default_timezone_get();
    $date_def = date('m/d/Y', time());
    $date = date('d/m/Y', time());
    $trainName = [];
    $trainValues = [];
    $train = 0;
    process_list($list_trains);
    //print_r($list_trains);
    $size = count($list_trains);
    $data = [];
    if(isset($_GET['NRT'])){
        $ok = 0;
        $selected_val = $_GET['NRT'];
        for($i = 1; $i < $size && !$ok; $i++){
            if($selected_val == $list_trains[$i])
                {
                    $data = select_delays($list_trains[$i], $date);
                    $t = TrainCharac($selected_val, $trainName, $trainValues);
                   // print_r($trainName);
                   // print_r($trainValues);
                    $ok = 1;
                    $train = $i;
                }
        }
        if(!$ok){
                $m = TrainCharac($selected_val, $trainName, $trainValues);
                if($m == "ok"){
                    array_push($list_trains, $selected_val);
                    add_train($selected_val);
                    echo "Exista date foarte putine pentru acest tren. Reveniti in curand!";
                }
                else
                    echo $m;
         }
    }

    if(isset($_GET['submit2'])){
        $train = $_GET['Tren'];
        $date = $_GET['date'];
        //echo $date;
        $data = select_delays($list_trains[$train], $date);
        TrainCharac($list_trains[$train], $trainName, $trainValues);
    }
    //echo $date;
?>
<!DOCTYPE HTML>
<html>
<head>
<script>

    var data = <?php echo json_encode($data, JSON_HEX_TAG); ?>;
    var dpoints = [];
    var title_s = "Intarzieri tren " + "<?php echo $trainValues[1]; ?> "+ "<?php echo $list_trains[$train];?>" ;
    dpoints.push({x: new Date(data[0].DATE), y:data[0].DELAY});
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
<form method="GET" action="#">
	<input type="text" name="NRT" placeholder="Numarul trenului" value=<?php echo $list_trains[$train]; ?> >
	<input type="submit" value="Cauta tren">
</form>
<?php
    if(isset($_GET['NRT']) && $train != 0 || isset($_GET['submit2'])){
        TrainCharac($list_trains[$train], $trainName, $trainValues);
        echo "<form action='#' method='GET'>";
        echo "<select name='date'>";
        if(isset($_GET['date'])){
            echo "<option value=".$_GET['date'].">".$_GET['date']."</option>";
        }
        for($i = 0; $i <= 29; ++$i){
            $new_date = date('d/m/Y', strtotime('-'.$i.' day', strtotime($date_def)));
            echo "<option value=".$new_date.">".$new_date."</option>";
        }
        echo "</select>";
        echo "<input type=hidden value= ".$train." name='Tren' >"."</br>";
        echo "<input type=submit name=submit2>"."</br>";
        echo "</form>";
        for($i = 1; $i <= 6; $i++){
            echo $trainName[$i].": ".$trainValues[$i]."</br>";
        }
        $txt = $trainValues[7];
        $aux = $txt;
        $txt[0] = $aux[3];
        $txt[1] = $aux[4];
        $txt[3] = $aux[0];
        $txt[4] = $aux[1];
        echo $trainName[7].": ".$txt."</br>";
        echo $trainName[8].": ".$trainValues[8]."</br>";
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
</br>
</br>
<div id="tableOrd">
    <table>
    <tbody>
    <?php
    for($i = 0; $i < count($data); ++$i){
    echo"
     <tr>
        <td>".$data[$i]["STATION"]."</td>
        <td>".$data[$i]["DELAY"]."</td>
     </tr>";
    }
    ?>
    </tbody>
    </table>
</div>
</body>
</html>