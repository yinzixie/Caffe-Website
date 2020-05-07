<?php
    include ("./db_conn.php");
    session_start();

    //set a temporary cart id
        if (!isset($_SESSION['temp_cart'])) {
            $_SESSION['temp_cart'] = $_SESSION['id'];

            $sql="INSERT $_SESSION[temp_head_cart_list] (ID, Cart_id) VALUES ('$_SESSION[id]','$_SESSION[temp_cart]')";

            if ($mysqli->query($sql) == false) {
                echo "ERROR:FALIED TO UPLOAD DATA";
            }
        }

//find corresponding cafe database
    if ($_POST['cafe'] == "ref") {
        $_SESSION["temp_head_cart_list"] = "ref_cafe_temp_head_cart_list";
        $_SESSION["temp_cart_list"] = "ref_cafe_temp_cart_list";
        
        $_SESSION["head_cart_list"] = "ref_cafe_head_cart_list";
        $_SESSION["cart_list"] = "ref_cafe_cart_list";
    }
    else if ($_POST['cafe']=="lazenbys") {
        $_SESSION["temp_head_cart_list"] = "lazenbys_cafe_temp_head_cart_list";
        $_SESSION["temp_cart_list"] = "lazenbys_cafe_temp_cart_list";
        
        $_SESSION["head_cart_list"] = "lazenbys_cafe_head_cart_list";
        $_SESSION["cart_list"] = "lazenbys_cafe_cart_list";
            }
    else if ($_POST['cafe']=="walk") {
        $_SESSION["temp_head_cart_list"] = "walk_cafe_temp_head_cart_list";
        $_SESSION["temp_cart_list"] = "walk_cafe_temp_cart_list";
        
        $_SESSION["head_cart_list"] = "walk_cafe_head_cart_list";
        $_SESSION["cart_list"] = "walk_cafe_cart_list";
            }
    else if ($_POST['cafe']=="grove") {
        $_SESSION["temp_head_cart_list"] = "grove_cafe_temp_head_cart_list";
        $_SESSION["temp_cart_list"] = "grove_cafe_temp_cart_list";
        
        $_SESSION["head_cart_list"] = "grove_cafe_head_cart_list";
        $_SESSION["cart_list"] = "grove_cafe_cart_list";
            }
    else if ($_POST['cafe']=="trade_table") {
        $_SESSION["temp_head_cart_list"] = "trade_table_cafe_temp_head_cart_list";
        $_SESSION["temp_cart_list"] = "trade_table_cafe_temp_cart_list";
        
        $_SESSION["head_cart_list"] = "trade_table_cafe_head_cart_list";
        $_SESSION["cart_list"] = "trade_table_cafe_cart_list";
            }
    


    if ($_POST['kind'] == "add") {
    

//check database 
    $query = "SELECT * FROM $_SESSION[temp_cart_list] WHERE Cart_id='$_SESSION[temp_cart]' AND Iteam_id='$_POST[p_id]'";
    
    $result=$mysqli->query($query);

//insert 
    if ($result->num_rows == 0) {
        
        $description = $mysqli->real_escape_string($_POST['p_description']);
        
       $sql="INSERT $_SESSION[temp_cart_list] (Cart_id, Iteam_id, Amount, Description) VALUES ('$_SESSION[temp_cart]', '$_POST[p_id]', '$_POST[p_amount]', '$description')";
        
        if ($mysqli->query($sql) == false) {
            echo "ERROR:FALIED TO UPLOAD DATA";
        }
    }
}  

        //UPDATE 
    if($_POST['kind'] == "input") {
        $description = $mysqli->real_escape_string($_POST['p_description']);
        
        $sql="UPDATE $_SESSION[temp_cart_list] SET Amount='$_POST[p_amount]',Description='$description' WHERE Iteam_id='$_POST[p_id]' AND Cart_id='$_SESSION[temp_cart]'";
           
        if ($mysqli->query($sql) == false) {
            echo "ERROR:FALIED TO UPLOAD DATA";
        } 
    }
        
    
    
    //remove all data
    if ($_POST['kind'] == "clean") {
        $sql="DELETE FROM $_SESSION[temp_cart_list] WHERE Cart_id='$_SESSION[temp_cart]'";

        if ($mysqli->query($sql) == false) {
                echo "ERROR:FALIED TO UPLOAD DATA";
            } 
        else {
           unset($_SESSION['temp_cart']);
        }
                
    }

//remove a product
    if ($_POST['kind'] == "remove") {
       
        $sql="DELETE FROM ".$_SESSION['temp_cart_list']." WHERE Cart_id='".$_SESSION['temp_cart']."' AND Iteam_id='$_POST[p_id]'";

                if ($mysqli->query($sql) == false) {
                    echo "ERROR:FALIED TO UPLOAD DATA";
                } 
    }   
    $mysqli->close();
?>
