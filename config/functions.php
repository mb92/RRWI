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


function watermark($watermarkPath, $outImgPath) {
    $stamp = imagecreatefrompng($watermarkPath);
    $im = imagecreatefromjpeg($outImgPath);

    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = 0;
    $marge_bottom = getimagesize($outImgPath)[1]-getimagesize($watermarkPath)[1];
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopy($im, $stamp, 0, 0, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, imagesx($stamp), imagesy($stamp));

    imagepng($im, $outImgPath);
    imagedestroy($im);

    if (!file_exists($outImgPath)) 
    return true;
    else return false;
}
/**
 * This function add watermark to photos before send a email.
 * The function loads the source image (from "upload" directory) and watermark image ("web/dist/img") 
 * Next, save new image in "temp" directory. After sending the email the image is deleted from "temp" dir.
 * @param string $filename - name of file with extension
 */
function addWatermark($filename) {
    // Load the stamp and the photo to apply the watermark to
    $watermarkNameSm = '../web/dist/img/wt-2.png';
    $watermarkNameBg= '../web/dist/img/wt-1.png';
    $photo = Yii::getAlias("@upload").'/'.$filename;
    $thumb = Yii::getAlias("@temp").'/'.$filename;

    $stThumb = watermark($watermarkNameSm, $thumb);
    $stPhoto = watermark($watermarkNameBg, $photo);

    if (($stThumb = true) && ($stPhoto == true))
        return true;
    else return false;
}


/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 * PHP 5.4.9 ( check your PHP version for function definition changes )
 *
 * this is a beginners template for simple encryption decryption
 * before using this in production environments, please read about encryption
 * use at your own risk
 *
 * @param string $action: can be 'encrypt' or 'decrypt'
 * @param string $string: string to encrypt or decrypt
 *
 * @return string
 */
function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = '654G65N46Y5G4MO65JL46GIP4M6NUY5KJ4BHV6AGCFAS54D6';
    $secret_iv = 'ssg5dr6vthdf651tyk1b6fk1gjg16fdvsd61gcsf15';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


function rename_attachment($img)
{
    // return substr($img, strlen(Yii::getAlias("@upload")), strlen($img));
    return substr($img, 0, 5);
    

    $tmpDir = Yii::getAlias("@temp").'/tmp';
    $sesDir = $tmpDir."/".$sesId;

    $sesId = "n50c23b5e690830e9111ddd2bcd31100";
    $img = $sesId.".jpg";

    if (!file_exists($tmp)) mkdir($tmp);

    mkdir($tmpDir."/".$sesId);
    copy($img, $sesDir);
}