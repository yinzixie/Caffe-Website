<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/icon.ico" type="image/x-icon"/> <!--icon-->
    <link rel="stylesheet" type="text/css" href="../css/foodlist.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    <link rel="stylesheet" type="text/css" href="../css/user_side_panel.css">

    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    <script type="text/javascript" src="../js/foodlist.js"></script>
    

    <title>Food list</title>
</head>
    
<body>
    <?php
        include("db_conn.php");
        session_start();

    //defalut setting, according to previously operation
        if (isset($_SESSION['show']) && $_SESSION['show'] == "beverage"){
           echo "<script>$(document).ready(function(){ $('.beverage_list').show(); $('.master_food_list').hide();$('.option_beverage a, .option_add a').css('color','deepskyblue');$('.option_beverage, .option_add').css('background-color','white'); });</script>";

        }
        else {
            echo "<script>$(document).ready(function(){ $('.beverage_list').hide(); $('.option_masterfood a, .option_add a').css('color','deepskyblue');$('.option_masterfood, .option_add').css('background-color','white'); });</script>";
       }
    
    ?>
<!--Headers-->  
    <div class="header">
    <div id="headline">
        <ul>
            <li><a class="html" href="../index.html">Home</a></li>
            
            <li><a id="cafe" href="javascript:void(0)">Café</a></li>  

            <li><a  href="./account.php">Account</a></li>
            
            <li><a href="./account_manage.php">Manage Account</a></li>

            <?php
                if ($_SESSION['type'] == "CAFE_MANAGER") {
                    echo "<li><a href='./menu_management.php'>Menu Management</a></li>";
                    echo "<li><a href='./cafe_orders.php'>Café Orders list</a></li>";
                }
                else if ($_SESSION['type'] == "CAMPUS_MANAGER" || $_SESSION['type'] == "DIRECTOR_BOARD") {
                    echo "<li><a href=\"./master_food_and_beverage_list.php\">Master food & Beverage list</a></li>";
                }
            ?>
            
            <li><a class="log" id="logbutton" href="javascript:void(0)">LOGIN</a></li>
    
            <li><span class="log" id="tstring">|</span></li>
    
            <li><a class="log" id="tregister" href="../register.html" target="_blank">REGISTER</a></li>
        </ul>
    </div>

 <!--a dropdown cafe menu-->   
    <div id="dropdown">  
        <form>
            <fieldset class="dropdown">
                <ul>
                    <li><a href="./Refcafe.php">Ref's café</a></li>
                    <li><a href="./Lazenbyscafe.php">Lazenbys 's café</a></li>
                    <li><a href="./tradetablecafe.php">Trade Table's café</a></li>
                    <li><a href="./Walkcafe.php">Walk's café</a></li>
                    <li><a href="./Grovecafe.php">Grove's café</a></li>
                </ul>
            </fieldset>
        </form>
    </div>
    
<!--dropdown login area-->    
    <div id="loginBox">                
        <form id="loginForm" method="post" action="./login.php" onsubmit="return loginbox_validation();">
            <fieldset id="logbody">
                <fieldset id="fid">
                    <label for="logid">ID</label>
				    <input type="text" name="logid" id="logid">
                </fieldset>
                                        
                <fieldset id="fpass">
                    <label for="logpassword">Password</label>
				    <input type="password" name="logpassword" id="logpassword">
                </fieldset>
                                        
                <fieldset id="login">
				    <input type="submit"  name="sign_in" value="Sign In">
                </fieldset>
                <a id="forget_password" href="./forget_password.php" >Forget password?</a>
            </fieldset>
        </form>
        
    </div>
    
    <!--dropdown login out area-->
    <div id="afterlogin">
        <form id="logoutForm" method="post" action="./login.php" >
            <fieldset id="flogout">
            <p>Welcome Y.E.O.M !</p>
            <input type="submit"  name="log_out" value="Log out">
            </fieldset>
        </form>
    </div> 
