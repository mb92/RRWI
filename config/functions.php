<?php
/**
 * Debug function
 * d($var);
 */
use yii\helpers\VarDumper;
use yii\helpers\FileHelper;


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