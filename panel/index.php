<?php
session_start();
require_once('../config/db.php');
//require_once('auth.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<div class="container-fluid px-4">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 mt-5">
            <div class="text-center mt-5">
                <h4>W E L C O M E</h4>
                <p>Admin Panel</p>
            </div>
        </div>
    </div>
</div>

<?php include_once('includes/footer.php'); ?>