</div>
    
    <!--process data-->
    <?php

    if ($_SESSION['type'] == "CAMPUS_MANAGER" || $_SESSION['type'] == "DIRECTOR_BOARD") {
        //set date
        if (isset($_GET['date_submit'])) {
          
            $sql = "Update menu_apply_date SET Date='$_GET[date]'
	               WHERE ID=0";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
        }
        
        //DELETE operation
        if (isset($_GET['delete'])) {
          
            $sql = "DELETE FROM iteam
	               WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
        //delete corresponding product in cafe database    
        $sql = "DELETE FROM grove_cafe_iteam
	               WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
            
        $sql = "DELETE FROM lazenbys_cafe_iteam
	               WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
            
        $sql = "DELETE FROM ref_cafe_iteam
	               WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
            
        $sql = "DELETE FROM trade_table_cafe_iteam
	               WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
            
        $sql = "DELETE FROM walk_cafe_iteam
	               WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }    
        }
    
    //edit operation
       if (isset($_GET["edit"])) {
	       $price = $mysqli->real_escape_string($_GET['price']);
           $description = $mysqli->real_escape_string($_GET['description']);
           $catalogue = $mysqli->real_escape_string($_GET['catalogue']);
           $pic_href = $mysqli->real_escape_string($_GET['pic_href']);
           
            $sql = "UPDATE iteam
            SET Price='$price', Description='$description', Type='$catalogue', Href='$pic_href'
            WHERE Iteam_id='$_GET[iteam_id]'";
           
            if($mysqli->query($sql)==false) {
                echo "failed: ".$mysqli->error;
            }
       }
    
    //update headphoto
    if (isset($_POST['foodphoto'])) {
        if(is_uploaded_file($_FILES['img']['tmp_name'])) {
        
            $oldname=$_FILES['img']['name'];
            $tmp = explode('.',$oldname);
            $newname=$_POST['iteam_id'].'.'.$tmp[1];
            $filepath="../img/menu/".$newname;

                if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath))
            {
                $query = "UPDATE iteam SET Href='$filepath' WHERE Iteam_id='$_POST[iteam_id]'";    
                   
                if ($mysqli->query($query)) {
                   
                    echo "<script>alert('Succeed!');</script>";
                }
                else {
                        echo "<script>alert('Failed!');</script>";
                    }
            }
            else {
                 echo "<script>alert('Failed!');</script>";
            }
        }

          else {
              echo "<script>alert('Failed to upload img!');</script>";
            }
    }
    //add to iteam list operation
        if (isset($_GET["add"])) {
            $id = $mysqli->real_escape_string($_GET['iteam_id']);
	       $price = $mysqli->real_escape_string($_GET['price']);
           $description = $mysqli->real_escape_string($_GET['description']);
           $catalogue = $mysqli->real_escape_string($_GET['catalogue']);
           $pic_href = $mysqli->real_escape_string($_GET['pic_href']);
               
            $sql = "INSERT INTO iteam (Iteam_id, Description, Price, Type, Href)
            VALUES ('$id','$description','$price','$catalogue','$pic_href')";

            if($mysqli->query($sql)==false) {
                echo "failed adding new product: ".$mysqli->error;
            }
        }
    }
