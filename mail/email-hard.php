<?php  
use yii\helpers\Url;

$path = 'http://'.$_SERVER['HTTP_HOST'].'/dist/email/';

?>

<center>
    <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#525252">
      <tr>
        <td align="center" valign="top">
          <!-- Start Wrapper -->
          <table width="600" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
            <tr>
              <td align="center">
                
              <!-- Start Container -->
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td bgcolor="#f2f2f2" height="30px">

                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                      <tr>
                        <td width="25%"></td>
                        <td style="text-align:center;">
                              <a href="#" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:11px; letter-spacing:1px;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:11px; letter-spacing:1px;">
                              YOUR PERFECT SELFIE IS ATTACHED</font>
                              </a>
                        </td>
                        <td style="text-align:center;" width="25%">
                            <?php if ($unsub != "#") { 
                              echo '
                              <a href="'.$unsub.'" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:9px; letter-spacing:1px;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:9px; letter-spacing:1px;">
                              unsubscribe</font>
                              </a>';
                          } ?>
                        </td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                  <tr>
                    <td width="600" class="mobile" style="font-family:MyriadLight, Arial, Helvetica; font-size:12px; line-height:18px;">
                      <img src="<?= $path ?>/imgs/red_bar.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
                    </td>
                  </tr>
                  <tr>
                    <td width="600" class="mobile" style="font-family:MyriadLight, Arial, Helvetica; font-size:12px; line-height:18px;">
                      <img src="<?= $path ?>/imgs/women-2.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
                    </td>
                  </tr>

                    <!-- Hi -->
                  <tr bgcolor="#f2f2f2">
                    <td style="text-align:center; font-size:16px; font-family:MyriadLight, Arial, Helvetica;" class="mobile">
                      <center>
                      <img src="<?= $path ?>/imgs/clean.png" width="1" height="50" style="display:block; margin:0; padding:0; border:none;"/>
                        Hi <font color="#ed1c24"><?= $name; ?></font>
                      </center>
                    </td>
                  </tr>
                  <!-- end: Hi -->


                    <!-- Header1 - Big text -->
                  <tr height="auto" bgcolor="#f2f2f2">
                    <td class="mobile" style="overflow:hidden; line-height:60px;">
                      <center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="20" style="display:block; margin:0; padding:0; border:none;"/>
                        <font style="font-family:MyriadLight, Arial, Helvetica; font-size:40px; letter-spacing:7px;" class="mobile-head1">YOU'RE LOOKING</font>
                        <font style="font-family:MyriadSemibold, Arial, Helvetica; letter-spacing:10px; font-size:75px;" class="mobile-head2">
                          <b>INCREDIBLE</b>
                        </font>
                      </center>
                    </td>
                  </tr>
                  <!-- end: Big text -->

                    <!-- text 1 -->
                  <tr bgcolor="#f2f2f2">
                    <td class="mobile">

                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                        <td>
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="34" style="display:block; margin:0; padding:0; border:none;"/>
                            <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; font-size:16px; text-align:center; color:#58595b;">
                            Thank you for visiting the P10 Selfie Studio.
                            We’ve attached your selfie to this email. We hope you love it.
                            </p>
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="30" style="display:block; margin:0; padding:0; border:none;"/>
                        </td>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                      </tr>
                      </table>

                    </td>
                  </tr>

                  <tr bgcolor="#f2f2f2" style="height: 74px; vertical-align: text-top;">
                    <td class="mobile"> 
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                        <td>
                          <center>
                            <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#000; letter-spacing:2px;" class="mobile-font">
                            <b>SHARE TO <br/>WIN A HUAWEI P10</b>
                            </font>
                            </center>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                            To enter, all you need to do is share your Selfie Studio shot on <br/>
                            Instagram with <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#HuaweiP10Vodacom</font> and 
                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#Huawei<?= $country; ?></font> before 7th August.

                            <!-- <font style="color:#ee1c24"> $endDate; </font>. -->
                          <br/><br/>
                            We’ll choose a one selfie to win R1000 every Monday for 7 weeks, between 26 June and 7 August. At the end of the competition, one final selfie will be selected to win a Huawei P10. That winner will
                            be announced on 10 August.  
                          </p>
                        </td>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                      </tr>
                      </table>
                      </td>
                    </tr>
                    <!-- end: text 1-->
                    
                    <!-- button share now-->
                    <tr height="110px" bgcolor="#f2f2f2">
                    <td class="mobile" style="font-size:19px; font-family:MyriadLight, Arial, Helvetica; color:#000; letter-spacing:2px; text-align:center;">
