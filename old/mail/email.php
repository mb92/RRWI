<?php  
use yii\helpers\Url;

$path = 'http://'.$_SERVER['HTTP_HOST'].'/dist/email/';

?>
<img src="http://www.google-analytics.com/collect?v=1&tid=<?= $tid ?>&cid=<?= $cid ?>&t=event&ec=email&ea=open&el=open_email&cs=newsletter&cm=email&cn=selfie-app" style="border-color:#525252;" border="0" width="0" height="0"/>



<?php 
//Read specifics content for select country
switch ($country) {
    case 'CPW':
        include "cpw.php";
    break;

    default:
        include "cpw.php";
    break;
}

?>