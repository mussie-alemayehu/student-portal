<?php
// this file will be used to logout a user when the logout button is clicked
// it only destroys the session variables we have set when logging in
session_start();
session_unset();
session_destroy();
?>