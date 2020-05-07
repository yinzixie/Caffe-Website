<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="icon" href="../img/icon.ico" type="image/x-icon"/> 
    <link rel="stylesheet" type="text/css" href="../css/user_side_panel.css">
    <link rel="stylesheet" type="text/css" href="../css/order.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    
    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    <script type="text/javascript" src="../js/account_manage.js"></script>

    <title>Your Orders</title>
</head>
    
<body>
    <?php
        include("db_conn.php");
        session_start();
        
        if($_SESSION['type'] != "CAFE_MANAGER") {
            header("location:./account.php");
        }
    ?>
    
    <!--header-->
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
    <div>
    <div class='list'>
        <div class="head">
                <p>
                   Your orders
                </p>
            </div>
     <table id="head_list">
                <tr><th>ID</th><th>Cart Id</th><th>Cost</th><th>Collection Time</th><th>Date</th><th>Cafe</th><th>Operation</th></tr>
                    <?php
                //select corresponding database
                        
                            $GLOBALS["headlist"] = "ref_cafe_head_cart_list";
                            $GLOBALS["list"] = "ref_cafe_cart_list";
                            $sql="SELECT * FROM $GLOBALS[headlist] WHERE ID='$_SESSION[id]'";
                           
                            $result=$mysqli->query($sql);
                
                            if ($result->num_rows > 0) {
                                while ($row=$result->fetch_assoc()) {
                                    echo "<tr><td>".$row['ID']."</td><td>".$row['Cart_id']."</td><td>".$row['Cost']."</td><td>".$row['Collection_time']."</td><td>".$row['Date']."</td><td>Ref Cafe</td><td><form method='get'><input type='hidden' name='cart_hdb' value=".$GLOBALS["headlist"]."><input type='hidden' name='cart_db' value=".$GLOBALS["list"]."><input type='hidden' name='cart_id' value=".$row['Cart_id']."><input type='submit' name='details' class=\"show_details\" type=\"button\" value=\"Details\" onclick=\"\"></form></td></tr>";
                                }
                            }
         
                        
                            $GLOBALS["headlist"] = "walk_cafe_head_cart_list";
                            $GLOBALS["list"] = "walk_cafe_cart_list";
                            $sql="SELECT * FROM $GLOBALS[headlist] WHERE ID='$_SESSION[id]'";
         
                            $result=$mysqli->query($sql);
                
                            if ($result->num_rows > 0) {
                                while ($row=$result->fetch_assoc()) {
                                    echo "<tr><td>".$row['ID']."</td><td>".$row['Cart_id']."</td><td>".$row['Cost']."</td><td>".$row['Collection_time']."</td><td>".$row['Date']."</td><td>Walk Cafe</td><td><form method='get'><input type='hidden' name='cart_hdb' value=".$GLOBALS["headlist"]."><input type='hidden' name='cart_db' value=".$GLOBALS["list"]."><input type='hidden' name='cart_id' value=".$row['Cart_id']."><input type='submit' name='details' class=\"show_details\" type=\"button\" value=\"Details\" onclick=\"\"></form></td></tr>";
                                }
                            }
         
                     
                            $GLOBALS["headlist"] = "lazenbys_cafe_head_cart_list";
                            $GLOBALS["list"] = "lazenbys_cafe_cart_list";
                            $sql="SELECT * FROM $GLOBALS[headlist] WHERE ID='$_SESSION[id]'";
                             
                            $result=$mysqli->query($sql);
                
                            if ($result->num_rows > 0) {
                                while ($row=$result->fetch_assoc()) {
                                    echo "<tr><td>".$row['ID']."</td><td>".$row['Cart_id']."</td><td>".$row['Cost']."</td><td>".$row['Collection_time']."</td><td>Lazenbys Cafe</td><td><form method='get'><input type='hidden' name='cart_hdb' value=".$GLOBALS["headlist"]."><input type='hidden' name='cart_db' value=".$GLOBALS["list"]."><input type='hidden' name='cart_id' value=".$row['Cart_id']."><input type='submit' name='details' class=\"show_details\" type=\"button\" value=\"Details\" onclick=\"\"></form></td></tr>";
                                }
                            }
                                   
                            $GLOBALS["headlist"] = "grove_cafe_head_cart_list";
                            $GLOBALS["list"] = "grove_cafe_cart_list";
                            $sql="SELECT * FROM $GLOBALS[headlist] WHERE ID='$_SESSION[id]'";
         
                            $result=$mysqli->query($sql);
                
                            if ($result->num_rows > 0) {
                                while ($row=$result->fetch_assoc()) {
                                    echo "<tr><td>".$row['ID']."</td><td>".$row['Cart_id']."</td><td>".$row['Cost']."</td><td>".$row['Collection_time']."</td><td>".$row['Date']."</td><td>Grove Cafe</td><td><form method='get'><input type='hidden' name='cart_hdb' value=".$GLOBALS["headlist"]."><input type='hidden' name='cart_db' value=".$GLOBALS["list"]."><input type='hidden' name='cart_id' value=".$row['Cart_id']."><input type='submit' name='details' class=\"show_details\" type=\"button\" value=\"Details\" onclick=\"\"></form></td></tr>";
                                }
                            }
                     
                            $GLOBALS["headlist"] = "trade_table_cafe_head_cart_list";
                            $GLOBALS["list"] = "trade_table_cafe_cart_list";
                            $sql="SELECT * FROM $GLOBALS[headlist] WHERE ID='$_SESSION[id]'";
                    
                            $result=$mysqli->query($sql);
                
                            if ($result->num_rows > 0) {
                                while ($row=$result->fetch_assoc()) {
                                    echo "<tr><td>".$row['ID']."</td><td>".$row['Cart_id']."</td><td>".$row['Cost']."</td><td>".$row['Collection_time']."</td><td>".$row['Date']."</td><td>Trade Table Cafe</td><td><form method='get'><input type='hidden' name='cart_hdb' value=".$GLOBALS["headlist"]."><input type='hidden' name='cart_db' value=".$GLOBALS["list"]."><input type='hidden' name='cart_id' value=".$row['Cart_id']."><input type='submit' name='details' class=\"show_details\" type=\"button\" value=\"Details\" onclick=\"\"></form></td></tr>";
                                }
                            }
                ?>
                
            </table>
        </div>
        
    
     <div id="line">
           l
        </div>
        
   
        <div class="list">
            <div class="head">
                <p>Details for <span id='d'></span>
                    <?php
                        if (isset($_GET['cart_id'])) {echo "$_GET[cart_id]";}
                    ?>
                </p>
            </div>

        
            <table >
               
                <tr><th>Iteam</th><th>Price</th><th>Amount</th><th>Specifics</th></tr>
            
                 <?php
                    if (isset($_GET["details"])) {
                        
                        //show details
                        $sql="SELECT * FROM $_GET[cart_db] WHERE Cart_id='$_GET[cart_id]'";

                        $result=$mysqli->query($sql);
                
                        if ($result->num_rows > 0) {
                            while ($row=$result->fetch_assoc()) {
                                //get iteam's price
                                $result2=$mysqli->query("SELECT Price FROM iteam WHERE Iteam_id='$row[Iteam_id]'");
                                $row2=$result2->fetch_assoc();
                                
                                echo "<tr><td>".$row['Iteam_id']."</td><td>".$row2['Price']."</td><td>".$row['Amount']."</td><td>".$row['Description']."</td></tr>";
                            }
                        }
                    }
                ?>
            </table>
        </div>
        
    </div>
    <?php
        $mysqli->close();
    ?>
    
    
    </body>
</html>