<!--                       <center>
                        <a href="#" class="mobileOnTab">
                              <img src="<?= $path ?>/imgs/btn-share-now.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
                        </a>
                      </center> -->

                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="178" class="mobileOffTab"></td>
                          <td width="29" class="mobileOnTab"></td>
                          <td width="243">
                            <a href="https://www.instagram.com/">
                            <img src="<?= $path ?>/imgs/btn-share-now.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
                            </a>
                          </td>
                          <td width="178" class="mobileOffTab"></td>
                          <td width="29" class="mobileOnTab"></td>
                        </tr>
                      </table>
                    </td>
                    </tr>
                    <!-- end: button share now -->

                    <!-- text 2 -->
                    <tr bgcolor="#f2f2f2" style="height: 74px; vertical-align: text-top;">
                      <td class="mobile" style="text-align:center;"> 
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                        <td style="text-align:center">
                        <center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="38" style="display:block; margin:0; padding:0; border:none;"/>
                        <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#000; letter-spacing:2px; text-align:center;" class="mobile-font">
                          <b>MAKE EVERY SHOT A COVER SHOT</b>
                        </font>
                        </center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                              The Huawei P10; co-engineered with Leica. An extraordinary fusion of art, culture and technology. A phone with a soul, designed to help you take photo portraits like a pro, to unleash your inner artist and change the way the world sees you.
                          </p>
                        </td>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                      </tr>
                      </table>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="28px" style="display:block; margin:0; padding:0; border:none;"/>
                      </td>
                    </tr>
                    <!-- end: text 2 -->


                    <!-- moccap -->
                    <tr bgcolor="#f2f2f2">
                      <td class="mobile">
                        <table border="0" cellpadding="0" cellspacing="0">
                          <tr bgcolor="#f2f2f2">
                            <td width="214px" align="right">
                              <img src="<?= $path ?>/imgs/left-up.jpg" width="35" height="42" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="171px" align="center">
                              <img src="<?= $path ?>/imgs/center-up.jpg" width="171" height="42" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="214px" align="left">
                              <img src="<?= $path ?>/imgs/right-up.jpg" width="35" height="42" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                          </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="214px" align="right">
                              <img src="<?= $path ?>/imgs/left-side.jpg" width="35" height="300" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="171px" align="center">
                              <img src="<?= $path ?>/imgs/photo-2.jpg" width="171" height="300" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="214px" align="left">
                              <img src="<?= $path ?>/imgs/right-side.jpg" width="85" height="300" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                          </tr>
                          <tr bgcolor="#f2f2f2">
                            <td width="214px" align="right">
                              <img src="<?= $path ?>/imgs/left-down.jpg" width="35" height="43" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="171px" align="center">
                              <img src="<?= $path ?>/imgs/center-down.jpg" width="171" height="43" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="214px" align="left">
                              <img src="<?= $path ?>/imgs/right-down.jpg" width="85" height="43" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <!-- end: moccap -->



                    <!-- button discover now -->
                    <tr bgcolor="#f2f2f2">
                    <td class="mobile">
                    <img src="<?= $path ?>/imgs/clean.png" width="1" height="48" style="display:block; margin:0; padding:0; border:none;"/>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="178" class="mobileOffTab"></td>
                      <td width="29" class="mobileOnTab"></td>
                      <td width="243">
                      <img src="<?= $path ?>/imgs/clean.png" width="1" height="0" style="display:block; margin:0; padding:0; border:none;"/>
                      </td>
                      <td width="178" class="mobileOffTab"></td>
                      <td width="29" class="mobileOnTab"></td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    <!-- end: button discover now  -->

                    <!-- grey row -->
                    <tr bgcolor="#666666">
                      <td class="mobile">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="40" class="mobileOffTab"></td>
                          <td width="16" class="mobileOnTab"></td>
                          <td>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="48" style="display:block; margin:0; padding:0; border:none;"/>
                            <center>
                            <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#fff; letter-spacing:2px; text-align:center;" class="mobile-font">
                              HUAWEI P10 ON VODACOM 4G<br/>
                            </font>
                              <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                            </center>
                            <p style="font-family:MyriadLight, Arial, Helvetica; color:#fff; text-align:center; font-size:16px;">
                              Style, craftmanship and innovation, all with the connectivity speed to match thanks to Vodacom’s 4G network. Discover more in store or online.
                            </p>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="32" style="display:block; margin:0; padding:0; border:none;" class="mobileOffTab"/> 
                          </td>
                          <td width="40" class="mobileOffTab"></td>
                          <td width="16" class="mobileOnTab"></td>
                        </tr>
                        </table>
                      </td>
                    </tr>

                    <tr bgcolor="#666666">
                      <td class="mobile" style="text-align:center;">
                        <center>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                          <td width="178" class="mobileOffTab"></td>
                          <td width="29" class="mobileOnTab"></td>
                            <td width="243">
                              <a href="https://www.vodacom.co.za/vodacom/shopping/devices?manufacturerId=2">
                              <img src="<?= $path ?>/imgs/btn-shop-now.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
                              </a>
                              <img src="<?= $path ?>/imgs/clean.png" width="1" height="72" style="display:block; margin:0; padding:0; border:none;" /> 
                            </td>
                          <td width="178" class="mobileOffTab"></td>
                          <td width="29" class="mobileOnTab"></td>
                          </tr>
                        </table>
                        </center>
                      </td>
                    </tr>
                    <!-- end: grey row-->

                    <!-- socialButtons -->
                    <tr bgcolor="#060000">
                    <td style="text-align:center; display:inline" class="mobile">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" >
                        <tr>
                          <td class="mobileOffTab"><img src="<?= $path ?>/imgs/social-bg-2.jpg" width="219" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
                          <td><a href="https://www.instagram.com/huaweiza/"><img src="<?= $path ?>/imgs/icon_instagram-2.jpg" width="59" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td><a href="https://www.facebook.com/HuaweimobileZA/"><img src="<?= $path ?>/imgs/icon_fb-2.jpg" width="47" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td><a href="http://www.vodacom.co.za/vodacom/contact-us/find-a-store"><img src="<?= $path ?>/imgs/icon_maps-2.jpg" width="51" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td class="mobileOffTab"><img src="<?= $path ?>/imgs/social-bg-2.jpg" width="224" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
                        </tr>
                      </table>
                    </td>
                    </tr>
                    <!-- END; socialButtons -->

                    <!-- Fotter -->
                    <tr bgcolor="#1b1919">
                    <td class="mobile">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                      <tr height="8">
                        <td colspan="3"></td>
                      </tr>
                      <tr>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                        <td style="text-align:center;">
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="14" style="display:block; margin:0; padding:0; border:none;"/>

                              <a href="<?= 'http://'.$_SERVER['HTTP_HOST'] ?>/admin/pages/terms-and-conditions" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:10px;">
                                <font style="font-family:MyriadLight, Arial, Helvetica; color:#969696; text-decoration:underline; font-size:10px;">
                                <u>Please click here to view terms and conditions</u></font>
                              </a>

                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="30" style="display:block; margin:0; padding:0; border:none;"/>

                        </td>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                      </tr>
                      </table>
                    </td>
                    </tr>
                    <!-- end: Fotter -->
                </table>
                <!-- End Container -->
              
        </td>
      </tr>
    </table>
  </center>