
<!--manage account-->

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    <link rel="icon" href="../img/icon.ico" type="image/x-icon"/> 
    <link rel="stylesheet" type="text/css" href="../css/user_side_panel.css">
    <link rel="stylesheet" type="text/css" href="../css/account_manage.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    
    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    <script type="text/javascript" src="../js/account_manage.js"></script>

    <title>Manage Account</title>
</head>
    
<body>
    <?php
        include("db_conn.php");
        session_start();
        if ($_SESSION['state'] != "login") {
            header("location:../index.html");
        }
    ?>
<!--Headers-->  
    <?php
//change email operation
    if (isset($_GET['change_email'])) {
       //UPDATE email address from database
        $sql = "UPDATE user SET Email='$_GET[email]' WHERE ID='$_SESSION[id]'";
        
        if ($mysqli->query($sql) != false) {
            $_SESSION['email'] = $_GET['email'];
            echo "<script>alert(\"Succeeded changing email address!\");</script>";
        }
        else {
           echo "<script>alert(\"Failed changing email address!\");</script>";
        }
    }
    
//change Phone numebr operation
    if (isset($_GET['change_phone'])) {
       //UPDATE phone number from database
        $sql = "UPDATE user SET Mobile='$_GET[mobile_number]' WHERE ID='$_SESSION[id]'";
        
        if ($mysqli->query($sql) != false) {
            $_SESSION['mobile'] = $_GET['mobile_number'];
            echo "<script>alert(\"Succeeded changing Phone numebr!\");</script>";
        }
        else {
            echo "<script>alert(\"Failed changing Phone numebr!\");</script>";
        }
    }    

