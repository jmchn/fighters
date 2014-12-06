<!DOCTYPE html>
<html>
<body>
	<form name="input" action="search.php" method="get">
	Search: <input type="text" name="query">
    <input type="submit" value="Submit">
    <input type="range" name="slider1" min="0.0" max="1.0" step="0.01">
	</form>

<?php
	require "server.php";
	if(isset($_GET['query'])){
		$portNumber = '7051';
		$myResults = queryIndex($portNumber, "localhost", $_GET['query'],$_GET['slider1']);
		//echo $myResults[0]['id'];		
		//var_dump($myResults);
		echo "We have found ".count($myResults)."results";
		echo "<table border='1' style='width:100%'>";
		echo "<tr>";
		echo "<td>sequenceNumber</td>";
		echo "<td>Caption</td>";
		echo "<td>Thumbnail</td>";
		echo "</tr>";
		$con = mysqli_connect("localhost","group51","test","group51");
		for( $i = 0 ; $i<count($myResults) && $i<10 ;$i++)
        {
            echo $myResults[$i];
			//do it in naive way
			//each time Got a docid 
			// query the database to retrieve the info we need
			// the sequence
			//$query = mysqli_query($con,"select * from PhotoPA4 where sequencenum =".$myResults[$i]['id']);
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
</html>
