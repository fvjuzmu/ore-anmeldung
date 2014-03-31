<?php

// ##### E-Mail zum Kunden #####
    $to = strip_tags($_POST['ezb-mail']);

    $subject = 'Ihre Reservierung bei der Ortsranderholung Mutterstadt';

    $headers = "From: Jugendtreff Mutterstadt <ore-anmeldung@jugendtreff.mutterstadt.de>\r\n";// . strip_tags($_POST['req-email']) . "\r\n";
    $headers .= "Reply-To: ore-anmeldung@jugendtreff.mutterstadt.de\r\n";//. strip_tags($_POST['req-email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $von = array("ä","ö","ü","ß","Ä","Ö","Ü","é");  //to correct double whitepaces as well
    $zu  = array("&auml;","&ouml;","&uuml;","&szlig;","&Auml;","&Ouml;","&Uuml;","&#233;");
    $output = str_replace($von, $zu, "<html><body style=\"padding: 30px\">".$output."</body></html>");

    mail($to, $subject, $output, $headers);

// ##### E-Mails an den ORE-Verteiler #####
    //$dbh = new PDO('mysql:host=', '', '');
    include("db_connect.inc.php");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt_verteiler = $dbh->prepare("SELECT * FROM ore_verteiler");
    if($stmt_verteiler->execute())
    {
        $row = $stmt_verteiler->fetch(PDO::FETCH_ASSOC);

        $vSubject = 'Neue Reservierung für die Ortsranderholung Mutterstadt';

        $vHeaders = "From: Jugendtreff Mutterstadt <ore-anmeldung@jugendtreff.mutterstadt.de>\r\n";// . strip_tags($_POST['req-email']) . "\r\n";
        $vHeaders .= "Reply-To: ore-anmeldung@jugendtreff.mutterstadt.de\r\n";//. strip_tags($_POST['req-email']) . "\r\n";
        $vHeaders .= "MIME-Version: 1.0\r\n";
        $vHeaders .= "Content-Type: text/html; charset=UTF-8\r\n";
		
        while($row = $stmt_verteiler->fetch(PDO::FETCH_ASSOC))
        {
            if($row['cmail'][0] == '#')
            {
                continue;
            }
            mail($row['cmail'], $vSubject, $output, $vHeaders);
        }
    }
?>