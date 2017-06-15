<?php  

// vdd(yii::$app->getRequest()->serverName);
// $path = Yii::$app->params['urlTemplateElements'];

// $path = yii::$app->getRequest()->serverName.'/dist/email';
$path = "http://selfie-app.testdnd.ovh/dist/email/";

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
                        <td style="text-align:center;" width="25%">
                        <?php if ($unsub != "#") { 
                              echo '
                              <a href="'.$unsub.'" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:9px; letter-spacing:1px;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:9px; letter-spacing:1px;">
                              unsubscribe</font>
                              </a>';
                          } ?>

                        </td>
                        <td style="text-align:center;">
                              <a href="#" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:11px; letter-spacing:1px;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:11px; letter-spacing:1px;">
                              YOUR PERFECT SELFIE IS ATTACHED</font>
                              </a>
                        </td>
                        <td width="25%"></td>
                      </tr>
                    </table>

<!--                       <center>
                        <a href="#" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:11px; letter-spacing:1px;">
                        <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:11px; letter-spacing:1px;">
                        YOUR PERFECT SELFIE IS ATTACHED</font>
                        </a>
                      </center> -->
                    </td>
                  </tr>
                  <tr>
                    <td width="600" class="mobile" style="font-family:MyriadLight, Arial, Helvetica; font-size:12px; line-height:18px;">
                      <img src="<?= $path ?>/imgs/red_bar.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
                    </td>
                  </tr>
                  <tr>
                    <td width="600" class="mobile" style="font-family:MyriadLight, Arial, Helvetica; font-size:12px; line-height:18px;">
                      <img src="<?= $path ?>/imgs/women.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
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
                            Thank you for visiting the P10 Selfie Studio at Vodafone <font color="#ee1c24"><?= $place; ?></font>. <br/>
                            We’ve attached your selfie to thisemail. We hope you love it.
                            </p>
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="30" style="display:block; margin:0; padding:0; border:none;"/>
                        </td>
                        <td width="40" class="mobileOffTab"></td>
                        <td width="16" class="mobileOnTab"></td>
                      </tr>
                      </table>

<!--                       <img src="<?= $path ?>/imgs/clean.png" width="1" height="34" style="display:block; margin:0; padding:0; border:none;"/>
                      <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; font-size:16px; text-align:center; color:#58595b;">
                        Thank you for visiting the P10 Selfie Studio at Vodafone <font color="#ee1c24">[place]</font>. <br/>
                        We’ve attached your selfie to thisemail. We hope you love it.
                      </p>
                      <img src="<?= $path ?>/imgs/clean.png" width="1" height="30" style="display:block; margin:0; padding:0; border:none;"/> -->




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
                            <b>SHARE YOUR SELFIE FOR YOUR CHANCE TO <br/>WIN A HUAWEI P10</b>
                            </font>
                            </center>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                            All you need to do is share your Selfie Studio shot on <br/>
                            Instagram with <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#P10SelfieVodafone</font> and 
                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#<?= $country; ?></font> before 
                            <font style="color:#ee1c24"><?= $endDate; ?></font>.
                          <br/><br/>
                            Each week we’ll shortlist the five selfies with the most likes on <br/>
                            Instagram. Our panel of judges will then select a weekly winner <br/>
                            from that shortlist to receive a Huawei P10
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
                            <a href="#">
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
                          The Huawei P10’s co-engineered with Leica. An extraordinary fusion of art, culture and technology. A phone wit a soul, designed to help you take photo portraitslike a pro, to unleash your inner artist and change the way the world sees you.
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
                              <img src="<?= $message->embed($imageFileName); ?>" width="171" height="300" style="display:block; margin:0; padding:0; border:none;"/>
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
                        <a href="#">
                        <img src="<?= $path ?>/imgs/btn-discover-more.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
                        </a>
                      <img src="<?= $path ?>/imgs/clean.png" width="1" height="74" style="display:block; margin:0; padding:0; border:none;"/>
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
                              OFFER LOREM IPSUM<br/>
                            </font>
                              <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                            </center>
                            <p style="font-family:MyriadLight, Arial, Helvetica; color:#fff; text-align:center; font-size:16px;">
                              No duo solum reque ipsum, decore tractatos an has, ne sit consect es etuer.<br/>
                               Elit quas zril his no. Duo at prodesset dissentiet, molestie in ius. Vis amet quot <br/> ei, expetenda intellegam reformidans tesed, ornatus percipitur ex sit.
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
                              <a href="#">
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
                          <td class="mobileOffTab"><img src="<?= $path ?>/imgs/social-bg.jpg" width="170" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
                          <td><a href="<?= $links['instagram']; ?>"><img src="<?= $path ?>/imgs/icon_instagram.jpg" width="55" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td><a href="<?= $links['facebook']; ?>"><img src="<?= $path ?>/imgs/icon_fb.jpg" width="47" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td><a href="<?= $links['twitter']; ?>"><img src="<?= $path ?>/imgs/icon_twitter.jpg" width="57" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td><a href="<?= $links['youtube']; ?>"><img src="<?= $path ?>/imgs/icon_yt.jpg" width="61" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td><a href="<?= $links['location']; ?>"><img src="<?= $path ?>/imgs/icon_maps.jpg" width="40" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td class="mobileOffTab"><img src="<?= $path ?>/imgs/social-bg.jpg" width="170" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
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
                        <td>
                          <img src="<?= $path ?>/imgs/clean.png" width="1" height="14" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="color:#555; font-family:MyriadLight, Arial, Helvetica; letter-spacing: 1px; font-size: 10px; text-align:left;">
                          TERMS AND CONDITIONS 
                          </p>
                          <p style="color:#555; font-family:MyriadLight, Arial, Helvetica; font-size: 10px; text-align:left;">
                          Dolor sit amet, qui te meliore quaestio moderatius, no alia sonet his. Quo ea unum laoreet maiorum, nam ea tollit graecis. Vis quando platonem explicari in, impedit suscipit probatus mel te. Eam no dolorum inermis, eos dicat quodsi recteque cu, ei vix enim tibique.
                          </p>
                          <p style="color:#555; font-family:MyriadLight, Arial, Helvetica; font-size: 10px; text-align:left;">
                          Omittam disputando vituperatoribus nec at. Putant officiis scribentur sit ne, altera fierent verterem sit id. Aeque aperiri consetetur sit no, id etiam utroque vix, duo tempor invidunt legendos in. Ei sit suavitate neglegentur. Everti eruditi sit in. Ea usu viris mucius, ex vis minim discere intellegam. Eum te nisl fuisset.
                          </p>
                          <p style="color:#555; font-family:MyriadLight, Arial, Helvetica; font-size: 10px; text-align:left;">
                          Vis quando platonem explicari in, impedit suscipit probatus mel te. Eam no dolorum inermis, eos dicat quodsi recteque cu, ei vix enim tibique. Everti eruditi sit in. Ea usu viris mucius, ex vis minim discere intellegam. Eum te nisl fuisset.
                          </p>
                         <img src="<?= $path ?>/imgs/clean.png" width="1" height="35" style="display:block; margin:0; padding:0; border:none;"/>
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