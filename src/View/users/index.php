<?php ob_start(); ?>
<?php
// Your controller logic for login and logout actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have login and logout functions in your controller
    if (isset($_POST['login'])) {
        // Perform login action
        // ...
    } elseif (isset($_POST['logout'])) {
        // Perform logout action
        // ...
    }
}

?>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>