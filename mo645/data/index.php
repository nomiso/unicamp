<!DOCTYPE HTML>

<html lang="pt-br">
	<head>
		<title>UDesigner</title>
		<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php
		if (isset ($_GET["question"]) )
		{
			if (isset ($_GET["answer"]) )
			{
				if (isset($_GET["user"]))
				{
					$Handle = fopen("results/udesigner.txt", "a+");
					
					fwrite	($Handle, "<item>");
					fwrite	($Handle, ("<question>"	. 	$_GET["question"]		.	"</question>")	);
					fwrite	($Handle, ("<answer>"	. 	$_GET["answer"]			.	"</answer>")	);
					fwrite	($Handle, ("<user>"		.	$_GET["user"]			.	"</user>")		);
					fwrite	($Handle, "<item>\n");
					fclose	($Hnadle);
					
					echo	"<h1>Thank you for sharing your opinion!</h1>";
				}
			}
			else
			{
				$freqImg	=	array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0);
				$skip		= 	0;
				$Handle		= 	fopen("results/udesigner.txt", "r");
				
				while (!feof($Handle))
				{
					$name = fgets ($Handle);
					if (strpos($name, "<question>".$_GET["question"]."</question>") !== false)
					{
						for ($i = 0; $i <= 5; $i++)
						{
							if (strpos($name, "<answer>".$i."</answer>") !== false)
							{
								$freqImg[$i]++;
							}
						}
					}
				}
				fclose ($Handle);
				echo	'<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
				echo	'<script type="text/javascript">';
				
				echo 	'google.load("visualization", "1", {packages:["corechart"]});';
				echo	'google.setOnLoadCallback(drawChart);';
				echo	'function drawChart() {';
				echo	'	var data =	google.visualization.arrayToDataTable([';
				echo	'		["Question", "Frequencia"],';
				
				for ($i=1; $i<=5; $i++)
				{
					echo	'["Img',$i,'", ',$freqImg[$i],'],';
				}
				
				echo	']);';
				echo	'var options={';
				echo	'	title:"Question', $_GET["question"],'",';
				echo	'	is3D: true,';
				echo	'};';
				echo	'var chart = new google.visualization.PieChart(document.getElementById("piechart_3d"));';
				echo 	'chart.draw(data, options);';
				echo	'}';
				echo	'</script>';
				
				echo	'</head>';
				
				echo	'<body>';
				echo	"<div id='piechart_3d' style='width: 900px; height: 500px;'></div>";
				echo	"<div>";
				echo	"	<div><img src='http://nomiso.info/MO645/UDesigner/", $_GET["question"],"/img1.png' /><p>Image 1 : ",$freqImg[ 1 ]," </p></div>";
				echo	"	<div><img src='http://nomiso.info/MO645/UDesigner/", $_GET["question"],"/img2.png' /><p>Image 2 : ",$freqImg[ 2 ]," </p></div>";
				echo	"	<div><img src='http://nomiso.info/MO645/UDesigner/", $_GET["question"],"/img3.png' /><p>Image 3 : ",$freqImg[ 3 ]," </p></div>";
				echo	"	<div><img src='http://nomiso.info/MO645/UDesigner/", $_GET["question"],"/img4.png' /><p>Image 4 : ",$freqImg[ 4 ]," </p></div>";
				echo	"	<div><img src='http://nomiso.info/MO645/UDesigner/", $_GET["question"],"/img5.png' /><p>Image 5 : ",$freqImg[ 5 ]," </p></div>";
				echo	"</div>";
				echo	'<body>';
				
			}
			
		}
		else
		{
			$data = "/data/";
			$dir = $data;
			echo "<h1>test</h1>";
			echo "<table>";
			foreach($dir as $value)
			{
				if (is_dir($value) && $value !=='.' && $value !=='..')
				{
					echo "<tr>";
					echo "<td><som> Audio ",$value," </som></td>";
					echo "<td><audio controls><source src='./",$value,"/",$value,".mp3' type='audio/mpeg'></source></audio></td>";
					echo "<td><a href='results.php?question=",$value,"'>Results</a></td>";
				}
			}
			echo "</table>";
		}
	?>
	</body>
</html>
