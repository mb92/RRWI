<?php
/**
 * Debug function
 * d($var);
 */
use yii\helpers\VarDumper;

// function dd($var)
// {
//     \yii\helpers\VarDumper::dump($var);
//     exit();
// }

function d($var,$caller=null)
{
    if(!isset($caller)){
        $caller = array_shift(debug_backtrace(1));
    }
    echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, 10, true);
    echo '</pre>';
}
 
/**
 * Debug function with die() after
 * dd($var);
 */
function dd($var)
{
    $caller = array_shift(debug_backtrace(1));
    d($var,$caller);
    die();
}


function verifyToken($sendToken) {
    $ourToken = "0b3d4f561329b5a5dfdbaff634280be9";

    if ($ourToken == $sendToken) return true;
    else return false;
}

function mysqltime() {
   return date("Y-m-d H:i:s");
}