?>
<!--account information and corresponding operations-->    
    <div id="empty">
    </div>
    <div id="user_side_panel">
        
        <div class="information">
            <div id="welcome">
                <p>Welcome</p>
            </div>
            
            <center>
                <div id="user_image">
                    <!--display user's head photo-->
                    <?php 
                        echo "<img  src='".$_SESSION['headphoto']."' onerror=\"this.src='../img/error.png'\" alt='user'/>";
                    ?>
                </div>
            </center>
            
            <ul class="information">
                <li>IDnumber: 
                    <!--print idnumber-->
                    <?php
                        echo $_SESSION['id'];
                    ?></li>
                <li>Full Name: 
                    <!--print full name-->
                    <?php
                        echo $_SESSION['user_name'];
                    ?>
                    </li>
            </ul>
            </div>
        
            <div id="normal_operation">
                <ul class="change_information">
                    <li><a href="./account.php">Balance: <span id="balance">
                        <!--print balance-->
                            <?php
                                echo $_SESSION['balance'];
                            ?>
                        </span></a></li> 
                    <li ><a class="change_email" href="./account_manage.php">Email: <span id="emailaddress">
                        <!--print email-->
                            <?php
                                echo $_SESSION['email'];
                            ?>
                        </span></a></li> 
                    <li><a class="change_mobile" href="./account_manage.php">Mobile number: <span id="mobilenumber">
                        <!--Print mobile number-->
                            <?php 
                                echo $_SESSION['mobile'];
                            ?>
                        </span></a></li>
                    <li><a class="change_credit_card" href="./account_manage.php">Credit Card: <span>
                        <!--print credit card number-->
                            <?php 
                                echo $_SESSION['card'];
                            ?>
                        </span></a></li>
                    <li><a class="change_password" href="./account_manage.php">Password: <span id="password">*******</span></a></li> 
                </ul>
        </div>
            
        <div id="staff_member_operation">
            <br/>
            <hr>
            <p>Administrator jurisdiction</p>
 
            <ul class="staff_operation">
                <li><a class="manage_account" href="./account_manage.php">Manage account</a></li>  
                <li><a class="edit_menu" href="./master_food_and_beverage_list.php">Edit menu (Food list)</a></li>  
            </ul>
        </div>
   
    </div>
    
