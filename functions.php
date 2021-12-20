<?php
session_start();
define('USER_LEVEL_ADMIN','1');
function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }


    return $str;
}
function isAdmin(){
    if (isset($_session['user_level']) && $_SESSION['user_level'] &&
        USER_LEVEL_ADMIN == $_SESSION['user_level']['user_level']){
         return true;   
        } else{
            return false;
        }
    }
