<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add Customer</title>
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
					return true;
				//$numrows = mysqli_num_rows($res);
				//if($numrows<=0)
				//	return false;
				//else
				//	return $res;
			}

			$cat_conn = makeDbConn("localhost", "dbquery", "pass", "catinventory");
			//echo $cat_conn;
			
			if(isset($_POST['customerid']))
            {
				if($_POST['customerid'] != "")
				{
					$customerid = $_POST['customerid'];
					$firstname = $_POST['firstname'];
					$lastname = $_POST['lastname'];
					$street = $_POST['street'];
					$city = $_POST['city'];
					$state = $_POST['state'];
					$zip = $_POST['zip'];
					
					$query_str = "insert into customer (customerid, fname, lname, street, city, state, zip) values ('$customerid', '$firstname', '$lastname', '$street', '$city', '$state', '$zip');";
					$query_status = doQuery($cat_conn, $query_str);
					
					if($query_status)
						echo "Customer with Customer ID ".$customerid." added.";
					else
					{
						echo "???<br>";
						echo $query_str;
					}
				}
            }

		?>
		<h1>Add New Customer</h1>
		<form method="POST" style="width:100%;height:200px;border:black 1px solid;">
            Customer ID: <input type="text" name="customerid" required><br>
            First Name: <input type="text" name="firstname" required><br>
            Last Name: <input type="text" name="lastname" required><br>
            Street: <input type="text" name="street" required><br>
			City: <input type="text" name="city" required><br>
			State: <input type="text" name="state" required><br>
			Zip: <input type="text" name="zip" required><br>
            <input type="submit" value="Submit">
        </form>
		<br>
	
		<!-- the below links should also be included in an include file. also the currently selected page should be bold and unselectable but eh. -->
		<a href="add_customer.php">Add New Customer</a><br>
		<a href="add_catname.php">Add Cat Name</a><br>
		<a href="get_toy_price.php">Get Toy Price</a><br>
		<a href="least_most_expensive.php">Extra Credit</a>
	</body>
</html>