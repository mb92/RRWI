<?php
/**
 * Debug function
 * d($var);
 */
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;
use app\models\Actions;
use app\models\Countries;
use yii\imagine\Image;


function verifyToken($sendToken) {
    // $ourToken = "0b3d4f561329b5a5dfdbaff634280be9";
    $ourToken = "f7289db929eaec50a588fe348e2edacf";
    
    if ($ourToken == $sendToken) return true;
    else return false;
}

/**
 * Return current date and time in a mysql friendly format Y-m-d H:i:s
 * @return string current date and time Y-m-d H:i:s
 */
function mysqltime() {
   // return date("Y-m-d H:i:s");
   // 
   return date("Y-m-d H:i:s", strtotime('1 hour'));
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

function slug($string) {

    $string = strtolower($string);
    $string = str_replace(" ", "_", $string);
    $string = str_replace(":", "-", $string);
    $string = str_replace(";", "]", $string);
    $string = str_replace("ö", "O", $string);
    
    return $string;
}


function watermark3($watermarkPath, $outImgPath) {

    $stamp = imagecreatefrompng($watermarkPath);
    $im = imagecreatefromjpeg($outImgPath);

    list($width, $height) = getimagesize($outImgPath);
    list($widthWt, $heightWt) = getimagesize($watermarkPath);

    $marge_right = ($width-$widthWt);
    $marge_bottom = 90;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    // Copy the stamp image onto our photo using the margin offsets and the photo 
    // width to calculate positioning of the stamp. 
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    imagepng($im, $outImgPath);
    imagedestroy($im);
    
    if (!file_exists($outImgPath)) 
    return true;
    else return false;
}


function watermark2($watermarkPath, $outImgPath) {

    $stamp = imagecreatefrompng($watermarkPath);
    $im = imagecreatefromjpeg($outImgPath);

    list($width, $height) = getimagesize($outImgPath);
    list($widthWt, $heightWt) = getimagesize($watermarkPath);

    $marge_right = ($width-$widthWt)-50;
    
    $marge_bottom = 90;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    // Copy the stamp image onto our photo using the margin offsets and the photo 
    // width to calculate positioning of the stamp. 
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    imagepng($im, $outImgPath);
    imagedestroy($im);
    
    if (!file_exists($outImgPath)) 
    return true;
    else return false;
}


function watermarkThumb1($watermarkPath, $outImgPath) {
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
    
    $im = NULL;
    unset($im);
    
    if (!file_exists($outImgPath)) 
    return true;
    else return false;
}


function watermarkThumb2($watermarkPath, $outImgPath) {
    $stamp = imagecreatefrompng($watermarkPath);
    $im = imagecreatefromjpeg($outImgPath);

    list($width, $height) = getimagesize($outImgPath);
    list($widthWt, $heightWt) = getimagesize($watermarkPath);

    $marge_right = ($width-$widthWt);
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    // Copy the stamp image onto our photo using the margin offsets and the photo 
    // width to calculate positioning of the stamp. 
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    imagepng($im, $outImgPath);
    imagedestroy($im);
    
    $im = NULL;
    unset($im);
    
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
function addWatermark($filename, $country=null) {
    // Load the stamp and the photo to apply the watermark to
    // $watermarkNameSm = '../web/dist/img/wt-2.png';
    // $watermarkNameBg= '../web/dist/img/wt-1.png';
    // 
//    $watermarkNameSm = Yii::getAlias("@app").'/web/dist/img/wt-2.png';
    // $watermarkNameBg= Yii::getAlias("@app").'/web/dist/img/wt-3-1.png';
    
    if ($country == 'CW') {
        $watermarkNameSm = Yii::getAlias("@app").'/web/dist/img/wt-4-1cw.png';
        $watermarkNameBg= Yii::getAlias("@app").'/web/dist/img/wt-4cw.png';
    } else {
        $watermarkNameSm = Yii::getAlias("@app").'/web/dist/img/wt-4-1.png';
        $watermarkNameBg= Yii::getAlias("@app").'/web/dist/img/wt-4.png';
    }

    
    $photo = Yii::getAlias("@app").'/upload/'.$filename;
    $thumb = Yii::getAlias("@app").'/temp/'.$filename;

//    $stThumb = watermarkThumb1($watermarkNameSm, $thumb);
    $stThumb = watermarkThumb2($watermarkNameSm, $thumb);
    $stPhoto = watermark3($watermarkNameBg, $photo);
    
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


function rename_email_attachment($imgPath)
{
    $sesId = substr($imgPath, strlen(Yii::getAlias("@upload"))+1, 32);
    $img = $sesId.".jpg";
    $newImgName = "P10.jpg";

    $tmpDir = Yii::getAlias("@temp").'/tmp';
    $sesDir = $tmpDir."/".$sesId;
    
    if (file_exists($sesDir)) return $sesDir."/".$newImgName;

    if (!file_exists($tmpDir)) mkdir($tmpDir);
    if (!file_exists($sesDir)) mkdir($sesDir);


    $cp = copy($imgPath, $sesDir."/".$newImgName);
    
    if ($cp) return $sesDir."/".$newImgName;
    else return false;
}


function remove_dir_attachment($attachPath, $cron=null) {
    $path = str_replace("/P10.jpg", "", $attachPath);
    
    if ($cron) $path = "../".$path;
    
    if (is_null(FileHelper::removeDirectory($path))) return true;
    else return false;
}


function regPhoto($sesId) {
    $uploadDir = Yii::getAlias("@app").'/upload/';
    $tempDir = Yii::getAlias("@app").'/temp/';
//    vdd(Actions::find()->where(['path' => 'n50c23b5e690830e9111ddd2bcd39z15'])->one()->base64);
    $imageB64 = Actions::find()->where(['path' => $sesId])->one()->base64;
    
    // $filename = $sesId.'.jpg';
    $filename = $sesId;
    $ext = "jpg";
    $fileNameExt = $filename.'.'.$ext;
    
    // Decode Image
    $binary=base64_decode($imageB64);
    // header('Content-Type: bitmap; charset=utf-8');
    // Images will be saved under 'www/upload/' folder
    $file = fopen($uploadDir.'/'.$fileNameExt, 'wb');

    // Create File
    fwrite($file, $binary);
    fclose($file);
    $binary=NULL;
    unset($binary);
    
    $thumb = Image::thumbnail($uploadDir.'/'.$fileNameExt, 171, 300)->save($tempDir.'/'.$fileNameExt, ['quality' => 90]);
    addWatermark($fileNameExt);
    
    $thumb = NULL;
    unset($thumb);
    if(file_exists($uploadDir.'/'.$fileNameExt) && file_exists($tempDir.'/'.$fileNameExt)) {
        return true;
    } else {return false; }
}


function saveLog($countryId, $status, $sesId, $message="*") {
    $path = Yii::getAlias("@app").'/raports/ses_log/';
    $countryShort = Countries::find()->where(['id' => $countryId])->one()['short'];
    $logNameExt = $countryShort.'_'.date('Y-M-d').'.log';
    if (strtolower($status) == "INTERRUPTED") $eol = PHP_EOL.PHP_EOL;
    else $eol = PHP_EOL;

    $txt = $eol.'[ '.date("H:i:s").' ] status:'.strtoupper($status).'; sesId:'.$sesId.'; message:'.$message.';';
//    echo $logNameExt;

    // if (!fileExists($lognameExt)) 
    $logFile = fopen($path.$logNameExt, "a+") or die("Unable to open file!");

    rewind($logFile);
    fwrite($logFile, $txt);
    fclose($logFile);
}

function saveLogResend($msg) {
    $path = Yii::getAlias("@app").'/raports/resend_mail/';
    $logNameExt = date('Y-M-d').'.log';
    $eol = PHP_EOL;

    $txt = '[ '.date("H:i:s").' ] '.$msg.$eol;
//    echo $logNameExt;

    // if (!fileExists($lognameExt)) 
    $logFile = fopen($path.$logNameExt, "a+") or die("Unable to open file!");

    rewind($logFile);
    fwrite($logFile, $txt);
    fclose($logFile);
}