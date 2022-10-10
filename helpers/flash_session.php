<?php


if (!function_exists('flashMessage')) {
    function flashMessage()
    {
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            return false;
        }
    }
}