//change password operation
    if (isset($_POST['change_password'])) {
       //UPDATE password from database
        $md5_password = MD5($_POST['password']);

        $sql = "UPDATE user SET Password='$md5_password' WHERE ID='$_SESSION[id]'";
        
        if ($mysqli->query($sql) != false) {
            $_SESSION['password'] = $md5_password;
            echo "<script>alert(\"Succeeded changing password!\");</script>";
        }
        else {
            echo "<script>alert(\"Failed changing password!\");</script>";
        }
    }


    if ($_SESSION['type'] == "DIRECTOR_BOARD" || $_SESSION['type'] == "CAMPUS_MANAGER") { //authrity protect

    //add cafe staff operation
        if (isset($_GET['add_staff_submit'])) {
           //insert new staff in database
            $md5_password = MD5($_GET['password']);

            //set campus according to cafe store
            if ($_GET['cafe'] == "Ref" || $_GET['cafe'] =="Lazenbys") {
                $campus_location = "SANDY_BAY";
            }
            else {
                $campus_location = "LANUNCESTON";
            }


            $sql = "INSERT INTO user (ID, Password, Fullname, Email, Mobile, Credit_Card, Balance, Type, Campus, Cafe)
            VALUES ('$_GET[IDnumber]', '$md5_password', '$_GET[name]', '$_GET[email]', '$_GET[phonenumber]', '$_GET[creditcard]', '0', 'CAFE_MANAGER', '$campus_location', '$_GET[cafe]')";

            if ($mysqli->query($sql) != false) {
                echo "<script>alert(\"Succeeded adding cafe staff!\");</script>";
                echo "<script>alert(\"Please remember staff's ID:".$_GET['IDnumber']." PASSWORD:".$_GET['password'].");</script>";
            }
            else {
                echo "<script>alert(\"Failed adding new staff!May caused by repetition operation\");</script>";
            }
        }

//remove a cafe staff operation
    if (isset($_GET['remove_staff'])) {
       //delete staff form database
        if ($_SESSION['type'] == "CAMPUS_MANAGER") {
            $sql = "DELETE FROM user WHERE ID='$_GET[id]' AND Campus='$_SESSION[campus]'";
        }
        else {
            $sql = "DELETE FROM user WHERE ID='$_GET[id]'";
        }
        
        $mysqli->query($sql);
        if (mysqli_affected_rows($mysqli) == 1) {
            echo "<script>alert(\"Succeeded removing staff!\");</script>";
        }
        else {
            echo "<script>alert(\"Failed removing staff!Please check your input ID.\");</script>";
        }
    } 

//allocate manager operation
    if (isset($_GET['allocate_manager'])) {
 
       //update type information from database
        if ($_SESSION['type'] == "CAMPUS_MANAGER") {
        $sql = "UPDATE user SET Type='CAMPUS_MANAGER', ID='$_GET[new_id]', Campus='$_GET[campus]', Cafe='' WHERE ID='$_GET[id]' AND Campus='$_SESSION[campus]'";
        }
        else {
            $sql = "UPDATE user SET Type='CAMPUS_MANAGER', ID='$_GET[new_id]', Campus='$_GET[campus]', Cafe='' WHERE ID='$_GET[id]'";
        }
       $mysqli->query($sql);
      
        if (mysqli_affected_rows($mysqli) == 1) {
            echo "<script>alert(\"Succeeded allocating manager!\");</script>";
            echo "<script>alert(\"USED ID:".$_GET['id']."   PRESENT ID:".$_GET['new_id']."\");</script>";
        }
        else {
            echo "<script>alert(\"Failed allocating manager!Please check your input ID.\");</script>";
        }
    }
    
//allocate CAFE operation
    if (isset($_GET['allocate_cafe'])) {
            //set campus according to cafe store
            if ($_GET['cafe'] == "Walk" || $_GET['cafe'] =="Grove" ) {
                $campus_location = "LANUNCESTON";
            }
            else {
                $campus_location = "SANDY_BAY";
            }

           //update type information from database
        if ($_SESSION['type'] == "CAMPUS_MANAGER") {
            $sql = "UPDATE user SET Cafe='$_GET[cafe]', Campus='$campus_location' WHERE ID='$_GET[id]' AND Campus='$_SESSION[campus]'";
        }
        else {
            $sql = "UPDATE user SET Cafe='$_GET[cafe]', Campus='$campus_location' WHERE ID='$_GET[id]'";
        }
            $mysqli->query($sql);
          
            if (mysqli_affected_rows($mysqli) == 1) {
                echo "<script>alert(\"Succeeded allocating cafe!\");</script>";
                echo "<script>alert(\"PRESENT CAFE:".$_GET['cafe']."\");</script>";
            }
            else {
                echo "<script>alert(\"Failed allocating cafe!Please check your input ID.\");</script>";
            }
        }    
    }
 ?>
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
                    <img  src="<?php echo $_SESSION['headphoto'] ?>" onerror="this.src='../img/error.png'" alt="user"/>
                </div>
            </center>
            
            <ul class="information">
                <li>ID number: 
                    <?php
                            echo $_SESSION['id'];
                    ?>
                    </li>
                <li>Full Name: 
                    <?php 
                        echo $_SESSION['user_name'];
                    ?>
                   </li>
            </ul>
            
        </div>
        
        <div id="normal_operation">
            <ul class="change_information">
                <li><a href="./account.php">Balance: <span id="balance">
                    <?php
                        echo $_SESSION['balance'];
                    ?>
                    </span></a></li> 
                <li ><a class="change_email" href="javarscript:void(0)">Email: <span id="emailaddress">
                    <?php
                            echo $_SESSION['email'];
                    ?>
                    </span></a></li> 
                <li><a class="change_mobile" href="javarscript:void(0)">Mobile number: <span id="mobilenumber">
                    <?php
                            echo $_SESSION['mobile'];
                    ?>
                    </span></a></li> 
                <li><a class="change_password" href="javarscript:void(0)">Password: <span>******</span></a></li> 
            </ul>
        </div>
            
        <?php
            if ($_SESSION['type'] == "CAMPUS_MANAGER" || $_SESSION['type'] =="DIRECTOR_BOARD") {
                 echo "<div id=\"board_member_operation\">
                        <br/>
                        <hr>
                        <p>Administrator jurisdiction</p>

                        <ul class=\"board_operation\">
                            <li><a class=\"add_cafe_staff\" href=\"javarscript:void(0)\">Add café staff</a></li>
                            <li><a class=\"remove_cafe_staff\" href=\"javarscript:void(0)\">Remove café staff</a></li>
                            <li><a class=\"allocate_staff_to_managers\" href=\"javarscript:void(0)\">Allocate managers</a></li>
                            <li><a class=\"allocate_staff_to_cafe\" href=\"javarscript:void(0)\">Allocate staff to café</a></li>
                            <li><a class=\"edit_menu\" href=\"master_food_and_beverage_list.php\">Edit menu (Food list)</a></li>
                        </ul>
                    </div>";
            }
            //order list page for cafe staff
                
            if ($_SESSION['type'] == "CAFE_MANAGER") {
                echo "<div id=\"board_member_operation\">
                        <br/>
                        <hr>
                        <p>Administrator jurisdiction</p>
                        <ul class=\"board_operation\">";
                echo "<li><a class='manage_account' href='./order_list.php'>Café Orders list</a></li>
                     <li><a class=\"edit_menu\" href=\"./menu_management.php\">Edit menu (Food list)</a></li>";
                echo "</ul>
                    </div>";
            }
 
           ?>     
    </div>
    
    <div id="container">
        
        <!--navigator-->
        <div id="navigation">
            <div id="stop_event">
            </div>
        </div>
        
        <!--change user's emial-->
        <div class="change" id="change_email">
            <h1>Please input your new email: </h1>
            <form method="get" onsubmit="return validation_email();" id="change_email_area">
                <fieldset>
                    <p><input type="text" id="email" placeholder="Email" name="email" /></p>
                    <p><input type="submit" id="change_email" name="change_email" value="Submit" /><input type="button" class="reset_button" value="Reset"></p>
                </fieldset>
            </form>
        </div>
        
        <!--change user's mobile phone number-->
        <div class="change" id="change_mobile">
            <h1>Please input your new mobile number: </h1>
            <form id="change_mobile_area" method="get" onsubmit="return validation_mobile_phone();">
                <fieldset>
                    <p><input type="text" id="phonenumber" placeholder="Mobile" name="mobile_number" /></p>
                    <p><input type="submit" name="change_phone" value="Submit"/><input type="button" class="reset_button" value="Reset"></p>
                </fieldset>
            </form>
        </div>
        
        <!--change user's password-->
        <div class="change" id="change_password">
            <h1>Please input your new password: </h1>
            <form id="change_password_area" method="post" onsubmit="return validation_password();">
                <fieldset>
                    <p><input type="password" placeholder="Password" id="password" name="password" /></p>
                    <p><input type="password" placeholder="Confirm Password" id="confirm_password" /></p>
                    <p><input type="submit" name="change_password" value="Submit"><input type="button" class="reset_button" value="Reset"></p>
                </fieldset>
            </form>
        </div>

        <!--add cafe staff-->
        <div class="change" id="add_cafe_staff">
            
            <!--show cafe staff-->
            <div class="head_title">
                <h1>Exsiting Staffs:</h1>
            </div>
            
            <div class="list">
                <table>
                       <tr><th>ID</th><th>NAME</th><th>Café</th><th>Campus</th></tr>
                    <?php
                    //GET STAFF INFORMATION 
                     
                            $sql = "SELECT * FROM user WHERE Type='CAFE_MANAGER'";

                            $result = $mysqli->query($sql);

                            if ($result->num_rows > 0) {
                                while ($it = $result->fetch_assoc()) {  

                                    //print details of this staff
                                    echo "<tr><td>".$it['ID']."</td><td>".$it['Fullname']."</td><td>".$it['Cafe']."</td><td>".$it['Campus']."</td></tr>";
                                }
                            }
                            else {
                                echo "no data"; 
                            }
                      ?> 
                </table>
            </div>
            
            <div class="head_title">
                <h1>Add a new staff</h1>
            </div>
            
            <form method="get" id="add_staff" onsubmit="return validation_add_staff();">
                <fieldset>
                    <p><input type="text" id="name" name="name" placeholder="Full Name"/></p>
		            <p><input type="text" name="IDnumber" id="add_staff_IDnumber" placeholder="Staff ID(CMnnnn)"/></p>
                    <p><input type="text" id="add_staff_email" name="email" placeholder="Email"/></p>
                    <p><input type="text" name="phonenumber" id="add_staff_phonenumber" placeholder="Mobile"/></p>
                    <p><input type="text" id="creditcard" name="creditcard" placeholder="Credit Card"/></p>
                    <p><input type="password" id="add_staff_password" name="password"  placeholder="Password"/></p>
		            <p><input  name="confirm_password" id="add_staff_confirm_password" type="password" placeholder="Retype Password"/></p>
		          
                    <p><select name='cafe' form='add_staff'>
                        <?php
                            if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "SANDY_BAY") {
                                echo "<option value='Ref'>Ref's café</option><option value='Lazenbys'>Lazenbys 's café</option>";
                            }
                            
                            else if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "LANUNCESTON") {
                                echo "<option value='Walk'>Walk's café</option><option value='Grove'>Grove 's café</option>";
                            }
                        
                            else IF ($_SESSION['type'] == "DIRECTOR_BOARD") {
                                echo "<option value='Ref'>Ref's café</option><option value='Lazenbys'>Lazenbys 's café</option>";
                                echo "<option value='Walk'>Walk's café</option><option value='Grove'>Grove 's café</option>";
                            }
                        ?>    
                        </select></p>
    
                    <p><input id="submit" type="submit" name="add_staff_submit" value="ADD A STAFF"><input type="button" class="reset_button" value="Reset" ></p>
                </fieldset>
            </form>
        </div>
        
        <!--remove a cafe staff-->
        <div class="change" id="remove_cafe_staff">
    
            <!--show cafe staff-->
            <div class="head_title">
                <h1>Exsiting Staffs:</h1>
            </div>

            <div class="list">
                <table>
                   
                       <tr><th>ID</th><th>NAME</th><th>Café</th><th>Campus</th></tr>
                    <?php
                    //GET STAFF INFORMATION according to adiministrator's type
                       if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "SANDY_BAY") {
                                $sql = "SELECT * FROM user WHERE Campus='SANDY_BAY' AND Type='CAFE_MANAGER'";
                            }
                            
                            else if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "LANUNCESTON") {
                                $sql = "SELECT * FROM user WHERE Campus='LANUNCESTON' AND Type='CAFE_MANAGER'";
                            }
 
                            else if ($_SESSION['type'] == "DIRECTOR_BOARD") {
                                $sql = "SELECT * FROM user WHERE Type='CAFE_MANAGER'";
                            }
                     
                            $result = $mysqli->query($sql);

                            if ($result->num_rows > 0) {
                                while ($it = $result->fetch_assoc()) {  

                                    //print details of this staff
                                    echo "<tr><td>".$it['ID']."</td><td>".$it['Fullname']."</td><td>".$it['Cafe']."</td><td>".$it['Campus']."</td></tr>";
                                }
                            }
                            else {
                                echo "no data"; 
                            }
                      ?>
                    
                </table>
            </div>
            
            <div class="head_title">
                 <h1>Remove a staff</h1>
            </div>
            
            <form method="get" onsubmit="return validation_remove_staff();">
                <fieldset>
                    <p><input type="text" name="id" id="remove_staff_id" placeholder="ID" /></p>
                    <p><input type="submit" name="remove_staff" value="REMOVE"/><input type="button" class="reset_button" value="Reset"></p>
                </fieldset>
            </form>
            </div>
        
        <!--allocate staff to managers-->
        
        <div class="change" id="allocate_staff_to_managers">
            
            <div class="head_title">
                <h1>Exsiting Staffs:</h1>
            </div>

            <div class="list">
                <table>
                       <tr><th>ID</th><th>NAME</th><th>Café</th><th>Campus</th></tr>
                            <?php
                                //GET STAFF INFORMATION
                                        $sql = "SELECT * FROM user WHERE Type='CAFE_MANAGER'";

                                        $result = $mysqli->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($it = $result->fetch_assoc()) {  

                                                //print details of this STAFF
                                                echo "<tr><td>".$it['ID']."</td><td>".$it['Fullname']."</td><td>".$it['Cafe']."</td><td>".$it['Campus']."</td></tr>";
                                            }
                                        }
                                        else {
                                            echo "no data"; 
                                        }
                       ?>
                </table>
            </div>
            
            <div class="head_title">
                <h1>Exsiting Campus Managers:</h1>
            </div>

            <div class="list">
                <table>
                       <tr><th>ID</th><th>NAME</th><th>Campus</th></tr>
                            <?php
                                //GET STAFF INFORMATION
                                        $sql = "SELECT * FROM user WHERE Type='CAMPUS_MANAGER'";

                                        $result = $mysqli->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($it = $result->fetch_assoc()) {  

                                                //print details of this STAFF
                                                echo "<tr><td>".$it['ID']."</td><td>".$it['Fullname']."</td><td>".$it['Campus']."</td></tr>";
                                            }
                                        }
                                        else {
                                            echo "no data"; 
                                        }
                       ?>
                </table>
            </div>
            
            <div class="head_title">
                <h1>Allocate staff to manager</h1>
                
            </div>
                
            <form id="allocate_manager" onsubmit="return validation_allocate_manager();" method="get">
                <fieldset>
                    <p><input type="text" name="id" id="allocate_staff_to_manager_id" placeholder="ID" /></p>
                    <p><input type="text" name="new_id" id="allocate_staff_to_manager_new_id" placeholder="NEW ID(CAnnnn)" /></p>
                    
                    <p><select name='campus' form='allocate_manager'>
                        <?php
                       
                            if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "SANDY_BAY") {
                                echo "<option value='SANDY_BAY'>Sandy Bay</option>";
                            }
                            
                            else if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "LANUNCESTON") {
                                echo "<option value='LANUNCESTON'>Lanunceston</option>";
                            }
                        
                            else if ($_SESSION['type'] == "DIRECTOR_BOARD") {
                                echo "<option value='SANDY_BAY'>Sandy Bay</option>";
                                echo "<option value='LANUNCESTON'>Lanunceston</option>";
                            }
                        ?>    
                        </select></p>
                    
                    <p><input type="submit" name="allocate_manager" value="ALLOCATE"><input type="button" class="reset_button" value="Reset"></p>
                </fieldset>
            </form>
        </div>
        
        <!--allocate staff to cafe-->
        <div class="change" id="allocate_staff_to_cafe">
             
                <div class="head_title">
                    <h1>Exsiting Staffs:</h1>
                </div>
            
            <div class="list">
                <table>
                       <tr><th>ID</th><th>NAME</th><th>Café</th><th>Campus</th></tr>
                    <?php
                    //GET STAFF INFORMATION according to adiministrator's type
                       if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "SANDY_BAY") {
                                $sql = "SELECT * FROM user WHERE Campus='SANDY_BAY' AND Type='CAFE_MANAGER'";
                            }
                            
                            else if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "LANUNCESTON") {
                                $sql = "SELECT * FROM user WHERE Campus='LANUNCESTON' AND Type='CAFE_MANAGER'";
                            }
 
                            else IF ($_SESSION['type'] == "DIRECTOR_BOARD") {
                                $sql = "SELECT * FROM user WHERE Type='CAFE_MANAGER'";
                            }
                       
                            $result = $mysqli->query($sql);

                            if ($result->num_rows > 0) {
                                while ($it = $result->fetch_assoc()) {  

                                    //print details of this staff
                                    echo "<tr><td>".$it['ID']."</td><td>".$it['Fullname']."</td><td>".$it['Cafe']."</td><td>".$it['Campus']."</td></tr>";
                                }
                            }
                            else {
                                echo "no data"; 
                            }
                      ?>
                    </table>
                </div>
        
            <div class="head_title">
                <h1>Allocate staff to café store</h1>
            </div>
            
            <form id="allocate_cafe" onsubmit="return validation_allocate_cafe();" method="get">
                <fieldset>
                    <p><input type="text" id="allocate_cafe_id" name="id" placeholder="ID" /></p>
                    <p><select name='cafe' form='allocate_cafe'>
                        <?php
                            if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "SANDY_BAY") {
                                echo "<option value='Ref'>Ref's café</option><option value='Lazenbys'>Lazenbys 's café</option>";
                            }
                            
                            else if ($_SESSION['type'] == "CAMPUS_MANAGER" && $_SESSION['campus'] == "LANUNCESTON") {
                                echo "<option value='Walk'>Walk's café</option><option value='Grove'>Grove 's café</option>";
                            }
                        
                            else IF ($_SESSION['type'] == "DIRECTOR_BOARD") {
                                echo "<option value='Ref'>Ref's café</option><option value='Lazenbys'>Lazenbys 's café</option>";
                                echo "<option value='Walk'>Walk's café</option><option value='Grove'>Grove 's café</option>";
                            }
                        ?>    
                        </select></p>
                    <p><input type="submit" name="allocate_cafe" value="ALLOCATE"><input type="button" class="reset_button" value="Reset"></p>
                    
                </fieldset>
            </form>
        </div>
        
        
    </div>
    <?php
        $mysqli->close();
    ?>
    </body>
</html>



