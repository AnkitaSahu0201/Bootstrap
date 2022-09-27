<?php
$conn = mysqli_connect("localhost", "root", "", "dbcountry");
$country_id=$_POST['country_id'];
$result=mysqli_query($conn,"SELECT * FROM state WHERE country = '$country_id'");
echo "<option>Select State</option>";
while($row = mysqli_fetch_array($result))
{
?>
echo "<option value="<?php echo $row['statecode'];?>"><?php echo $row['statename'];?></option>";
<?php
}
?>




