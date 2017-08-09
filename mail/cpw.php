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
                        <td width="25%">
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="28" style="display:block; margin:0; padding:0; border:none;"/>
<img src="http://www.google-analytics.com/collect?v=1&tid=<?= $tid ?>&cid=<?= $cid ?>&t=event&ec=email&ea=open&el=open_email&cs=newsletter&cm=email&cn=selfie-app" style="border-color:#525252; display:block; margin:0; padding:0; border:none;"/>

                        </td>
                        <td style="text-align:center;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; font-size:11px; letter-spacing:1px;">
                              YOUR PERFECT SELFIE IS ATTACHED</font>
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
                      <img src="<?= $path ?>/imgs/women-cw2.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
                    </td>
                  </tr>

                    <!-- Hi -->
                  <tr bgcolor="#f2f2f2">
                    <td style="text-align:center; font-size:16px; color:#000; font-family:MyriadLight, Arial, Helvetica;" class="mobile">
                      <center>
                      <img src="<?= $path ?>/imgs/clean.png" width="1" height="50" style="display:block; margin:0; padding:0; border:none;"/>
                        Hi <font color="#ed1c24"><?= $name; ?></font>
                      </center>
                    </td>
                  </tr>
                  <!-- end: Hi -->


                    <!-- Header1 - Big text -->
                  <tr height="auto" bgcolor="#f2f2f2">
                    <td class="mobile" style="overflow:hidden; line-height:60px; color:#000;">
                      <center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="20" style="display:block; margin:0; padding:0; border:none;"/>
                        <font style="font-family:MyriadLight, Arial, Helvetica; font-size:40px; letter-spacing:7px; color:#000;" class="mobile-head1">YOU'RE LOOKING</font>
                        <font style="font-family:MyriadSemibold, Arial, Helvetica; letter-spacing:10px; font-size:75px; color:#000;" class="mobile-head2">
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
                                    Thank you for visiting the P10 Selfie Studio at <br/>
                                    Carphone Warehouse
                                    
                                    <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;"><?= $place ?></font>.
                                    We’ve attached your <br/>
                                    selfie to this e-mail. We hope you love it.
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
                            <b>SHARE FOR YOUR CHANCE TO WIN A<br/> HUAWEI P10</b>
                            </font>
                            </center>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                            To enter, all you need to do is share your Selfie Studio shot on <br/>
                            Instagram with <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#P10SelfieStudio</font> and 

                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#<?= $country; ?></font> before 8th November.

                          <br/><br/>
                          Each week our judge will select the image that best captures the <br/>
                          idea of the ‘Perfect Selfie’ in a unique and creative way. <br/>
                          The winning photographer will receive a brand new Huawei P10, so <br/>
                          every shot can be a cover shot.
                          </p>
                          <br/>
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
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="178" class="mobileOffTab"></td>
                          <td width="29" class="mobileOnTab"></td>
                          <td width="243">
                            <a href="<?= $links['share']; ?>">
                            <img src="<?= $path ?>/imgs/btn-share-now.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
                            </a>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="42" style="display:block; margin:0; padding:0; border:none;" />
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
                        <center><br/>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="38" style="display:block; margin:0; padding:0; border:none;"/>
                        <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#000; letter-spacing:2px; text-align:center;" class="mobile-font">
                          <b>MAKE EVERY SHOT A COVER SHOT</b>
                        </font>
                        </center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                            The Huawei P10; co-engineered with Leica. An extraordinary fusion of <br/>
                            art, culture and technology. A phone with a soul, designed to help<br/>
                            you take photo portraits like a pro, to unleash your inner artist and <br/>
                            change the way the world sees you.
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
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody><tr bgcolor="#f2f2f2">
                            <td width="207px" class="mobileOffTab">
                              <img src="<?= $path ?>/imgs/clean.png" width="207" height="1" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="57px" class="mobileOnTab">
                              <img src="<?= $path ?>/imgs/clean.png" width="57" height="1" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="186px" align="center" style="text-align:center;">
                              <img src="<?= $path ?>/imgs/phone.jpg" width="186" height="391" style="display:block; margin:0; padding:0; border:none;">
                            </td>
                            <td width="207px" class="mobileOffTab">
                              <img src="<?= $path ?>/imgs/clean.png" width="207" height="1" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                            <td width="57px" class="mobileOnTab">
                              <img src="<?= $path ?>/imgs/clean.png" width="57" height="1" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                          </tr>
                        </tbody></table>
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
                            <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#fff; letter-spacing:2px; text-align:center; font-weight:bold;" class="mobile-font">
                            <b>HUAWEI P10 AT CARPHONE WAREHOUSE</b><br/>
                            </font>
                              <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                            </center>
                            <p style="font-family:MyriadLight, Arial, Helvetica; color:#fff; text-align:center; font-size:16px;">
                                Make sure to order your Huawei P10 from                               
                                Carphone Warehouse today. <br/>

                                They compare the widest range of tariffs to find the right deal for you.<br/><br/>
                              Call free 08000496103 or visit your 
                                <a href="<?= $links['location']; ?>">
                                    <font style="color:#001e50; font-family:Myriad, Arial, Helvetica;">
                                        <u>local Carphone Warehouse store</u>
                                    </font>
                                </a><br/>
                              to find out more.
                            </p><br/>
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
                              <a href="<?= $links['store']; ?>">
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
                    <tr bgcolor="#060000" height="40" background="<?= $path ?>/imgs/social-bg-2.jpg">
                      <td style="text-align:center; display:inline" class="mobile">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" >
                          <tr height="40">
                            <td class="mobileOffTab" width="75"><img src="<?= $path ?>/imgs/social-bg.jpg" width="55" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
                            <td class="mobileOffTab" style="color: #58595b; padding-top: 2px; font-size: 12px;">
                                CALL&nbsp;FREE&nbsp;-&nbsp;0800&nbsp;0496103
                            </td>
      
                            <td class="mobileOnTab" style="color: #58595b; padding-top: 4px; padding-left:4px; font-size: 14px; display:none; vertical-align:middle; font-size:12px; text-align:left;">
                                <img src="<?= $path ?>/imgs/clean.png" width="1" height="2px" style="display:block; margin:0; padding:0; border:none;" />
                                CALL FREE:<br/>0800&nbsp;0496103
                            </td>
                            <td width="55">
                              <a href="<?= $links['instagram']; ?>"><img src="<?= $path ?>/imgs/icon_instagram.jpg" width="55" height="40" style="display:block; margin:0; padding:0; border:none;"/></a>
                            </td>
                            <td width="47">
                              <a href="<?= $links['facebook']; ?>"><img src="<?= $path ?>/imgs/icon_fb.jpg" width="47" height="40" style="display:block; margin:0; padding:0; border:none;"/></a>
                            </td>
                            <td width="57">
                              <a href="<?= $links['twitter']; ?>"><img src="<?= $path ?>/imgs/icon_twitter.jpg" width="57" height="40" style="display:block; margin:0; padding:0; border:none;"/></a>
                            </td>
                            <td class="mobileOffTab">
                              <img src="<?= $path ?>/imgs/social-bg.jpg" width="190" height="40" style="display:block; margin:0; padding:0; border:none;"/>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <!-- END; socialButtons -->

                    <!-- Fotter -->
                    <tr bgcolor="#1b1919">
                    <td class="mobile">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                      <tr>
                        <td></td>
                        <td>
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="10" style="display:block; margin:0; padding:0; border:none;"/>   
                        </td>
                        <td></td>
                      </tr>
                      <tr>
                        <td width="40" class="mobileOffTab" valign="middle" style="vertical-align:middle; font-size: 0"></td>
                        <td width="16" class="mobileOnTab" valign="middle" style="vertical-align:middle; font-size: 0"></td>
                        <td style="text-align:center; vertical-align:middle;" valign="middle">
                              <a href="<?= $links['terms'] ?>" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:10px;">
                                <font style="font-family:MyriadLight, Arial, Helvetica; color:#969696; text-decoration:underline; font-size:10px;">
                                <u>Please click here to view terms and conditions</u></font>
                              </a>
                        </td>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                      </tr>
                        <tr>
                        <td></td>
                        <td>
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="13" style="display:block; margin:0; padding:0; border:none;"/>   
                        </td>
                        <td></td>
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
        </td>
      </tr>
    </table>
  </center>
