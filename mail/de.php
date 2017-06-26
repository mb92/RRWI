<?php  
use yii\helpers\Url;

$path = 'http://'.$_SERVER['HTTP_HOST'].'/dist/email/';

?>
<img src="http://www.google-analytics.com/collect?v=1&tid=<?= $tid ?>&cid=<?= $cid ?>&t=event&ec=email&ea=open&el=open_email&cs=newsletter&cm=email&cn=selfie-app" />
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
                        </td>
                        <td style="text-align:center;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; font-size:11px; letter-spacing:1px;">
                              DEIN PERFEKTES SELFIE ANBEI</font>
                        </td>
                        <td style="text-align:center;" width="25%">
                            <?php if ($unsub != "#") { 
                              echo '
                              <a href="'.$unsub.'" style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:9px; letter-spacing:1px;">
                              <font style="font-family:MyriadLight, Arial, Helvetica; color:#9fa0a1; text-decoration:underline; font-size:9px; letter-spacing:1px;">
                              abmelden</font>
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
                      <img src="<?= $path ?>/imgs/women.jpg" width="100%" height="auto" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
                    </td>
                  </tr>

                    <!-- Hi -->
                  <tr bgcolor="#f2f2f2">
                    <td style="text-align:center; font-size:16px; color:#000; font-family:MyriadLight, Arial, Helvetica;" class="mobile">
                      <center>
                      <img src="<?= $path ?>/imgs/clean.png" width="1" height="50" style="display:block; margin:0; padding:0; border:none;"/>
                        Hallo <font color="#ed1c24"><?= $name; ?></font>
                      </center>
                    </td>
                  </tr>
                  <!-- end: Hi -->


                    <!-- Header1 - Big text -->
                  <tr height="auto" bgcolor="#f2f2f2">
                    <td class="mobile" style="overflow:hidden; line-height:60px; color:#000;">
                      <center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="20" style="display:block; margin:0; padding:0; border:none;"/>
                        <font style="font-family:MyriadLight, Arial, Helvetica; font-size:35px; letter-spacing:7px; color:#000;" class="mobile-head1">DU SIEHST</font>
                        <font style="font-family:MyriadSemibold, Arial, Helvetica; letter-spacing:10px; font-size:60px; color:#000;" class="mobile-head2">
                          <b>FANTASTISCH AUS</b>
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
                            Danke für Deinen Besuch im HUAWEI P10 Selfie Studio in Deinem
                            Vodafone Store 
                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">
                            <?= $place ?></font>. 
                            Wir schicken Dir anbei Dein Selfie und hoffen, es gefällt Dir.
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
                            <b>TEILE ES AUF INSTAGRAM, UM DIR DIE GEWINNCHANCEN ZU SICHERN</b>
                            </font>
                            </center>
                            <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                            Bitte denk an den 
                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#HuaweiP10Vodacom</font> und 
                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">#<?= $country; ?></font> before 
                            <font style="color:#ee1c24; font-family:Myriad, Arial, Helvetica;">vor dem 5 August.</font>

                          <br/><br/>
                            Jede Woche werden wir unter allen Teilnehmern die fünf Selfies mit den meisten Likes auswählen. Unsere Jury wird dann daraus den Gewinner der Woche ermitteln, der ein HUAWEI P10 gewinnt.  
                          </p><br/>
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
                            <img src="<?= $path ?>/imgs/btn-share-now-de.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
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
                        <center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="38" style="display:block; margin:0; padding:0; border:none;"/>
                        <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#000; letter-spacing:2px; text-align:center;" class="mobile-font">
                          <b>DEIN PHOTO. DEIN TITELBILD.</b>
                        </font>
                        </center>
                        <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                          <p style="font-family:Myriad, Arial, Helvetica; line-height:20px; color:#58595b; text-align:center;font-size:16px;">
                              Das HUAWEI P10 - coengineered with Leica. Eine außergewöhnliche Komposition von Kunst, Kultur und Technik. Ein Telefon mit einer Seele, entworfen, um Dir zu helfen, Foto-Porträts wie ein Profi zu machen, um Deinen inneren Künstler zu entfesseln und die Art und Weise zu ändern, wie die Welt Dich sieht.
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
                            <font style="font-size:19px; font-family:MyriadBold, Arial, Helvetica; color:#fff; letter-spacing:2px; text-align:center;" class="mobile-font">
                              DAS HUAWEI P10 IM VODAFONE NETZ<br/>
                            </font>
                              <img src="<?= $path ?>/imgs/clean.png" width="1" height="6" style="display:block; margin:0; padding:0; border:none;"/>
                            </center>
                            <p style="font-family:MyriadLight, Arial, Helvetica; color:#fff; text-align:center; font-size:16px;">
                              Innovation, Design und höchste Perfektion bei der Fertigung - das macht das HUAWEI P10 aus. Verbunden im besten High-Speed-Netz von Vodafone. <br/>
                              Hol Dir das neue HUAWEI P10 in Deinem Vodafone Shop oder online.
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
                              <a href="<?= $links['store']; ?>">
                              <img src="<?= $path ?>/imgs/btn-shop-now-de.jpg" width="243" height="54" style="display:block; margin:0; padding:0; border:none;"/>
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
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#060000">
                        <tr height="40" bgcolor="#060000">
                          <td class="mobileOffTab" bgcolor="#060000"><img src="<?= $path ?>/imgs/social-bg-2.jpg" width="219" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
                          <td bgcolor="#060000"><a href="<?= $links['instagram']; ?>"><img src="<?= $path ?>/imgs/icon_instagram-2.jpg" width="59" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td bgcolor="#060000"><a href="<?= $links['facebook']; ?>"><img src="<?= $path ?>/imgs/icon_fb-2.jpg" width="47" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td bgcolor="#060000"><a href="<?= $links['location']; ?>"><img src="<?= $path ?>/imgs/icon_maps-2.jpg" width="51" height="40" style="display:block; margin:0; padding:0; border:none;"/></a></td>
                          <td class="mobileOffTab" bgcolor="#060000"><img src="<?= $path ?>/imgs/social-bg-2.jpg" width="224" height="40" style="display:block; margin:0; padding:0; border:none;"/></td>
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
  </center>
