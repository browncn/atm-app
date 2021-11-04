<?php 

session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();
session_destroy();
echo '<script>window.location.href="index.html"</script>';

?>