<?php 
// include 'dbcountry.php'
$conn = mysqli_connect("localhost", "root", "", "dbcountry");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="validation.js"></script> 
        <title >Registration</title>
        <style> 
            .hidden {
                visibility:hidden;
            }
            a{
                color: yellow;
            }
            .styling{
               text-align:center;font-family:Comic Sans; color:coral
            }
            input, button{   
                height: 34px;   
            }   
            .pagination {   
                display: inline-block;   
            }   
            .pagination a {     
                font-size:15px;   
                color: black;   
                float: left;   
                padding: 8px 16px;     
            }   
            .pagination a.active {   
                    background-color: coral;   
            }   
            .pagination a:hover:not(.active) {   
                background-color: skyblue;   
            }  
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="" id="hidden">
                    <h2 class="styling">Registration</h2>
                    <form id="myform">
                
                        <table>
                            <tr> 
                                <td> Employee Name: </td> 
                                <td> <input type="text" class="form-control" name="empname"  id="empname"><br></td>
                                <td class="errormsg1"></td>
                                <br> 
                            </tr>
                            <tr> 
                                <td> Email Address: </td> 
                                <td> <input type="email" class="form-control"  name="email" id="email"><br></td>
                                <td class="errormsg2"></td>
                                <br>  
                            </tr>
                            <tr> 
                                <td> Password: </td> 
                                <td> <input type="password" class="form-control" name="pswd" id="pswd"><br></td>
                                <td class="errormsg3"></td>
                                <br>  
                            </tr>
                            <tr>
                                <td>Mobile:<br></td>
                                <td> <input type="tel" class="form-control" name="mbno" id="mbno" minlength="10" maxlength="10"><br></td>
                            </tr>
                            <tr>
                                <td>Address:<br></td>
                                <td><textarea  rows="4" cols="20" class="form-control" name="address" id="address"></textarea><br></td>
                            </tr>
                            <tr>
                                <td>Country:<br></td>
                                <td>
                                    <select class="boxsize form-control" name="country_dropdown" id="country_dropdown">
                                        <option> Select Country</option>
                                        <?php  
                                            $sql="select * from country";
                                            $result = mysqli_query($conn,$sql);
                                            while($row=mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <option value="<?php echo $row['code'];?>"><?php echo $row["name"];?></option>
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
                                        <option> Select </option>
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
                                <td><input type="text" class="form-control" name="pincode"  id="pincode"><br></td>
                            </tr>
                            <tr>
                                <td>Employee Code:<br></td>
                                <td><input type="text" class="form-control" name="empcode" id="empcode"><br></td>
                                <td class="errormsg4"></td>
                                <br> 
                              
                            </tr>
                            <tr>
                                <td><button type="button" class="btn btn-primary" name="btnadd" id="btnadd">Save</button><br></td>
                            </tr>
                        </table>
                        <div id="show"></div>
                    </div> 
                    </form>
                </div>
    
                <div class="col-md-12">
                    <br>
                    <h3 class="styling">Show Details</h3>
                    <table style="width:100%" class="table table-striped table-bordered">
                        <thead>
                            <tr style="background-color: #FF9999">
                                <th scope="col">Employee Name</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Address</th>
                                <th scope="col">Country</th>
                                <th scope="col">State</th>
                                <th scope="col">City</th>
                                <th scope="col">Pincode</th>
                                <th scope="col">Employee Code</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <center>
                        <tbody id="tbody">
                            
                            <?php
                                $show_per_page = 5;    //Get the Current Page Number and total no of pages for pagination
                                $sql = "SELECT * FROM `registration`";
                                $result = mysqli_query($conn, $sql);
                                $no_of_result = mysqli_num_rows($result);
                                $no_of_page = ceil($no_of_result / $show_per_page);
                                $pageLink = "";

                                if (!isset($_GET['page'])) {
                                    $page = 1;
                                } else {
                                    $page = $_GET['page'];
                                }
                                $page_first_result = ($page - 1) * $show_per_page;

                                $conn = mysqli_connect("localhost", "root", "", "dbcountry");
                                $sql = " SELECT registration.id, registration.employee_name, registration.email,
                                 registration.password, registration.mobile, registration.address, country.name, 
                                 state.statename, city.cityname, registration.pincode, registration.employee_code
                                FROM ((((`registration`)
                                LEFT JOIN country ON registration.country = country.code) 
                                LEFT JOIN state ON registration.state = state.statecode) 
                                LEFT JOIN city ON registration.city = city.citycode )
                                LIMIT " . $page_first_result . ',' . $show_per_page;   //SQL Query for Fetching Limited Records using LIMIT Clause
                                
                                $result = $conn->query($sql);
                                if($result->num_rows > 0)
                                {
                                    while($row = $result->fetch_assoc())
                                    {
                            ?>
                                <tr>
                                    <td><?php  echo $row["employee_name"];?></td>
                                    <td><?php  echo $row["email"];?></td>
                                    <td><?php  echo $row["mobile"];?></td>
                                    <td><?php  echo $row["address"];?></td>
                                    <td><?php  echo $row["name"];?></td>
                                    <td><?php  echo $row["statename"];?></td>
                                    <td><?php  echo $row["cityname"];?></td>
                                    <td><?php  echo $row["pincode"];?></td>
                                    <td><?php  echo $row["employee_code"];?></td>
                                    <td>
                                    <button class='btn-primary edit' style= "border-radius:5px"><a href="edit.php?id=<?php  echo $row["id"];?>">Edit</a></button>
                                    <button class='btn-danger del' style= "border-radius:5px" id='<?php  echo $row["id"];?>'>Delete</button>
                                    </td>
                                </tr>
                            <?php 
                                    }
                                }   
                            ?>
                        </tbody> 
                          
                    </table> 
                    
                    <center>
                    <?php //Pagination Link creation
                    if ($page >= 2) {
                        echo "
                    <ul class='pagination'>
                        <li><a  href='registration.php?page=" . ($page - 1) . "'>  Prev </a></li>
                    </ul>";
                    }

                    for ($i = 1; $i <= $no_of_page; $i++) {
                        if ($i == $page) {
                            $pageLink .= "
                            <ul class='pagination'>
                                <li><a class = 'active page-link' href='registration.php?page=". $i . "'>" . $i . " </a></li>
                            </ul>";
                        } else {
                            $pageLink .= "
                            <ul class='pagination'>
                                <li><a  href='registration.php?page=" . $i . "'> " . $i . " </a></li>
                            </ul>";
                        }
                    };
                    echo $pageLink;

                    if ($page < $no_of_page) {
                        echo "
                        <ul class='pagination'>
                        <li><a  href='registration.php?page=" . ($page + 1) . "'>  Next </a></li>
                        </ul>";
                    }
                    ?>
                    </center>
                    <!-- <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                        <p>Page <?php echo $page." of ".$no_of_page; ?></p>
                    </div> -->
                </div>
            </div>
        </div>
    </body>
    <script>
      jQuery(document).ready(function(){
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

           

            //Ajax request for data Insertion
            jQuery("#btnadd").click(function(e){
                e.preventDefault();
                // var id = $("#hidden").val();
                // var empname = $("#empname").val();
                // var email = $("#email").val();
                // var pswd = $("#pswd").val();
                // var mbno = $("#mbno").val();
                // var address = $("#address").val();
                // var country_dropdown = $("#country_dropdown").val();
                // var state_id = $("#state_id").val();
                // var city_id = $("#city_id").val();
                // var pincode = $("#pincode").val();
                // var empcode = $("#empcode").val();
                // console.log(name, email,pswd,mbno,address,country_dropdown,state_id,city_id,pincode,empcode);
                // var Btext = jQuery(this).text();
                //    if(Btext == 'Save'){
                    
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
                        url:"insert.php", 
                        type:"POST", 
                        data: jQuery('form').serialize(),
                        // data:{'empname':empname, 'email':email, 'pswd':pswd, 'mbno':mbno, 'address':address, 'country_dropdown':country_dropdown,'state_id':state_id,'city_id':city_id,'pincode':pincode,'empcode':empcode}, 
                        success: function(data){ 
                            jQuery("#show").text("form submitted successfully");
                            jQuery("#myform")[0].reset();
                            location.reload();
                        }
                    });
                }
                // }

            //     if(Btext=="Update details")
            //         {
            //             jQuery.ajax({
            //             type:'POST',
            //             url:'update.php',
            //             data:{'uid': id, 'empname':empname, 'email':email, 'mbno':mbno, 'address':address, 'country_dropdown':country_dropdown,'state_id':state_id,'city_id':city_id,'pincode':pincode,'empcode':empcode}, 
            //             data: jQuery('form').serialize(),
            //             success:function(res){ 
            //                 jQuery('#show').html(res);
            //                 jQuery(".btn").text("Save");
            //             } 
            //             });  
            //             // setTimeout(() => {
            //             //     location.reload();
            //             // }, 3000);
            //         }
            });

            jQuery(".del").on("click",function(){
                var id = jQuery(this).attr("id");
                var btn=jQuery(this);
                if(confirm("Are You Sure ? ")){
                    $.ajax({
                        type:'POST',
                        url:'delete.php',
                        data: {'id':id},
                        success:function(data){
                            if(data){
                                btn.closest("tr").remove();
                                location.reload();
                            }
                        }
                    });
                }
            });
        });

            // jQuery(".edit").on("click",function(){
            //     var id=jQuery(this).attr("id");
            //     var btn=jQuery(this);
                  
            //     $.ajax({
            //         type:'POST',
            //         url:'edit1.php',
            //         data:{'id':id}, 
            //         success:function(res){ 
            //             if(res){
            //                 jQuery('#show').html(res);
            //                 jQuery(".btn").text("Update details");
            //             }
            //         }
            //     });
            // });
        
    </script>
</html>

                    
                
