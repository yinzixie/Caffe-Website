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
        include('db_conn.php'); //db connection
        
        if(isset($_POST['submit'])) {
            
            //receive data  
            $addr = $_POST["email"];
            $pas = $_POST["password"];
            $md5_password=MD5($pas); //encrypte password
            
            //produce a verfication number and upload to database
            $verfication = date("ymdhms").rand(0,100);
            
            //query to upload the information
            $query = "INSERT INTO user (ID, Password, Fullname, Email, Mobile, Credit_Card, Balance, Head_photo_href, Verification_code)
            VALUES ('$_POST[IDnumber]', '$md5_password', '$_POST[name]', '$_POST[email]', '$_POST[phonenumber]', '$_POST[creditcard]', '0','../img/headphoto.jpg', '$verfication')"; 
            
            if ($mysqli->query($query)==false){
                echo"Failed to upload account information:".$mysqli->error;
            }
            
            else {
                echo "Succeed!";     
            }     
        }
       
            $mysqli->close();
        
            //keep this page for 2 seconds
            echo "<script>
                    var time=0;
                    
                    $('#p').append('Backing...<br/>1 <br/>');
                    var index = setInterval(function() {
                       
                        if(time == 0) {
                            $('#p').append('0');
                            clearInterval(index);  
                            window.history.back(-2);
                            }
                    },1000);
                    </script>";
        ?>

    </body>
</html>