<!--list-->    
 <div id="container">   
    <h1> <?php
        if ($_SESSION['type'] == "CAMPUS_MANAGER") {
            echo "Hello, Administrator for ".$_SESSION['campus'];
        }
        else {
            echo "Welcome, Our Respected Board Manager";
        }
        
        ?></h1>
    
   <!--Manage area for Border management-->
    
        <!--show cafe menu and products list-->
        
        <?php
        
        // For diretor board or managers to create menu 
            if ($_SESSION['type'] == "CAMPUS_MANAGER" || $_SESSION['type'] == "DIRECTOR_BOARD") {
                
                $sql = "SELECT * FROM menu_apply_date WHERE ID=0";
                $result = $mysqli->query($sql);
                $row = $result->fetch_assoc();
               
        echo "<div class='all_iteam_menu'>
                <div class='navigation'>
                    <div class='navigation_head'>
                    <p>Product list</p>
                    </div>
                    <div class='option option_masterfood'>
                    <a  href='javascript:void(0)'>Master food</a>
                    </div>
                    <div class='option_and'>
                    <span>&</span>
                   </div>
                   <div class='option option_beverage'>
                    <a  href='javascript:void(0)'>Beverage</a>
                   </div>
                   
                       <span id='s_date'> Last Applied Date: $row[Date]</span>
                        
                       <form id='date_form'>
                           <label>Applied Date</label>
                           <input type='date' id='date_menu' name='date'>
                           <input type='submit' name='date_submit'>
                       </form>
                       
            </div>
        
        <div class='list master_food_list'>
            <table>
               
                <tr><th>Name</th><th>Price</th><th>Description</th><th>Catalogue</th><th>Pic Herf</th><th colspan='2'>Operation</th></tr>";
                
                //GET ITEAMS
                $sql = "SELECT * FROM iteam WHERE Type='MASTER_FOOD'";
                $result = $mysqli->query($sql);
              
                    if ($result->num_rows > 0) {
                        while ($it = $result->fetch_assoc()) {  
                            
                            //print details of this iteam
                            echo "<tr><td class='food_id'>".$it['Iteam_id']."</td><td>".$it['Price']." $</td><td>".$it['Description']."</td><td>".$it['Type']."</td><td>".$it['Href']."</td><td><input type='button' class='edit_button' value='Edit'></td><td><form method='get' action='./master_food_and_beverage_list.php' onsubmit='return confirm_operation();'><input type='hidden' value='".$it['Iteam_id']."' name='id'><input type='submit' name='delete' class='delete_button' action='./master_food_and_beverage.php' value='Delete'/></form></td></tr>";
                        }
                    }
                    else {
                        echo "no data"; 
                    }
             
          echo  "</table>
            </div>
        <br/>
     <div class='list beverage_list'>
            <table>
               <div>
                   <tr><th>Name</th><th>Price</th><th>Description</th><th>Catalogue</th><th>Pic Herf</th><th colspan='2'>Operation</th></tr>";
                
                //GET ITEAMS
                $sql = "SELECT * FROM iteam WHERE Type='BEVERAGE'";
                $result = $mysqli->query($sql);
              
                    if ($result->num_rows > 0) {
                        while ($it = $result->fetch_assoc()) {  
                            
                            //print details of this iteam
                            echo "<tr><td class='food_id'>".$it['Iteam_id']."</td><td>".$it['Price']." $</td><td>".$it['Description']."</td><td>".$it['Type']."</td><td>".$it['Href']."</td><td><input type='button' class='edit_button' value='Edit' onclick=''></td><td><form method='get'action='./master_food_and_beverage_list.php' onsubmit='return confirm_operation();'><input type='hidden' value='".$it['Iteam_id']."' name='id'><input type='submit' name='delete' class='delete_button' action='./master_food_and_beverage.php' value='Delete' /></form></td></tr>";
                        }
                    }
                    else {
                        echo "no data"; 
                    }
                  
                echo "</div>
            </table>
       </div>
     
        
        <div class='operation_area'>
        <div class='navigation'>
            
           <div class='navigation_head'>
           <p>Operation </p>
           </div>
            
           <div class='option option_add'>
           <a  href='javascript:void(0)'>Add New Product</a>
           </div>
    
           <div class='option option_edit'>
            <a  href='javascript:void(0)'>Edit Product</a>
           </div>
       </div>
        
        <div id=add_operation_area>
            <form id='add_form' method='get' action='./master_food_and_beverage_list.php' onsubmit='return confirm_operation();'>
                <fieldset>
                    <legend>Add</legend>
                    <p><input type='text' name='iteam_id' placeholder='Product name(ID)' /></p>
                    <p><input type='text' name='price' placeholder='Price'/></p>
                    <p><input type='text' name='description' placeholder='Description'/></p>
                    <p><select name='catalogue' form='add_form'><option value='MASTER_FOOD'>Master Food</option><option value='BEVERAGE'>Beverage</option></select></p>
                    <p><input type='text' name='pic_href' placeholder='Picture href(according to the position of php pages)' />You don't need to write this, after you submit this iteam, upload photo in the edit operation</p>
                    <p><input type='submit' name='add' value='Add new product'/> <input type='button' value='Reset' onclick='add_area_reset_button()'/></p>
                    
                </fieldset>
            </form>
        </div>
        
        <div id='edit_area'>
            <form method='get' action='./master_food_and_beverage_list.php' onsubmit='return confirm_operation();'>
                <fieldset>
                    <legend>Edit</legend>
                    <p><input type='text' id='iteam_name' name='iteam_id' placeholder='Product name(ID)' />You can't cange food's name</p>
                    <p><input type='text' id='iteam_price' name='price' placeholder='Price'/></p>
                    <p><input type='text' id='iteam_description' name='description' placeholder='Description'/></p>
                    <p><select id='iteam_catalogue' name='catalogue' /><option value='MASTER_FOOD'>Master Food</option><option value='BEVERAGE'>Beverage</option></select></p>
                    <p><input type='text' id='iteam_pic_href' name='pic_href' placeholder='Picture href(according to the position of php pages)' /> You don't need to change this, if your want'to change photo, see next form
                    </p>
                    <p><input type='submit' name='edit' value='Submit'/> <input type='button' value='Reset' onclick='edit_area_reset_button()'/></p>
                </fieldset>
            </form>
            
            <form id='update_photo' method=\"post\" enctype=\"multipart/form-data\">
                <fieldset>
                    <p><input type='text' id='iteam_name_p' name='iteam_id' placeholder='Product name(ID)' />
                    </p>
                    <p><input type=\"file\" name=\"img\" class=\"operation\" accept=\"image/*\"/></p>
                    <p><input type=\"submit\" name='foodphoto' value=\"Update food photo\"></p>
                </fieldset>
            </form>
            
        </div>
        </div>
    </div>";  
                 $mysqli->close();
            }
     else {
          $mysqli->close();
        echo "<script>window.location.href='../index.html';</script>";
     }
        ?>

    </div>   
    

    </body>
</html>
    