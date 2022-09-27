<?php
$conn = mysqli_connect("localhost", "root", "", "dbcountry");
$st_id=$_POST['st_id'];
$result=mysqli_query($conn,"SELECT * FROM city WHERE state = '$st_id'");
echo "<option>Select City</option>";
while($row = mysqli_fetch_array($result))
{
?>
echo "<option value="<?php echo $row['citycode'];?>"><?php echo $row['cityname'];?></option>";
<?php
}
?>