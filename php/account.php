
<html>
<head>
    <title></title>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/account.js"></script>
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    <link rel="stylesheet" href="../css/account.css">
    
    

</head>

<body>
    <?php
        include("db_conn.php");
        session_start();
    if ($_SESSION['state'] != "login" ) {
        header("location:../index.html");
    }
    //charge operation
    if (isset($_POST['charge_submit'])) {
        
        $amount=$_POST['amount']+$_SESSION['balance'];
        $query="UPDATE user SET Balance=".$amount." WHERE ID='$_SESSION[id]'";
        
        if ($mysqli->query($query) != false) {
            echo "<script>alert('Charge Succeed!');</script>";
            $_SESSION['balance'] = $amount; 
        }
    }

    //update headphoto
    if (isset($_POST['headphoto'])) {
        if(is_uploaded_file($_FILES['img']['tmp_name'])) {
        
            $oldname=$_FILES['img']['name'];
            $tmp = explode('.',$oldname);
            $newname=$_SESSION['id'].'.'.$tmp[1];
            $filepath="upload/".$newname;

                if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath))
            {
                $query = "UPDATE user SET Head_photo_href='./upload/".$newname."' WHERE ID='$_SESSION[id]'";    
                   
                if ($mysqli->query($query)) {
                    $_SESSION['headphoto'] = $filepath;
                    echo "<script>alert('Succeed!');</script>";
                }
                else {
                        echo "<script>alert('Failed!');</script>";
                    }
            }
        }

          else {
              echo "<script>alert('Failed to upload img!');</script>";
            }
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
            <p>Welcome Y.E.O.M!</p>
            <input type="submit"  name="log_out" value="Log out">
            </fieldset>
        </form>
    </div> 
</div>
    
<!--main content-->    
<div class="main">
    
<!--show user's details-->
		 <div class="profile">
			 <div class="profile-top">
				 <div class="pic-sec">
					 <div class="pic">
						 <img src="<?php echo $_SESSION['headphoto'] ?>" onerror="this.src='../img/error.png'" alt="pic"/>
					 </div>
					 <div class="pic_info">
						 <h2><?php echo $_SESSION['user_name'];?></h2>
                         <form action="./account.php" method="post" enctype="multipart/form-data"><input type="file" name="img" class="operation" accept="image/*"/><input type="submit" name='headphoto' value="Update your photo"></form>
					 </div>
                     
				 </div>	
			 </div>
             
			 <div class="profile-bottom">
				 <ul id="detail">
				    <li class="operation"><a  id="show" href="javascript:void(0);">Balance(Click to charge): 
                        <?php
                            echo $_SESSION['balance'];
                        ?>
                        </a></li> 			
                    <li><a href="javascript:void(0);">ID: 
                        <?php
                            echo $_SESSION['id'];
                        ?>
                        </a></li>
                    <li><a href="javascript:void(0);">Email: 
                        <?php
                            echo $_SESSION['email'];
                        ?>
                        </a></li>
                    <li><a href="javascript:void(0);">Mobile: 
                        <?php
                            echo $_SESSION['mobile'];
                        ?>
                        </a></li>
                    
                      <li><a href='./order.php'>Your Orders</a></li>
                           
				    <li class="operation"><a href="./account_manage.php">Manage account</a></li>  
				 </ul>
			 </div>
		 </div>

    <!--charge area-->
        <div class="charge_area">
            
            <form id="charge" action="./account.php" method='post'>
                <p><input id="card" type="number" name="creditcard" placeholder="Credit Card"></p>
                
                <?php
                //assign credit card number value to this input
                    echo "<script>$('#card').val(".$_SESSION['card'].")</script>"; 
                ?>
                
                <p><input type="number" name="scv" placeholder="SCV"></p>
                <p><input type="number" min=1 name="amount" placeholder="Amount"></p>
                <p><input type="submit" name="charge_submit" value="Payment"/></p>
            </form>  
            <input type="button" value="Back" onclick="back()"/>
            
            <div class="info">
            <p>Now, if you use xxxx'bank's credit card,</p>
            <p>we will give your some surprise!</p>
            </div>
        </div>
    
    </div>
    <?php
        $mysqli->close();
    ?>
</body>
</html>
