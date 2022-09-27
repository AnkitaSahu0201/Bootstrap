<?php 
$conn = mysqli_connect("localhost", "root", "", "dbcountry");
 $uid =$_POST['uid'];
 $empname = $_POST['empname'];
 $email = $_POST['email'];
 $mbno = $_POST['mbno'];
 $address = $_POST['address'];
 $country_dropdown = $_POST['country_dropdown'];
 $state_id = $_POST['state_id'];
 $city_id = $_POST['city_id'];
 $pin = $_POST['pin'];
 $emp_cd = $_POST['emp_cd'];
 $sql= "UPDATE `registration` SET `employee_name`='$empname',`email`=' $email ',`mobile`=' $mbno',`address`='$address',`country`='$country_dropdown',`state`='$state_id' ,`city`='$city_id',`pincode`=' $pin',`employee_code`=' $emp_cd' WHERE id= '$uid' ";

 if($conn->query($sql) == TRUE){
    echo "City name Updated Successfully";
}else {
    echo "Error while update record";
}
 ?> 



