<!DOCTYPE html>
<html>
<head>
<style>
.a{
    display:none;
}
</style>
</head>
<body>
	<form name="input" action="search.php" method="get">
	Search: <input type="text" name="query">
    <input type="submit" value="Submit">
    <input type="range" name="slider1" min="0.0" max="1.0" value="0.50" step="0.01" onchange="showValue(this.value)">
    <span id="range">0.50</span>
	</form>

<?php
	require "server.php";
	if(isset($_GET['query'])){
		$portNumber = '7051';
		$myResults = queryIndex($portNumber, "localhost", $_GET['query'],$_GET['slider1']);
		//echo $myResults[0]['id'];		
		//var_dump($myResults);
		$con = mysqli_connect("localhost","group51","test","group51");
		for( $i = 0 ; $i<count($myResults) && $i<10 ;$i++)
        {

            echo "The Url is:<a href='http://en.wikipedia.org/wiki?curid=".$myResults[$i]['id']."'>http://en.wikipedia.org/wiki?curid=".$myResults[$i]['id']."</a>";
            echo "<div class='a'>";
            echo "</div>";
			//do it in naive way
			//each time Got a docid 
			// query the database to retrieve the info we need
			// the sequence
			$query = mysqli_query($con,"select * from imageUrl where id ='".$myResults[$i]['id']."'");
			//$result = mysqli_fetch_array($query);
			//echo "<tr>";
			//echo "<td>".$result["sequencenum"]."</td>";
			//echo "<td>".$result["caption"]."</td>";
			//echo "<td><a href='search.php?query=".$result['caption']."' > <img src='resources/".$result["url"]."' alt='' style='width:200px; height:auto;'></a></td>";
			//echo "</tr>";
		
		}
		mysqli_close($con);
		echo "</table>";
	}

	
?>

</body>
    <script>
    function showValue(newValue){
        document.getElementById("range").innerHTML=newValue;
    }
    function hideTR(){
        //change the CSS style property to 'none' for hiding, or 'inline' to show    
        document.getElementById('hideThis').style.display='none';}
</script>
</html>
