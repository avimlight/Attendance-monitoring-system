<?php

session_start();
session_unset();
session_destroy();

echo "you have been logged out ";
//session_start() session_unset() session_destroy() 

?>
