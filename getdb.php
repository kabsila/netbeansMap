<?php

   $q=$_GET["q"];
   
   $con=mysqli_connect("localhost","root","","testlatlong");

// Check connection
    if (mysqli_connect_errno($con))
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $result = mysqli_query($con,"SELECT * FROM forlatlong WHERE id=$q");
    
    
    while($row = mysqli_fetch_array($result))
      {
       $latt = $row['lat'];
       $longg = $row['long'];
       echo $row['lat'] . " " . $row['long'];
       echo "<br>";
      }

    mysqli_close($con);
  
?>
