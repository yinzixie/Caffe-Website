<!--process order-->

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="icon" href="../img/icon.ico" type="image/x-icon"/> 
    <link rel="stylesheet" type="text/css" href="../css/php.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    
    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    <?php
        include("db_conn.php");
        session_start();
    ?>
    <title>php</title>
</head>
    
<body>
    
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
    
    
<?php
//process order
    include ("./db_conn.php");

    if(isset($_POST["trolley_submit"])) {
//generate a randomly and unique ID
        $cartid=$_SESSION['id'].date("ymdhms").rand(0,100);
        $date=date("Y-m-d");
        
//transfer all the data from temp database to formal database
        //update user's balance
        $balance=$_SESSION['balance']-$_POST['real_cost'];
        
        if ($mysqli->query("UPDATE user SET Balance='$balance' WHERE ID='$_SESSION[id]'") != false) {
        
            $_SESSION['balance'] = $balance;
            //transfer head-list and delete the temporary head-list
            $query = "INSERT $_SESSION[head_cart_list] (ID, Cart_id, Cost, Collection_time, Date) VALUES ('$_SESSION[id]', '$cartid', '$_POST[real_cost]', '$_POST[collection_time]','$date')";

            if ($mysqli->query($query) != false) {
                $query = "DELETE FROM $_SESSION[temp_head_cart_list] WHERE ID='$_SESSION[id]'";
                $mysqli->query($query);
            }

            //insert the details of order and delete the temporary order
            $query = "SELECT * FROM $_SESSION[temp_cart_list] WHERE Cart_id='$_SESSION[temp_cart]'";

            $result=$mysqli->query($query);

            if ($result->num_rows > 0) {
                while($row=$result->fetch_assoc()) {
                    $sql="INSERT $_SESSION[cart_list] (Cart_id, Iteam_id, Amount, Description) VALUES ('$cartid', '$row[Iteam_id]', '$row[Amount]', '$row[Description]')";

                    if ($mysqli->query($sql) == false) {
                        echo "ERROR:FALIED TO UPLOAD DATA";
                    }

                    //delete temp data
                    else {
                        $mysqli->query("DELETE FROM $_SESSION[temp_cart_list] WHERE Iteam_id='$row[Iteam_id]'");
                    }
                }  

                echo "<div id='p'>Submit succeed!</div>";

                echo "<script>
                            alert('Succeed!Press to go back.');
                            window.history.back();

                        </script>";
            }  

    
        }
        else {
            echo "<script>
                            alert('Failed!Press to go back.');
                            window.history.back();

                        </script>";
        }
        $mysqli->close();
    }
    
        
   
else {
    $mysqli->close();
    header("location:../index.html");
}
?>
    
    </body>
</html>