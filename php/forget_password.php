<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />

    <link rel="icon" href="../img/icon.ico" type="image/x-icon"/> 
    <link rel="stylesheet" type="text/css" href="../css/forgetpassword.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    
    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    <script type="text/javascript" src="../js/forgetpassword.js"></script>
    
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
    
    <div id='container'>
        <div>
            <h1>Forget password?</h1>
        </div>
        
        <?php
            include("db_conn.php");
            session_start();
        
            $id_area="<div class='step' id='id'>
                        <h1>1</h1>
                                    <h1>Please input your ID</h1>
                         <form method='get' onsubmit='return validation_id();'>
                            <p><input type='text' name='id' id='user_id' placeholder='id'/></p>
                             <input type='submit' class='submit' name='submit_id' value='Next Step'></form>
                            <form method='get'><input type='submit' class=\"button\" name=\"page\" value='Back to main page'>
                        </form>
                    </div>";
            $email_area="<div class='step' id='email''>
                        <h1>2</h1>
                        <h1>Please input your account email</h1>
                         <form method='get'  onsubmit='return validation_email();'>
                            <p><input type='text' id='user_email' name='email' placeholder='email'/></p>
                             <input type='submit' class='submit' name='submit_email' value='Next Step'></form>
                            <form  method='get'><input type='submit' name=\"back2\" class=\"button\" value='Back'>
                        </form>
                    </div>";
            $code_area="<div class='step' id='code''>
            
                            <h1>3</h1>

                            <h1>A mail has send to your email<br/>
                                Please input your verification code</h1>
                             <form method='get'  onsubmit='return validation_code();'>
                                <p><input type='text' name='code' id='user_code' placeholder='verification code'/></p>
                                <input type='submit' class='submit' name='submit_code' value='Next Step'></form>
                                <form method='get'><input type='submit' name='back3' class='button' value='Back'></form>
                            
                        </div>";
        
            $password_area="<div class='step' id='change' >
                            <h1>4</h1>
                            <h1>Please input your new password</h1>
                             <form method='get' onsubmit='return validation_password();'> 
                                <p><input type='password' id='user_password' name='password' placeholder='password'/></p>
                                <p><input type='password' id='user_confirm_password' placeholder='retype password'/></p>
                                <input type='submit' class='submit' name='submit_password' value='Next Step'></form>
                                <form method='get'><input type='submit' name='back4' class='button' value='Back'></p>
                            </form>
                        </div>";
        
        //nack to main page
            if(isset($_GET["page"])) {
                header("location:../index.html");
            }
        //show email area
            else if (isset($_GET["submit_id"])) {

                //confirm whether the id is exist in database
                $sql="SELECT * FROM user WHERE ID='$_GET[id]'";
        
                $result=$mysqli->query($sql);
                
                if ($result->num_rows > 0) {
                    $_SESSION['forget_id'] = $_GET['id'];
                
                echo $email_area;
                        }  
                else {
                    echo "<div class='step'><h1>Invalid ID!<h1></div>";
                    echo $id_area;
                }
            }
            
            //back to id area
            else if(isset($_GET["back2"])) {
                echo $id_area;
            }
        
            //show verification code area
            else if (isset($_GET["submit_email"])) {
                //confirm whether the emial is right
                $sql="SELECT * FROM user WHERE ID='$_SESSION[forget_id]'";

                $result=$mysqli->query($sql);
                
                $row = $result->fetch_assoc();

               if ($_GET["email"] == $row['Email']){
                   
                   //genarate a verification, email it, and store in the database code
                   $verfication = date("ymdhms").rand(0,100);
                   
                   $sql="UPDATE user SET Verification_code='$verfication' WHERE ID='$_SESSION[forget_id]'";

                    $_SESSION['forget_code'] = $verfication;
                   if ($result=$mysqli->query($sql)) {
                      echo "    <h1><br/>
                                (I can't send email through school's server<br/>
                                so i will just print it out : $verfication)</h1>";
                       
                        echo $code_area;
                   }
                   else {
                       echo "<div class='step'><h1>Failed!<h1></div>";
                       echo $email_area;
                   }
                }
                else {
                    echo "<div class='step'><h1>Invalid Email!<h1></div>";
                    echo $email_area;
                }
            }
        
            //back to email area
            else if(isset($_GET["back3"])) {
                echo $email_area;;
            }
        
            //show change password area
            else if (isset($_GET["submit_code"])) {
                //confirm whether the code is right
                $sql="SELECT * FROM user WHERE ID='$_SESSION[forget_id]'";

                $result=$mysqli->query($sql);
                
                $row = $result->fetch_assoc();
                
                if ($_GET["code"] == $row['Verification_code']) {
                    echo $password_area;
                }
                else {
                    echo "    <h1><br/>
                                (I can't send email through school's server<br/>
                                so i will just print it out : $_SESSION[forget_code])</h1>";
                    echo "<div class='step'><h1>Invalid Code!<h1></div>";
                    echo $code_area;
                }
            }
            
            //update password
            else if (isset($_GET["submit_password"])) {
               //updata
                $md5_password=md5($_GET['password']);
                $sql="UPDATE user SET Password='$md5_password' WHERE ID='$_SESSION[forget_id]'";

                if ($mysqli->query($sql) != false) {
                    echo "<div class='step' id='finish'>
                            <h1>5</h1>
                            <h1>Password Changed Succeed!</h1>
                            <br/>
                            <form method='get'>
                             <p><input type='submit' class='button' id='back_main_page' name=\"page\" value='Back to main page'></p>
                        </form>
                        </div>";
                }
                else {
                    echo "<div class='step'><h1>Failed Changing Password!<h1></div>";
                    echo $password_area;
                }
            }
            //back to verification code area
            else if(isset($_GET["back4"])) {
                echo $code_area;;
            }
       
        //show id area
            else {
                echo $id_area;
            }
        
        ?>
    
    </div>
    
    <?php
        $mysqli->close();
    ?>
    
    </body>
</html>