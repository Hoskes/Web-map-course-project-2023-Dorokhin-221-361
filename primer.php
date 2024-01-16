<?php 
include 'header.php';
if(!isset($_SESSION['auth'])||$_SESSION['auth']==''){
    include 'auth-page.php';
    
}
else{

}


include 'footer.php';
?>