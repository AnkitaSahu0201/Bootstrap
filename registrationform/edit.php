<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="validation.js"></script> 
<?php
    

// include("dbcountry.php");
$conn = mysqli_connect("localhost", "root", "", "dbcountry");
 $id = $_GET['id'];
 $sql = "select * from `registration` where id='".$_GET['id']."'"; 
 $result = mysqli_query($conn,$sql); 
 while($row=mysqli_fetch_array($result))  //FETCHING Db from registration form db
{
    $id=$row['id'];
    
    $emp_cd=$row['employee_code'];
    $pin=$row['pincode'];
    $address=$row['address'];
   

?>
        <div class="container">
            <div class="row">
                <div style="height:5%"></div>
                <p style="color:green">Please update your details:</p></br>
                <div class="show">&nbsp;</div>
            </div>
            <div class="row">
                <form id="myform">
                    
                    <table>
                        <tr> 
                            <td> Employee Name: </td> 
                            <td> <input value= "<?php  echo $row["employee_name"];?> " type="text" class="form-control" name="empname" id="empname" ><br></td>
                            <td class="errormsg1"></td>
                        </tr>
                        <tr> 
                            <td> Email Address: </td> 
                            <td> <input value= "<?php  echo $row["email"];?> " type="email" class="form-control" name="email" id="email"><br></td>
                            <td class="errormsg2"></td> 
                        </tr>
                        <tr> 
                            <td> Password: </td> 
                            <td> <input value= "<?php  echo $row["password"];?> " type="password" class="form-control" name="pswd" id="pswd"><br></td>
                            <td class="errormsg3"></td> 
                        </tr>
                        <tr>
                            <td>Mobile:<br></td>
                            <td> <input value= "<?php  echo $row["mobile"];?> " type="tel" class="form-control" name="mbno" id="mbno"><br></td>
                        </tr>
                        <tr>
                            <td>Address:<br></td>
                            <td> <input value= "<?php  echo $row["address"];?> " type="text" class="form-control" name="address" id="address"><br></td>
                        </tr>
                        <tr>
                            <td>Country:<br></td>
                            <td>
                                <select class="boxsize form-control" name="country_dropdown" id="country_dropdown">
                                
                                    <option> Select Country</option>
                                    <?php  
                                        $sql="select * from country";
                                        $result = mysqli_query($conn,$sql);
                                        while($roww=mysqli_fetch_array($result))
                                        {
                                        ?>
                                        <option value="<?php echo $roww['code'];?>"
                                        <?php if($roww['code'] == $row['country'])
                                         {
                                          echo 'selected';
                                         }
                                         ?>
                                        ><?php echo $roww["name"];?></option>
                                        <?php
                                        }
                                    ?>
                                </select>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>State:<br></td>
                            <td>
                                <select class="boxsize form-control" name="state_id" id="state_id">
                                    <option> Select State</option>
                                    <option value="<?php echo $row['state'];?>"></option>
                                </select>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>City:<br></td>
                            <td>
                                <select class="boxsize form-control" name="city_id" id="city_id">
                                    <option> Select </option>
                                </select>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>Pincode:<br></td>
                            <td><input value= "<?php echo $pin;?>" type="text" class="form-control" name="pin" id="pincode"><br></td>
                        </tr>
                        <tr>
                            <td>Employee Code:<br></td>
                            <td> <input value= "<?php echo $emp_cd;?>" type="text" class="form-control" name="emp_cd" id="empcode" readonly><br></td>
                            <td><input value="<?php  echo $id;?>" type="hidden" class="form-control" name="uid" id="hidden"></td>
                            <td class="errormsg4"></td>
                        </tr>
                        <tr>
                            <td><button type="button" class="btn btn-primary" name="btnadd" id="btnadd">UPDATE</button><br></td>
                        </tr>
                    </table>
                   
                    </div> 
                </form>
            </div>
        </div>
<?php
}
?>


    <script>
    $(document).ready(function(){
        $("#btnadd").click(function(e){
            e.preventDefault();
            var id = $("#hidden").val();
                // var empname = $("#empname").val();
                // var email = $("#email").val();
                // var pswd = $("#pswd").val();
                // var mbno = $("#mbno").val();
                // var address = $("#address").val();
                // var country_dropdown = $("#country_dropdown").val();
                // var state_id = $("#state_id").val();
                // var city_id = $("#city_id").val();
                // var pin = $("#pincode").val();
                // var emp_cd= $("#empcode").val();
            // alert(id);

            var empname = $("#empname").val();
            var email = $("#email").val();
            var pswd = $("#pswd").val();
            var empcode = $("#empcode").val();
            if(empname == "") {
                jQuery(".errormsg1").text("This field is mandatory").css({
                    "color":"red"
                })
            }
            if(email == "") {
                jQuery(".errormsg2").text("This field is mandatory").css({
                    "color":"red"
                })
            }
            if(pswd == "") {
                jQuery(".errormsg3").text("This field is mandatory").css({
                    "color":"red"
                })
            }
            if(empcode == "") {
                jQuery(".errormsg4").text("This field is mandatory").css({
                    "color":"red"
                })
            }
            if( empname != "" && email != "" && pswd != "" && empcode != "" ){

            jQuery.ajax({
                        type:'POST',
                        url:'update.php',
                        data: jQuery('form').serialize(),
                        // data:{'uid': id, 'empname':empname, 'email':email, 'mbno':mbno, 'address':address, 'country_dropdown':country_dropdown,'state_id':state_id,'city_id':city_id,'pin':pin,'emp_cd':emp_cd}, 
                        success:function(res){ 
                            jQuery('.show').html(res);
                         
                            window.location.href="registration.php"; 
                        } 
            }); 
        } 
        });
      
            jQuery("#country_dropdown").change(function(e){
                e.preventDefault();
                var country_id = jQuery(this).val();
                jQuery.ajax({
                    type:"POST",
                    url:"states-by-country.php",
                    data:{'country_id': country_id},
                    success: function(data){
                        jQuery('#state_id').html(data);
                    }
                });
          

                jQuery("#state_id").change(function(e){
                    e.preventDefault();
                    var st_id = jQuery(this).val();
                    jQuery.ajax({
                        type:"POST",
                        url:"cities-by-state.php",
                        data:{'st_id': st_id},
                        success: function(data){
                            jQuery('#city_id').html(data);
                        }
                    });
                });
            });

    });
</script>


