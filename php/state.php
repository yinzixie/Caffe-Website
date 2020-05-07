<?php
//get logging state
session_start();

if (!isset($_SESSION['state'])) {
    $_SESSION['state']="logout";
}
echo $_SESSION['state'];
?>