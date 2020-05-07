<?php
    session_start();
    if (isset($_GET['operation_state'])) {
        $_SESSION["show_operation"] = $_GET['operation_state'];
    }
        echo $_SESSION["show_operation"];
    
?>