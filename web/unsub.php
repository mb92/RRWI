
<?php 
$path = 'http://'.$_SERVER['HTTP_HOST'].'/dist/email/';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Selfie Studio</title>

  <style type="text/css">
  @media screen { 
    @font-face {
     font-family: Arial;
    }

    @font-face {
      font-family:Myriad;
      src: url(_fonts/Myriad_Pro_Regular.ttf); 
    }

    @font-face {
      font-family: MyriadSemiBold;
      src: url(_fonts/Myriad_Pro_Semibold.ttf);  
    }

    @font-face {
      font-family: MyriadBold;
      src: url(_fonts/Myriad_Pro_Bold.ttf);
    }

    @font-face {
      font-family: MyriadLight;
      src: url(_fonts/Myriad_Pro_Light.otf);
    }
  }

  /* CLIENT-SPECIFIC STYLES */
  body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-size:14px; font-family:MyriadLight, Arial, Helvetica; overflow-x: hidden;}
  table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
  img { -ms-interpolation-mode: bicubic; }

  /* RESET STYLES */
  img { border: 0; line-height: 100%; outline: none; text-decoration: none; }
  table { border-collapse: collapse !important; }
  body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

  /* iOS BLUE LINKS */
  a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
  }

  /* MEDIA QUERIES */
  @media only screen and (max-width: 639px){
    .wrapper{ width:300px!important; padding: 0 !important; }
    /*.wrapper-image{ width:300px; }*/
    .container{ width:300px!important; padding: 0 !important; }
    .mobile{ width:300px!important; display:block!important; padding: 0 !important; }
    .mobile50{ width:150px!important; padding: 0 !important; }
    .center{ margin:0 auto !important; text-align:center !important; }
    .img{ width:100% !important; height:auto; }
    *[class="mobileOff"] { width: 0px !important; display: none !important; visibility:hidden !important;}
    *[class*="mobileOn"] { display: block !important; max-height:none !important; visibility: visible !important;}
  }

  @media only screen and (min-width: 639px){
    .mobileOnTab {display:none !important; visibility: visible !important;}
  }

  @media only screen and (max-width: 639px){
    .mobileOffTab {display:none !important; visibility: hidden !important;}
    .mobileOnTab {display:block !important; visibility: visible !important;}
    .mobile-head1 {font-size:16px !important;}
    .mobile-head2 {font-size:25px !important; line-height:20px;}
    .mobile-font {font-size:16px !important;}
    .mobile-p {font-size:12px !important;}
  }

  @media only screen and (max-width: 321px){
    .wrapper{ width:300px !important; padding: 0 !important; }
    .container{ width:300px!important; padding: 0 !important; }
    .mobile{ width:300px!important; display:block!important; padding: 0 !important;}
    .mobile50{ width:150px!important; padding: 0 !important; }
    .center{ margin:0 auto !important; text-align:center !important; }
    .img{ width:300px !important; height:auto !important; }
    *[class="mobileOff"] { width: 0px !important; display: none !important; visibility:hidden !important;}
    *[class*="mobileOn"] { display: block !important; max-height:none !important; visibility:visible !important;}
  }

  </style>
</head>

<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" style="margin:0; padding:0; background-color:#525252;">
  <center>
    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#525252">
      <tr>
        <td align="center" valign="top">
          <!-- Start Wrapper -->
          <table width="600" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
            <tr>
              <td align="center" >
                
              <!-- Start Container -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td bgcolor="#525252" height="30px">

                    </td>
                  </tr>
                  <tr>
                    <td width="600" class="mobile" style="font-family:MyriadLight, Arial, Helvetica; font-size:12px; line-height:18px;">
                      <img src="<?= $path ?>imgs/red_bar.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
                    </td>
                  </tr>


                    <!-- Header1 - Big text -->
                  <tr height="auto" bgcolor="#f2f2f2">
                    <td class="mobile" style="overflow:hidden; background-color:#1b1919; color:#424344;">
                      <center>
                        <img src="<?= $path ?>imgs/clean.png" width="1" height="20" style="display:block; margin:0; padding:0; border:none;"/>
    						<p style="font-size:26px;">You have unsubscribed from our mailing list.</p>
							<p style="font-size:16px; margin-top:0;">We're sorry to see you go.<br/>
								We will ensure that all your personal details are deleted
							</p>	<br/>
							<img src="<?= $path ?>imgs/clean.png" width="1" height="20" style="display:block; margin:0; padding:0; border:none;"/>
                      </center>
                    </td>
                  </tr>
                  <!-- end: Big text -->



                </table>
                <!-- End Container -->
              
        </td>
      </tr>
    </table>
  </center>

</body>
</html>

