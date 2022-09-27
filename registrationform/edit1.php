<?php
    $conn = mysqli_connect('localhost', 'root', '', 'dbcountry');

    $id = $_POST['id']; 
    $fetch= "SELECT * FROM `registration` where id= '$id'"; 
    $result =$conn->Query($fetch);

    while ($row = $result->fetch_assoc()){
        $employee_name = $row['employee_name'];
        $email = $row['email'];
        // $password = $row['password'];
        $mobile = $row['mobile'];
        $address = $row['address'];
        $country = $row['country'];
        $state = $row['state'];
        $city = $row['city'];
        $pincode = $row['pincode'];
        $employee_code = $row['employee_code'];
    }
    
?>

        <script>
            var id= '<?php echo $id;?>';
            var employee_name= '<?php echo $employee_name;?>';
            var email= '<?php echo $email;?>';
        
            var mobile= '<?php echo $mobile;?>';
            var address= '<?php echo $address;?>';
            var country= '<?php echo $country;?>';
            var state= '<?php echo $state;?>';
            var city= '<?php echo $city;?>';
            var pincode= '<?php echo $pincode;?>';
            var employee_code= '<?php echo $employee_code;?>';

            jQuery(document).ready(function(){
                jQuery('#hidden').val(id);
                jQuery('#empname').val(employee_name);
                jQuery('#email').val(email);
                // jQuery('#pswd').val(password);
                jQuery('#mbno').val(mobile);
                jQuery('#address').val(address);
                jQuery('#country_dropdown').val(country);
                jQuery('#state_id').val(state);
                jQuery('#city_id').val(city);
                jQuery('#pincode').val(pincode);
                jQuery('#empcode').val(employee_code);
                
                // .attr('disabled','disabled');
            });
        </script>