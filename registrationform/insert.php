<?php 
// include("dbcountry.php");
$conn = mysqli_connect("localhost", "root", "", "dbcountry");

$empname=$_POST['empname'];
$email=$_POST['email'];
$pswd=$_POST['pswd'];
$mbno=$_POST['mbno'];
$address=$_POST['address'];
$country_dropdown=$_POST['country_dropdown'];
$state_id=$_POST['state_id'];
$city_id=$_POST['city_id'];
$pincode=$_POST['pincode'];
$empcode=$_POST['empcode'];
$sql="INSERT INTO `registration`(`employee_name`, `email`, `password`, `mobile`, `address`, `country`, `state`, `city`, `pincode`, `employee_code`) VALUES('$empname','$email','$pswd','$mbno','$address','$country_dropdown','$state_id','$city_id','$pincode','$empcode')";
mysqli_query($conn,$sql);
print_r($sql);
?>





