<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ortsranderholung Mutterstadt - Reservierung</title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link href="style/default.css" rel="stylesheet" type="text/css" />
    <link href="style/template.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript">
        function clearText(field) {
            if (field.defaultValue == field.value) field.value = '';
            else if (field.value == '') field.value = field.defaultValue;
        }
    </script>
</head>
<body>
    <div id="header_wrapper">
        <div id="header">
            <div id="site_title">
                <h1><a href="index.php"> <img src="images/ore_logo.png" alt="" /> <span>Mutterstadt</span> </a></h1>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php">Startseite</a></li>
                    <li><a href="reservation.php" class="current">Anmeldung</a></li>
                    <li><a href="information.php">Info</a></li>
                    <li><a href="impressum.php">Kontakt</a></li>
                </ul>
            </div>
            <!-- end of menu -->
            <div class="cleaner"></div>
        </div>
        <!-- end of header -->
    </div>
    <!-- end of header_wrapper -->
    <div id="content_wrapper">
        <div id="content">
            <div class="content_section">

                <?php
                $output = '';
                //*/
                ini_set('display_errors',1);
                ini_set('display_startup_errors',1);
                error_reporting(-1);
                //*/

                // ##### SAVE Reservation information #####
                require_once('inc/save_reservation.inc.php');

                $summe = 0;
                switch($_POST['anz-kinder'])
                {
                    case 'kinder-anz-eins':
                        $kidsCounter = 1;
                        break;
                    case 'kinder-anz-zwei':
                        $kidsCounter = 2;
                        break;
                    case 'kinder-anz-drei':
                        $kidsCounter = 3;
                        break;
                }

                $weekCounter = count($_POST['wochen']);

                require_once('./inc/getNextOREInfo.inc.php');

                $summe = ($weekCounter * $kidsCounter) * $ORE['cpreis'];
                // ##### OUTPUT Reservation information #####
                $output .= "<h2>Reservierungs Best&auml;tigung</h2>
                Im Folgenden sehen Sie noch einmal Ihre Angaben zur Reservierung wie wir sie erhalten haben.<br/>
                Eine Kopie dieser Reservierungsdaten wird Ihnen auch an Ihre angegeben E-Mail-Adresse geschickt.<br/>
                Sollte etwas nicht korrekt sein, kontaktieren Sie uns bitte umgehende.<br/>
                <br/>
                Beachten Sie auch das es sich lediglich um eine Reservierung handelt die f&uuml;r die n&auml;chsten 10 Tage g&uuml;ltigt ist.<br/>
                Um den Anmeldevorgang abzuschlie&szlig;en, &uuml;berweisen sie bitte einen <b>Gesamtbetrag von ".$summe." &euro;</b> auf das folgende Bankkonto:<br/>
                <b>Kontoinhaber: Arbeiterwohlfahrt<br/>
				Bank: VR-Bank Rhein-Neckar<br/>
				BLZ: 67 09 00 00<br/>
				Kontonummer: 23965</b><br/>";
				
				if(in_array("kind-eins-medikamente", $_POST['kind-eins-eigenschaften']) OR
					in_array("kind-zwei-medikamente", $_POST['kind-zwei-eigenschaften']) OR
					in_array("kind-drei-medikamente", $_POST['kind-drei-eigenschaften']))
				{
					$output .= "<br/><br/><b> <font style=\"color: red\">Sie haben angegeben dass Ihr Kind / Ihre Kinder Medikamente benötigen,<br/>bitte geben Sie w&auml;hrend der Ortsranderholung dem zust&auml;ndigen Gruppenbetreuer<br/> weitere Informationen zu den ben&ouml;tigten Medikamenten.</font></b><br/><br/>";
				}
				
				if(in_array("kind-eins-allergie", $_POST['kind-eins-eigenschaften']) OR
					in_array("kind-zwei-allergie", $_POST['kind-zwei-eigenschaften']) OR
					in_array("kind-drei-allergie", $_POST['kind-drei-eigenschaften']))
				{
					$output .= "<br/><br/><b> <font style=\"color: red\">Sie haben angegeben dass Ihr Kind / Ihre Kinder Allergien haben,<br/>bitte geben Sie w&auml;hrend der Ortsranderholung dem zust&auml;ndigen Gruppenbetreuer<br/> weitere Informationen zu den Allergien.</font></b><br/><br/>";
				}

                require_once('./inc/auswertung.inc.php');

                require_once('./inc/sendMails.inc.php');

                echo $output;

                ?>
            </div>
            <div class="cleaner_h40"></div>
        </div>
        <!-- end of content -->
        <div class="cleaner"></div>
    </div>
    <div id="content_wrapper_bottom"></div>
    <!-- end of content_wrapper -->
    <div id="footer">
        Copyright &copy; <?=date('Y');?> <a href="http://jugendtreff.mutterstadt.de">Jugendtreff Mutterstadt</a> | Umsetzung durch den <a href="http://foerderverein-juzmu.de">F&ouml;rderverein des Jugendtreff Mutterstadt</a> | Designed by <a href="http://www.templatemo.com/">Free CSS Templates</a>
    </div>
    <!-- end of footer -->
</body>
</html>