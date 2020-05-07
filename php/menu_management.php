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
    

    <title>Menu Management</title>
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
            <li><a href="../index.html">Home</a></li>
            
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
    



<?php
//remove operation
        if (isset($_GET['remove'])) {
            //select corresponding database
            if ($_SESSION['cafe']=="Ref") {
                $cafe_database = "ref_cafe_iteam";
            }
            else if ($_SESSION['cafe']=="Lazenbys") {
                $cafe_database = "lazenbys_cafe_iteam";
            }
            else if ($_SESSION['cafe']=="Walk") {
                $cafe_database = "walk_cafe_iteam";
            }
            else if ($_SESSION['cafe']=="Grove") {
                $cafe_database = "grove_cafe_iteam";
            }
             else{
				$_SESSION['cafe']=="Trade_Table";
                $cafe_database = "trade_table_cafe_iteam";
            }
            
            $sql = "DELETE FROM ".$cafe_database." WHERE Iteam_id='$_GET[id]'";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
        }
    
    //add to cafe menu operation    
	
        if (isset($_GET['add_cafe_menu'])) {
            //select corresponding database
            if ($_SESSION['cafe']=="Ref") {
                $cafe_database = "ref_cafe_iteam";
            }
            else if ($_SESSION['cafe']=="Lazenbys") {
                $cafe_database = "lazenbys_cafe_iteam";
            }
            else if ($_SESSION['cafe']=="Walk") {
                $cafe_database = "walk_cafe_iteam";
            }
            else if ($_SESSION['cafe']=="Grove") {
                $cafe_database = "grove_cafe_iteam";
            }
            else{
				$_SESSION['cafe']=="Trade_Table";
                $cafe_database = "trade_table_cafe_iteam";
            }
		
            $sql = "INSERT INTO ".$cafe_database." (Iteam_id, Type)
                    VALUES ('$_GET[id]','$_GET[type]')";

	       if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
        }  
    
        //set business time
        if(isset($_GET['submit_time'])) {
            $sql = "UPDATE business_time SET Open_time='$_GET[open_time]', Close_time='$_GET[close_time]' WHERE Cafe='$_SESSION[cafe]'";
             if($mysqli->query($sql)==false) {
		      echo "failed: ".$mysqli->error;
	       }
		   else {
			   echo "<script>alert('Succeed!');</script>";
		   }
        }
    ?>
    <div id="container">
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
                <li><a class="edit_menu" href="./menu_management.php">Menu management</a></li>
                <li><a class='manage_account' href='./cafe_orders.php'>Café Orders list</a></li>  
            </ul>
        </div>
   
    </div>
        
        <div class='cafe_menu'>
        <?php
        //Manage area for cafe staff
            if($_SESSION['type'] == "CAFE_MANAGER") {
 
            echo "<h1>Hello, Administrator for ".$_SESSION['cafe']." Café</h1>";
    
            echo "<div class='cafe_menu'>
                   <div class='navigation'>
                       <div class='navigation_head'>
                       <p>Your café menu list</p>
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
                   </div>

                    <div class='list master_food_list'>
                       <table>

                           <tr><th>Name</th><th>Price</th><th>Description</th><th>Catalogue</th><th>Pic Herf</th><th >Operation</th></tr>";
                            //select corresponding database
                            if ($_SESSION['cafe']=="Ref") {
                                    $cafe_database = "ref_cafe_iteam";
                                }
                                else if ($_SESSION['cafe']=="Lazenbys") {
                                    $cafe_database = "lazenbys_cafe_iteam";
                                }
                                else if ($_SESSION['cafe']=="Walk") {
                                    $cafe_database = "walk_cafe_iteam";
                                }
                                else if ($_SESSION['cafe']=="Grove") {
                                    $cafe_database = "grove_cafe_iteam";
                                }
                                else {
                                    $cafe_database = "trade_table_cafe_iteam";
                                }
                            //GET ITEAMS
                            
                            $sql = "SELECT * FROM ".$cafe_database." WHERE Type='MASTER_FOOD'";
                            $result = $mysqli->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($it = $result->fetch_assoc()) {  
                                        
                                        //get detail information
                                        $query = "SELECT * FROM iteam WHERE Iteam_id='$it[Iteam_id]'";
                                        $res = $mysqli->query($query);
                                        $row = $res->fetch_assoc();
                                        
                                        //print details of this iteam
                                        echo "<tr><td class='food_id'>".$row['Iteam_id']."</td><td>".$row['Price']." $</td><td>".$row['Description']."</td><td>".$row['Type']."</td><td>".$row['Href']."</td><td><form method='get' onsubmit='return confirm_operation();'><input type='hidden' name='id' value='".$row['Iteam_id']."'><input type='submit' class='remove_button' name='remove' value='Remove'/></form></td></tr>";
                                    }
                                }
                                else {
                                     echo "no data"; 
                                }

                      echo "</table>
                    </div>


                   <div class='list beverage_list'>
                       <table>

                           <tr><th>Name</th><th>Price</th><th>Description</th><th>Catalogue</th><th>Pic Herf</th><th >Operation</th></tr>";
                            
                            //GET ITEAMS
                         //select corresponding database
                                if ($_SESSION['cafe']=="Ref") {
                                    $cafe_database = "ref_cafe_iteam";
                                }
                                else if ($_SESSION['cafe']=="Lazenbys") {
                                    $cafe_database = "lazenbys_cafe_iteam";
                                }
                                else if ($_SESSION['cafe']=="Walk") {
                                    $cafe_database = "walk_cafe_iteam";
                                }
                                else if ($_SESSION['cafe']=="Grove") {
                                    $cafe_database = "grove_cafe_iteam";
                                }
                                else {
                                    $cafe_database = "trade_table_cafe_iteam";
                                }
            
                            $sql = "SELECT * FROM ".$cafe_database." WHERE Type='BEVERAGE'";
                            $result = $mysqli->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($it = $result->fetch_assoc()) {  
                                        
                                        //get detail information
                                        $query = "SELECT * FROM iteam WHERE Iteam_id='$it[Iteam_id]'";
                                        $res = $mysqli->query($query);
                                        $row = $res->fetch_assoc();
                                        
                                        //print details of this iteam
                                        echo "<tr><td class='food_id'>".$row['Iteam_id']."</td><td>".$row['Price']." $</td><td>".$row['Description']."</td><td>".$row['Type']."</td><td>".$row['Href']."</td><td><form method='get' onsubmit='return confirm_operation();'><input name='id' type='hidden' value='".$row['Iteam_id']."'><input type='submit' class='remove_button' name='remove' action='./master_food_and_beverage.php' value='Remove'/></form></td></tr>";
                                    }
                                }
                                else {
                                     echo "no data"; 
                                }

                      echo "</table>
                    </div>
                </div>
                <br/>
                 <div class='all_iteam_menu'>
                   <div class='navigation'>
                       <div class='navigation_head'>
                        <p>Product list </p>
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
                   </div>
                
                <div class='list master_food_list'>
                        <table>

                           <tr><th>Name</th><th>Price</th><th>Description</th><th>Catalogue</th><th>Pic Herf</th><th >Operation</th></tr>";
                            
                            //GET ITEAMS
                            $sql = "SELECT * FROM iteam WHERE Type='MASTER_FOOD'";
                            $result = $mysqli->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($it = $result->fetch_assoc()) {  

                                        //print details of this iteam
                                        echo "<tr><td class='food_id'>".$it['Iteam_id']."</td><td>".$it['Price']." $</td><td>".$it['Description']."</td><td>".$it['Type']."</td><td>".$it['Href']."</td><td><form method='get' ><input type='hidden' name='id' value='".$it['Iteam_id']."'><input type='hidden' name='type' value=".$it['Type']."><input type='submit' name='add_cafe_menu' class='add_button' value='Add'></form></td></tr>";
                                    }
                                }
                                else {
                                     echo "no data"; 
                                }

                     
                    echo "
                   </table>
                        </div>
                    <div class='list beverage_list'>
                        <table>

                           <tr><th>Name</th><th>Price</th><th>Description</th><th>Catalogue</th><th>Pic Herf</th><th >Operation</th></tr>";
                            
                            //GET ITEAMS
                            $sql = "SELECT * FROM iteam WHERE Type='BEVERAGE'";
                            $result = $mysqli->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($it = $result->fetch_assoc()) {  

                                        //print details of this iteam
                                        echo "<tr><td class='food_id'>".$it['Iteam_id']."</td><td>".$it['Price']." $</td><td>".$it['Description']."</td><td>".$it['Type']."</td><td>".$it['Href']."</td><td><form method='get'><input type='hidden' name='id' value='".$it['Iteam_id']."'><input type='hidden' name='type' value=".$it['Type']."><input type='submit' name='add_cafe_menu' class='add_button' value='Add'></form></td></tr>";
                                    }
                                }
                                else {
                                     echo "no data"; 
                                }
                               

                        echo "</table>
                        </div>
                     </div>";
                 
        }
         else {
              
                echo "<script>window.location.href='../index.html';</script>";
            }
        ?>
        </div>
        <?php
        //set business time
            $query="SELECT * FROM business_time WHERE Cafe='$_SESSION[cafe]'";
                //get data from result    
                $result = $mysqli->query($query);
                $row = $result->fetch_assoc(); 
            echo "<div id='change_business_time'>
                    <div class='navigation'>
                               <div class='navigation_head'>
                                   <p>Business Time:<span style='color:gray'> Oiginal business time: $row[Open_time]-$row[Close_time]</span></p>
                               </div>
                    </div>

                    <div>
                        <form method='get' id='time_form'>
                            <fieldset>
                            <label>Opening Time: </label><select form='time_form' name='open_time'>";
        //print AM selections
                $ih = 0; 
                $im = 0;
                $switch = false;
                            
             do {
                    if ($im == 0) {
                        echo "<option value='$ih:00AM'>$ih:00AM</option>";
                    }
                
                    else {
                        echo "<option value='$ih:$im"."AM'>$ih:$im"."AM</option>";
                    }
                 
                    $im+=15;
                                     
                    if ($im == 60) {
                        $ih++;
                        $im = 0;
                    }
                                     
                    if ($ih == 12) { 
                        $switch = true;
                        echo "<option value='$ih:00AM'>$ih:00"."AM</option>";
                    }
                }while ($switch == false);
            
            echo "</select>
                            <label>Closing Time: </label><select form='time_form' name='close_time'>";
            //print PM selections
                $ih = 12; 
                $im = 0;
                $switch = false;
                $switch2 = false;           
             do {
                    if ($im == 0) {
                        echo "<option value='$ih:00PM'>$ih:00PM</option>";
                    }
                 
                    else {
                        echo "<option value='$ih:$im"."PM'>$ih:$im"."PM</option>";
                    }
                 
                    $im+=15;
                                     
                    if ($im == 60 && $ih == 12) {
                        $ih = 1;
                        $im = 0;
                        $switch2 = true; 
                    }
                    else if ($im == 60) {
                        $ih++;
                        $im = 0;
                    }
                                     
                    if ($ih == 12 && $switch2 == true ) { 
                        $switch = true;
                    }
                }while ($switch == false);
        
            echo "</select>
                            <p><input id='submit_time' type='submit' name='submit_time'></p>
                            </fieldset>
                        </form>
                    </div>
                </div>";
                $mysqli->close();
        ?>
    </div>
    </body>
</html>