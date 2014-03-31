<?
$output .= "<h3>Anmeldezeitraum</h3>";
$output .= " <table style=\"border: 1px dotted #d3d3d3; border-spacing: 0px;border-collapse:collapse;\">    ";
$output .= "<tr>";
    $output .= "<td style=\"border: 1px dotted #d3d3d3; padding: 5px 5px; width: 200px;\">Reserviert f&uuml;r:</td>";
    $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";

        $firstloop = true;
        foreach($_POST['wochen'] as $blubber)
        {
            if(!$firstloop)
            {
                $output .= ", ";
            }
            else
            {
                $firstloop = false;
            }

            switch($blubber)
            {
                case 'zeitraum-woche-eins':
                    $output .= "Woche EINS";
                    break;
                case 'zeitraum-woche-zwei':
                    $output .= "Woche ZWEI";
                    break;
                case 'zeitraum-woche-drei':
                    $output .= "Woche DREI";
                    break;
                case 'zeitraum-woche-vier':
                    $output .= "Woche VIER";
                    break;
            }
        }

$output .= "    </td> ";
$output .= "</tr>";
$output .= "</table>";

$output .= "<h3>Ihre Kontaktdaten (Erziehungsberechtigte Person)</h3>";
$output .= " <table style=\"border: 1px dotted #d3d3d3; border-spacing: 0px;border-collapse:collapse;\">";
    $output .= "<tr>";
        $output .= "<td style=\"border: 1px dotted #d3d3d3; padding: 5px 5px; width: 200px;\">Vorname:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-vorname'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Name:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-name'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Stra&szlig;:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-strasse'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">PLZ:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-plz'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Ort:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-ort'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Telefon:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-tel'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Tel.-Mobil:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-tel-mobil'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Tel.-Arbeit:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-tel-arbeit'])."</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">E-Mail:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['ezb-mail'])."</td>";
        $output .= "</tr>";
    $output .= "</table>";


switch($_POST['anz-kinder'])
{
    case 'kinder-anz-eins':
        $maxKids = 1;
        break;
    case 'kinder-anz-zwei':
        $maxKids = 2;
        break;
    case 'kinder-anz-drei':
        $maxKids = 3;
        break;
}

for($i=0; $i < $maxKids; $i++)
{
    switch($i)
    {
        case 0;
            $yeep = "eins";
            break;
        case 1;
            $yeep = "zwei";
            break;
        case 2;
            $yeep = "drei";
            break;

    }

    $outKind = 'kind-'.$yeep.'-';

    $output .= "<h3>Kind ".$yeep."</h3>";
    $output .= " <table style=\"border: 1px dotted #d3d3d3; border-spacing: 0px;border-collapse:collapse;\"><tr><td style=\"border: 1px dotted #d3d3d3; padding: 5px 5px; width: 200px;\">Vorname:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST[$outKind.'vorname'])."</td><tr></tr>";
    $output .= "<tr><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Name:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST[$outKind.'name'])."</td><tr></tr>";
    $output .= "<tr><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Geburtstag:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST[$outKind.'geburt'])."</td><tr></tr>";
    $output .= "<tr><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">kann schwimmen:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";
    if(in_array($outKind."schwimmer", $_POST[$outKind.'eigenschaften']))
    {
        $output .= "JA";
    }
    else
    {
        $output .= "NEIN";
    }
    $output .= "</td><tr></tr>";

    $output .= "<tr><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">darf in das Hallenbad:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";
    if(in_array($outKind."hallenbad", $_POST[$outKind.'eigenschaften']))
    {
        $output .= "JA";
    }
    else
    {
        $output .= "NEIN";
    }
    $output .= "</td><tr></tr>";

    $output .= "<tr><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">ben&ouml;tigt Medikamente:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";
    if(in_array($outKind."medikamente", $_POST[$outKind.'eigenschaften']))
    {
        $output .= "JA";
    }
    else
    {
        $output .= "NEIN";
    }
    $output .= "</td><tr></tr>";

    $output .= "<tr><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">hat Allergien:</td><td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";
    if(in_array($outKind."allergie", $_POST[$outKind.'eigenschaften']))
    {
        $output .= "JA";
    }
    else
    {
        $output .= "NEIN";
    }
    $output .= "</td><tr></tr></table>";
}


$output .= "<h3>Abholung</h3>";
$output .= "</table>";
$output .= " <table style=\"border: 1px dotted #d3d3d3; border-spacing: 0px;border-collapse:collapse;\">";
    $output .= "<tr>";
        $output .= "<td style=\"border: 1px dotted #d3d3d3; padding: 5px 5px; width: 200px;\">Kind(er) d&uuml;rfen alleine nach Hause:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";

        if('abhol-person' == $_POST['abhol'])
        {
            $output .= "NEIN";
        }
        else
        {
            $output .= "JA";
        }

            $output .= "</td>";
        $output .= "</tr>";
    $output .= "<tr>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">Zum abholen berechtigte Personen:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">";

        $output .= htmlentities($_POST['abholer-eins']);

        if(strlen($_POST['abholer-zwei']) > 0)
        {
            $output .= "; ";
        }
        $output .= htmlentities($_POST['abholer-zwei']);

        if(strlen($_POST['abholer-drei']) > 0)
        {
            $output .= "; ";
        }
        $output .= htmlentities($_POST['abholer-drei']);

        if(strlen($_POST['abholer-vier']) > 0)
        {
            $output .= "; ";
        }
        $output .= htmlentities($_POST['abholer-vier']);

        if(strlen($_POST['abholer-fuenf']) > 0)
        {
            $output .= "; ";
        }
        $output .= htmlentities($_POST['abholer-fuenf']);

            $output .= "</td>";
        $output .= "</tr>";
    $output .= "</table>";

$output .= "<h3>Nachricht an die Organisatoren</h3>";
$output .= " <table style=\"border: 1px dotted #d3d3d3; border-spacing: 0px;border-collapse:collapse;\">";
    $output .= "<tr>";
        $output .= "<td style=\"border: 1px dotted #d3d3d3; padding: 5px 5px; width: 200px;\">Notiz:</td>";
        $output .= "<td  style=\"border: 1px dotted #d3d3d3; padding: 5px 5px;\">".htmlentities($_POST['message'])."</td>";
        $output .= "</tr>";
    $output .= "</table>";