<?php
$conn = mysqli_connect("localhost","root","","dbcountry");
$id = $_POST['id'];
$sql="DELETE FROM `registration` WHERE id = $id";
if($conn->query($sql)){
    header("Location: registration.php");  
    echo true;
}else{
    echo false;
}
?>