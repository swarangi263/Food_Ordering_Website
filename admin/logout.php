<?php

include('../config/constants.php'); 

    //1.destroy session
    session_destroy(); //unset session user

    // 2.redirect to login
    header('location:'.HOME_URL.'admin/login.php');

?>