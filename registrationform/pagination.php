<?php 
// include("dbcountry.php");
$conn = mysqli_connect("localhost", "root", "", "dbcountry");
$query = "SELECT COUNT(*) FROM registration";     
$rs_result = mysqli_query($conn, $query);     
$row = mysqli_fetch_row($rs_result);     
$total_records = $row[0];   
echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='registration.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
 