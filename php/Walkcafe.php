
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./img/icon.ico" type="image/x-icon"/> <!--icon-->
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/headline.css">
    
    <script src="../js/jquery-3.3.1.js"></script> 
    <script type="text/javascript" src="../js/headline_for_php.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
    <?php
        include("db_conn.php");
        session_start();
    ?>
    <title>Walk's café</title>
</head>
    
<body>
    
<!--Headers-->  
    <div class="header">
    <div id="headline">
        <ul>
            <li><a class="html" href="../index.html">Home</a></li>
            
            <li><a id="cafe" href="javascript:void(0)">Café</a></li>  

            <li><a  href="./account.php">Account</a></li>
            
            <li><a href="./account_manage.php">Manage Account</a></li>
            
            <?php
                if (isset($_SESSION['type']) && $_SESSION['type'] == "CAFE_MANAGER") {
                    echo "<li><a href='./menu_management.php'>Menu Management</a></li>";
                    echo "<li><a href='./cafe_orders.php'>Café Orders list</a></li>";
                }
                else if (isset($_SESSION['type']) && ($_SESSION['type'] == "CAMPUS_MANAGER" || $_SESSION['type'] == "DIRECTOR_BOARD")) {
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
    
  <!--title-->
    <div id="title">
        <h1>Walk's café menu</h1>    
        
 <!--Bussiness time-->        
        <p1>Bussiness time: 
            <!--Show business time-->
            <?php

                //query to upload the information
                $query="SELECT * FROM business_time WHERE Cafe='Walk'";

                //get data from result    
                $result = $mysqli->query($query);
                $row = $result->fetch_assoc();  

                echo $row['Open_time']."-".$row['Close_time'];
            
            //fetch opening hour time and close time
                if (strlen($row['Open_time']) == 6) {
                    $o_h = $row['Open_time']{0};
                    $o_m = $row['Open_time']{2}.$row['Open_time']{3};
                }
                
                else if (strlen($row['Open_time']) == 7) {
                    $o_h = $row['Open_time']{0}.$row['Open_time']{1};
                    $o_m = $row['Open_time']{3}.$row['Open_time']{4};
                }
            
                 if (strlen($row['Close_time']) == 6) {
                    $c_h = $row['Close_time']{0};
                    $c_m = $row['Close_time']{2}.$row['Close_time']{3};
                }
                
                else if (strlen($row['Close_time']) == 7) {
                    $c_h = $row['Close_time']{0}.$row['Close_time']{1};
                    $c_m = $row['Close_time']{3}.$row['Close_time']{4};
                }
            
            ?>
        </p1>
        
        <br/>
        <br/>
        
        <HR id="header_line"/>
        
    <!--welcome text-->
        <p2>Welcome. Please choose your menu.</p2>
        
    <!--discount information-->
        <p3>Your discount:
            <span>
                <?php
                    //get loging state and discount details
                    if (isset($_SESSION['state']) && $_SESSION['state']=="login") {
                        $query = "SELECT Discount FROM discount_information WHERE Type='$_SESSION[type]'";
                
                        //get data from result    
                        $result = $mysqli->query($query);
                        $row = $result->fetch_assoc();
                        $disc = $row['Discount']*100; //get discount details
                        echo $disc."%";
                        
                        //assign value to js discount variable
                        echo "<script>discount=$disc;</script>";
                    }
                
                    else {
                        echo "0%";
                    }
                    
                ?>
            </span>
        </p3>
    </div>
   
    <!--food menu-->

    <div class="container">

		  <div class="trolley">
			<h2 class="trolley_header">TROLLEY</h2>
              
              <div class="trolley_product">
                  <div id="account_balance">
                      <p>Your Account Balance:<span> $ </span>
                          
                          <!--show user's balance detail-->
                          <span id="show_account_money">
                          <?php
                            //get loging state and discount details
                            if (isset($_SESSION['state']) && $_SESSION['state']=="login") {
                                $query = "SELECT Balance FROM user WHERE ID='$_SESSION[id]'";
                
                                  //get data from result    
                                  $result = $mysqli->query($query);
                                  $row = $result->fetch_assoc();
                                  $balan = $row['Balance']; //get balance details
                                  echo $balan;
                                //assign value to js ballance variable
                                echo "<script>balance=$balan;</script>";
                              }

                            else {
                                echo "0.00";
                            } 
                          ?>
                          </span>
                      </p>
                  </div>
                  
                  <!--Total cost-->
                  <div id="trolley_cost">
                      <p>Total Cost:<span> $ </span><span id="cost_digital">0.00</span></p>
                  </div>
                  
                  <!--Total cost after discount-->
                  <div id="discount">
                      <p>After Discounts:<span> $ </span><span id="after_discount">0.00</span></p>
                  </div>
                  
                  <!--expect balance after payment-->
                  <div id="expect_balance">
                      <p>Expect Balance:<span> $ </span><span id="show_expect_balance">0.00</span></p>
                  </div>          
                  <HR class="trolley_line"/>
                  
                  <form id="order" class="trolley_iteam" action="./cart.php" method="post" onsubmit="return order_validation();"><fieldset>
                      <input type=hidden name="real_cost" id="real_cost"/>
                      
                      <!--show last un-paid order-->
                      <?php
                        if (isset($_SESSION['state']) && $_SESSION['state'] == "login") {
                            
                            $query = "SELECT * FROM walk_cafe_temp_cart_list WHERE Cart_id='$_SESSION[id]'";
    
                            $result=$mysqli->query($query);
  
                            if ($result->num_rows > 0) {
                                while($row=$result->fetch_assoc()) {
                                    
                                    $sql="SELECT * FROM iteam WHERE Iteam_id='".$row['Iteam_id']."'";
                                    
                                    $result2=$mysqli->query($sql);
                                    $row2=$result2->fetch_assoc();
                                   
                                    echo "<div class='cart_iteam' id='".$row['Iteam_id']."'><p>".$row['Iteam_id']."</p><div class='cart_iteam_price'>".$row2['Price']."<span> ×</span></div><input type='hidden' name='iteam_name[]' value='".$row['Iteam_id']."'><input type='hidden' name='iteam_price[]' value=".$row2['Price']."><input type='number' value=1 min='1' max='999' name='cart_iteam_amount' class='cart_iteam_amount'><div class='cart_iteam_require'><input type='text' name='iteam_require' class='input_iteam_require' placeholder='Extra  Specifics'/></div><div class='cart_iteam_remove'><a href='javascript:void(0)' class='cart_iteam_remove_button'>×</a></div><HR class='trolley_line'/></div>";
                                    
                                    echo "<script>$(\"[id='".$row['Iteam_id']."']\").find('.input_iteam_require').val('".$row['Description']."');
                                                    $(\"[id='".$row['Iteam_id']."']\").find('.cart_iteam_amount').attr('value',".$row['Amount'].");
                                    </script>";
                                }
                            } 
                        }
  
                      ?>
                      
                    </fieldset>
              
              <!--payment button and clean button-->
                    <div id=trolley_operation>
                        <p > order collection time:<select name="collection_time" form="order">
                            <?php
                            
                            //am selections
                                $im = (int)$o_m+(int)30; 
                                $ih = (int)$o_h;
                                $switch = false;
                            
                                settype($im,'integer');
                                settype($ih,'integer');
                            
                                do {
                                    if ($im == 60) {
                                        $ih++;
                                        $im = 0;
                                    }
                                    
                                    if ($im == 0) {
                                        echo "<option value='$ih:00'>$ih:00</option>";
                                    }

                                    else {
                                        echo "<option value='$ih:$im'>$ih:$im"."</option>";
                                    }

                                    $im+=15;

                                    if ($ih == 12) { 
                                        $switch = true;
                                        echo "<option value='$ih:00'>$ih:00"."</option>";
                                    }
                                }while ($switch == false);
                                   
                              //pm selections
                                $i = (int)$c_m; 
                                $i2 = (int)$c_h-1 + 12;
                            
                                $ih = 12;
                                $im = 00;
                            
                                settype($i,'integer');
                                settype($i2,'integer');
                                settype($im,'integer');
                                $switch = false;
                                $switch2 = false;     
                            
                                 do {
                                        if ($im == 0) {
                                            echo "<option value='$ih:00'>$ih:00</option>";
                                        }

                                        else {
                                            echo "<option value='$ih:$im"."'>$ih:$im"."</option>";
                                        }

                                        $im+=15;

                                        if ($im == 60) {
                                            $ih++;
                                            $im = 0;
                                        }

                                        if ($ih == $i2 && $im == $i ) { 
                                            $switch = true;
                                            if ($im == 0) {
                                            echo "<option value='$ih:00'>$ih:00</option>";
                                            }
                                            else {
                                            echo "<option value='$ih:$im"."'>$ih:$im"."</option>";
                                            }
                                        }
                                    }while ($switch == false);
                            
                                
                            
                            ?></select></p>
                        <br/>
                        <input type="button" id= "clean_cart" value="CLEAN CART"/><input type="submit" id="trolley_submit" name="trolley_submit"  value="PAYMENT"/>
                    </div>
            </form>
		  </div>
        </div>
        
    <!--menu option(beverage and master food)-->
        <div class="menu_option">
            <div id="option_masterfood"><a  href="javascript:void(0)">Master list Food</a></div>
            <div id="sign"><span>&</span></div>
            <div id="option_beverage"><a  href="javascript:void(0)">Beverage</a></div>
        </div>
        
        <br/>
    
    <!--Master food menu-->    
		<div class="masterfood">
		  <div class="row">
			<?php
              //GET ITEAMS
                $sql = "SELECT * FROM walk_cafe_iteam WHERE Type='MASTER_FOOD'";
                $res = $mysqli->query($sql);
              
                    if ($res->num_rows > 0) {
                        while ($it = $res->fetch_assoc()) {  
                            
                            //get details of this iteam
                            $query = "SELECT * FROM iteam WHERE Iteam_id='$it[Iteam_id]'";

                            $result = $mysqli->query($query);
                            $row = $result->fetch_assoc();
 
                                echo "<div class='product'><div class='image'><img src='".$row['Href']."' alt=''></div><div class='inner'><center><div class='decoration'><div class='product_add_button'><a href='javascript:void(0)' class='add_href'>Add</a></div></div></center><p class='description'>".$row['Description']."</p><div class='product_introduction'><h2 class='product-title'>".$row['Iteam_id']."</h2><p class='product_price'>$ ".$row['Price']."</p></div></div></div>";
                        }
                }
                else {
                    echo "NO DATA";
                            }
              ?>
              
		</div>
	  </div>
        
    <!--Beverage menu-->          
        <div class="beverage">
		  <div class="row">
			
			 <?php
              //GET ITEAMS
                $sql = "SELECT * FROM walk_cafe_iteam WHERE Type='BEVERAGE'";
                $res = $mysqli->query($sql);
              
                    if ($res->num_rows > 0) {
                        while ($it = $res->fetch_assoc()) {  
                            
                            //get details of this iteam
                            $query = "SELECT * FROM iteam WHERE Iteam_id='$it[Iteam_id]'";

                            $result = $mysqli->query($query);
                            $row = $result->fetch_assoc();
 
                                echo "<div class='product'><div class='image'><img src='".$row['Href']."' alt=''></div><div class='inner'><center><div class='decoration'><div class='product_add_button'><a href='javascript:void(0)' class='add_href'>Add</a></div></div></center><p class='description'>".$row['Description']."</p><div class='product_introduction'><h2 class='product-title'>".$row['Iteam_id']."</h2><p class='product_price'>$ ".$row['Price']."</p></div></div></div>";
                        }
                }
                else {
                    echo "NO DATA";
                            }
              ?>
 
          </div>   
        </div>  

	</div>   
  <script> 
        //set cafe name
       cafe_name="walk";
    </script>
       
</body>    
    
</html>