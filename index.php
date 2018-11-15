<html>
<head>
	<style>
header {
 background-color: #555;
 padding: 30px;
 text-align: center;
 font-size: 35px;
 color: white;
}

footer {
 background-color: #555;
 padding: 10px;
 text-align: center;
 color: white;
}
body{
	background-color:#777;
}
</style>
</head>
<body>
<header>
 <h2>Friends book</h2>
</header>
</br>
<form action="index.php" method="post"> 
Name: <input type="text" name="name">
<input type="submit" value = "Add new friend">
<h2>My best friends :</h2>
</form>
<?php
	$filename = 'friends.txt';
	$nameFilter = NULL;
	$name=NULL;
	$file = fopen("friends.txt","r");
	$array  = array();
	while(!feof($file))	
	{
		array_push($array,fgets($file));
	}
	fclose($file);
	
	if(isset($_POST['name']))//Adds name if not empty
	{
		
		if(!empty($_POST['name']))
		{
			$name = $_POST['name'];
			$file = fopen("$filename", "a+");
			array_push($array,$name);
			fwrite($file, PHP_EOL."$name" );
			fclose($file);
			foreach ($array as $current)
			{
				echo "<li>".$current."</li>";
			}
		}
	}
	if (isset($_POST['nameFilter'])) //Displays names with filter if activated
	{
		$nameFilter = $_POST['nameFilter'];
		if(empty($nameFilter))
		{
			foreach ($array as $current)
			{
				echo "<li>".$current."</li>";
			}
		}else
		{
			foreach ($array as $current) 
			{
				if(strlen(strstr($current, $nameFilter)) > 0)
				{
					echo "<li>".$current."</li>";
				}		
			}
		}
	}else if(empty($_POST['name']) && empty($_POST['nameFilter']))//If not activated, initialize the page with the list of friends
	{
		foreach ($array as $current)
			{
				echo "<li>".$current."</li>";
			}
	}
?>
<form action="index.php" method="post">
<input type="text" name="nameFilter" value="<?=$nameFilter?>">
<input type="submit" value='Filter list'>
</form>
<footer>
</footer>
</body>
</html>