<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>
<body>

  <div class ="container">
    <div class="row">
      <div class="sidebar">
        <div class="col-md-2">
          <div>

            <ul class="nav nav-sidebar">
              <li class="pure-menu-item"><a href="adminhome.html" class="pure-menu-link">Home</a></li>
              <li class="pure-menu-item"><a href="add.html" class="pure-menu-link">Add Feature</a></li>
              <li class="pure-menu-item"><a href="" class="pure-menu-link">View Report</a></li>
              <li class="pure-menu-item"><a href="http://52.89.116.249/~joseph.nsiah/finalproject/admin/logout.php" class="pure-menu-link">Log Out</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-10">
          <div id="main">
            <h2>Report</h2>
          </div>
        </div>

        <?php

        include_once ("../user.php");
        $obj= new user();
        $row=$obj->getreport();

        	echo "<table id =t01 border=2 style=width:80%>
        	<tr>
        	<td><b>Activity id.</b></td>
        	<td><b>Activity</b></td>
        	<td><b>Date/Time</b></td>
        	</tr>";
        	$x=1;
        	while ($results= $obj->fetch())
        	{
        		if ($x%2==0){
        		echo "<tr>
        		<td bgcolor= #bbdefb >{$results['id']}</td>
        		<td bgcolor= #bbdefb>{$results['details']}</td>
        	  <td bgcolor=#bbdefb >{$results['date/time']}</td>
        		</tr>";
        	}
        	else{
        		echo "<tr>
        		<td>{$results['id']}</td>
        		<td>{$results['details']}</td>
        		<td>{$results['date/time']}</td>
        		</tr>";
        	}
        	$x++;

        }


        echo "	</table>";


        ?>

      </div>
    </div>

  </div>
</body>
</html>
