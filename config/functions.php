<?php
/**
 * Debug function
 * d($var);
 */
use yii\helpers\VarDumper;

function verifyToken($sendToken) {
    $ourToken = "0b3d4f561329b5a5dfdbaff634280be9";

    if ($ourToken == $sendToken) return true;
    else return false;
}

/**
 * Return current date and time in a mysql friendly format Y-m-d H:i:s
 * @return string current date and time Y-m-d H:i:s
 */
function mysqltime() {
   return date("Y-m-d H:i:s");
}

/**
 * acronym from VarDumpDie() it's combination of two basic function "var_dump()" and "die()"
 * @param  any $var - any element
 * @return die      - app is aborted
 */ 
function vdd($var) {
    var_dump($var);
    die();
}


/**
 * This function add watermark to photos before send a email.
 * The function loads the source image (from "upload" directory) and watermark image ("web/dist/img") 
 * Next, save new image in "temp" directory. After sending the email the image is deleted from "temp" dir.
 * @param string $filename - name of file with extension
 */
function addWatermark($filename="lorem.jpg") {
    // Load the stamp and the photo to apply the watermark to
    $stamp = imagecreatefrompng('../web/dist/img/wt.png');
    $im = imagecreatefromjpeg('../upload/'.$filename);

    // vdd($im);

    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = 20;
    $marge_bottom = 20;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    // Copy the stamp image onto our photo using the margin offsets and the photo 
    // width to calculate positioning of the stamp. 
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    // Output and free memory
    // header('Content-type: image/png');
    $savePath = '../temp/'.$filename;
    imagepng($im, $savePath);
    imagedestroy($im);

    if (!file_exists($savePath)) 
    return true;
    else return false;
}