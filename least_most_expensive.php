<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>High/Low Prices</title>
	</head>
	<body>
		<?php
			//yes i know, the two functions below should be in an include file
			function makeDbConn($host, $user, $pass, $dbname)
			{
				$dbconn = mysqli_connect($host, $user, $pass, $dbname);
				if(mysqli_connect_error($dbconn))
					return false;
				else
					return $dbconn;
			}

			function doQuery($conn, $querystr)
			{
				$res = mysqli_query($conn, $querystr);
				if($res == false)
					return false;
				else
					return $res;
				//$numrows = mysqli_num_rows($res);
				//if($numrows<=0)
				//	return false;
				//else
				//	return $res;
			}

			$cat_conn = makeDbConn("localhost", "dbquery", "pass", "catinventory");
			//echo $cat_conn;
			
			/*if(isset($_POST['toyname']))
            {
				if($_POST['toyname'] != "")
				{
					$toyname = $_POST['toyname'];
										
					$query_str = "select * from cattoys where itemname='$toyname';";
					$query_status = doQuery($cat_conn, $query_str);
					if($query_status)
					{
						$status_row = mysqli_fetch_array($query_status);
						echo "Price of ".$status_row["itemname"]." is $".$status_row["itemprice"].".";
					}
					else
					{
						echo "???<br>";
						echo $query_str;
					}
				}
            }*/
		
			$result = doQuery($cat_conn, "select * from cattoys order by itemprice desc limit 1;");
			$row = mysqli_fetch_array($result);
			echo "Most expensive item in Cat Toys table is ".$row["itemname"]." at $".$row["itemprice"].".<br>";
			
			$result = doQuery($cat_conn, "select * from cattoys order by itemprice asc limit 1;");
			$row = mysqli_fetch_array($result);
			echo "Least expensive item in Cat Toys table is ".$row["itemname"]." at $".$row["itemprice"].".<br>";
			
			$result = doQuery($cat_conn, "select * from catsupplies order by itemprice desc limit 1;");
			$row = mysqli_fetch_array($result);
			echo "Most expensive item in Cat Supplies table is ".$row["itemname"]." at $".$row["itemprice"].".<br>";
			
			$result = doQuery($cat_conn, "select * from catsupplies order by itemprice asc limit 1;");
			$row = mysqli_fetch_array($result);
			echo "Least expensive item in Cat Supplies table is ".$row["itemname"]." at $".$row["itemprice"].".<br>";
		
		?>
		<h1>High/Low Prices</h1>
		<br>
		
		<!-- the below links should also be included in an include file. also the currently selected page should be bold and unselectable but eh. -->
		<a href="add_customer.php">Add New Customer</a><br>
		<a href="add_catname.php">Add Cat Name</a><br>
		<a href="get_toy_price.php">Get Toy Price</a><br>
		<a href="least_most_expensive.php">Extra Credit</a>
	</body>
</html>