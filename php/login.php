<!--login validate from sql, return user name, user type, and loging state-->

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    <link rel="icon" href="../img/icon.ico" type="image/x-icon"/> 
    <link rel="stylesheet" type="text/css" href="../css/php.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    
    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>

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
    <div id="p">
    </div>
        <?php
            session_start();
            include('db_conn.php'); //db connection

            if(isset($_POST['sign_in'])) {
                //receive the username data
                $user=$_POST['logid']; 
                //receive the password data
                $password=$_POST['logpassword']; 
                $md5_password=MD5($password); //encrypte password
                //query to check whether username is in the table (check whether the user has been signed up) 
                $query = "SELECT * FROM user WHERE ID='$user'"; 
				echo $query;
                //execute query to the database and retrieve the result 
                $result = $mysqli->query($query);
				
				
				
                //convert the result to array 
                $row = $result->fetch_assoc();

                //if the username and password from table/database is not same as the username and password data,promote user whether they have login successfuly
                if($row['ID']!=$user || $row['Password']!=$md5_password) {
                    $_SESSION['state']="logout";  
    
                    echo "<script>$('#p').append('<h1>WRONG ID OR PASSWORD!</h1>')</script>";
                }
    
                else {
                    $_SESSION['state']="login";
                    $_SESSION['id']=$row['ID'];
                    $_SESSION['user_name']=$row['Fullname'];
                    $_SESSION['email']=$row['Email'];
                    $_SESSION['mobile']=$row['Mobile'];
                    $_SESSION['card']=$row['Credit_Card'];
                    $_SESSION['balance']=$row['Balance']; 
                    $_SESSION['headphoto']=$row['Head_photo_href']; 
                    $_SESSION['type']=$row['Type']; 
                    $_SESSION['campus']=$row['Campus'];
                    $_SESSION['code']=$row['Verification_code'];
                    
                    if ($_SESSION['type']=="CAFE_MANAGER") {
                        $_SESSION['cafe']=$row['Cafe']; 
                    }
                    echo "<script>$('#p').append('<h1>LOG IN!</h1>')</script>";
                }
            }

            else if(isset($_POST['log_out'])) {
                session_destroy();
                session_start();
                $_SESSION['state']="logout";
                
                echo "<script>$('#p').append('<h1>LOG OUT!</h1>')</script>";
            }
        
            //keep this page for 1 seconds
          /*  echo "<script>
                    var time=0;
                    
                    $('#p').append('Backing...<br/>1 <br/>');
                    var index = setInterval(function() {
                       
                        if(time == 0) {
                            $('#p').append('0');
                            clearInterval(index);  
                            window.history.back(-2);
                            }
                    },1000);
                    </script>";*/
        ?>
    </body>
    <?php
        $mysqli->close();
    ?>
</html>