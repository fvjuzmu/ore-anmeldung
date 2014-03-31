<?php
/*/
echo "<!--pre>";
    echo "REQUEST\n";
    print_r($_REQUEST);
    echo "</pre-->";
//*/

// ##### OPEN DB CONNECTION #####
try
{
    //$dbh = new PDO('mysql:host=', '', '');
    include("db_connect.inc.php");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->beginTransaction();
}
catch (PDOException $e)
{
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// ##### Prepare reservation SQL statement #####
$stmt_reservation = $dbh->prepare("INSERT INTO ore_reservations (   coreid,
                                                                        cweekone,
                                                                        cweektwo,
                                                                        cweekthree,
                                                                        cweekfour,
                                                                        ckidcounter,
                                                                        cerzvorname,
                                                                        cerznachname,
                                                                        cerzstrasse,
                                                                        cerzplz,
                                                                        cerzort,
                                                                        cerztelefon,
                                                                        cerztelmobil,
                                                                        cerztelarbeit,
                                                                        cerzmail,
                                                                        cabholalleine,
                                                                        cabholeins,
                                                                        cabholzwei,
                                                                        cabholdrei,
                                                                        cabholvier,
                                                                        cabholfuenf,
                                                                        cmessage)
                                                              VALUES (  :oreid,
                                                                        :weekone,
                                                                        :weektwo,
                                                                        :weekthree,
                                                                        :weekfour,
                                                                        :kidcounter,
                                                                        :erz_vorname,
                                                                        :erz_nachname,
                                                                        :erz_strasse,
                                                                        :erz_plz,
                                                                        :erz_ort,
                                                                        :erz_telefon,
                                                                        :erz_mobile,
                                                                        :erz_work,
                                                                        :erz_mail,
                                                                        :abhol_alleine,
                                                                        :abhol_pers1,
                                                                        :abhol_pers2,
                                                                        :abhol_pers3,
                                                                        :abhol_pers4,
                                                                        :abhol_pers5,
                                                                        :message)");

$treu = 1;

foreach($_POST['wochen'] as $value)
{
    switch ($value){
        case 'zeitraum-woche-eins':
            $weekone = 1;
            break;
        case 'zeitraum-woche-zwei':
            $weektwo = 1;
            break;
        case 'zeitraum-woche-drei':
            $weekthree = 1;
            break;
        case 'zeitraum-woche-vier':
            $weekfour = 1;
            break;
    }
}

switch ($_POST['anz-kinder'])
{
    case 'kinder-anz-eins':
        $kidcounter = 1;
        break;
    case 'kinder-anz-zwei':
        $kidcounter = 2;
        break;
    case 'kinder-anz-drei':
        $kidcounter = 3;
        break;
}

switch ($_POST['abhol'])
{
    case 'abhol-person':
        $abhol_alleine = 0;
        break;
    case 'abhol-alleine':
        $abhol_alleine = 1;
}

$stmt_reservation->bindParam(':oreid', $_POST['oreid']);
$stmt_reservation->bindParam(':weekone', $weekone);
$stmt_reservation->bindParam(':weektwo', $weektwo);
$stmt_reservation->bindParam(':weekthree', $weekthree);
$stmt_reservation->bindParam(':weekfour', $weekfour);
$stmt_reservation->bindParam(':kidcounter', $kidcounter);
$stmt_reservation->bindParam(':erz_vorname', $_POST['ezb-vorname']);
$stmt_reservation->bindParam(':erz_nachname', $_POST['ezb-name']);
$stmt_reservation->bindParam(':erz_strasse', $_POST['ezb-strasse']);
$stmt_reservation->bindParam(':erz_plz', $_POST['ezb-plz']);
$stmt_reservation->bindParam(':erz_ort', $_POST['ezb-ort']);
$stmt_reservation->bindParam(':erz_telefon', $_POST['ezb-tel']);
$stmt_reservation->bindParam(':erz_mobile', $_POST['ezb-tel-mobil']);
$stmt_reservation->bindParam(':erz_work', $_POST['ezb-tel-arbeit']);
$stmt_reservation->bindParam(':erz_mail', $_POST['ezb-mail']);
$stmt_reservation->bindParam(':abhol_alleine', $abhol_alleine);
$stmt_reservation->bindParam(':abhol_pers1', $_POST['abholer-eins']);
$stmt_reservation->bindParam(':abhol_pers2', $_POST['abholer-zwei']);
$stmt_reservation->bindParam(':abhol_pers3', $_POST['abholer-drei']);
$stmt_reservation->bindParam(':abhol_pers4', $_POST['abholer-vier']);
$stmt_reservation->bindParam(':abhol_pers5', $_POST['abholer-fuenf']);
$stmt_reservation->bindParam(':message', $_POST['message']);

$stmt_reservation->execute();

$reservationID = $dbh->lastInsertId();

// ##### Prepare kids SQL statement #####
$stmt_kids = $dbh->prepare("INSERT INTO ore_kinder (    cresverationid,
                                                            cvorname,
                                                            czuname,
                                                            cgeburt,
                                                            cschwimmen,
                                                            challenbad,
                                                            cmedi,
                                                            callergie)
                                                 VALUES (   :reservationid,
                                                            :kindvorname,
                                                            :kindnachname,
                                                            :kindgebdat,
                                                            :kindschwimmen,
                                                            :kindhallenbad,
                                                            :kindmedi,
                                                            :kindallergie)");

$stmt_kids->bindParam(':reservationid', $reservationID);
$stmt_kids->bindParam(':kindvorname', $kindVorname);
$stmt_kids->bindParam(':kindnachname', $kindName);
$stmt_kids->bindParam(':kindgebdat', $kindGeburt);
$stmt_kids->bindParam(':kindschwimmen', $kindSchwimmen);
$stmt_kids->bindParam(':kindhallenbad', $kindHallenbad);
$stmt_kids->bindParam(':kindmedi', $kindMedi);
$stmt_kids->bindParam(':kindallergie', $kindAllergie);

switch($_POST['anz-kinder'])
{
    case 'kinder-anz-eins':
        $anzKinder = 'eins';
        break;
    case 'kinder-anz-zwei':
        $anzKinder = 'zwei';
        break;
    case 'kinder-anz-drei':
        $anzKinder = 'drei';
        break;
}

$yoo = '';
while($yoo != $anzKinder)
{
    switch($yoo)
    {
        case 'eins':
            $yoo = 'zwei';
            break;
        case 'zwei':
            $yoo = 'drei';
            break;
        default:
            $yoo = 'eins';
            break;
    }

    $kind = 'kind-'.$yoo.'-';

    $kindVorname = $_POST[$kind.'vorname'];
    $kindName = $_POST[$kind.'name'];
    $kindGeburt = $_POST[$kind.'geburt'];

    $kindSchwimmen = NULL;
    $kindHallenbad = NULL;
    $kindMedi = NULL;
    $kindAllergie = NULL;

    if(in_array($kind."schwimmer", $_POST[$kind.'eigenschaften']))
    {
        $kindSchwimmen = 1;
    }

    if(in_array($kind."hallenbad", $_POST[$kind.'eigenschaften']))
    {
        $kindHallenbad = 1;
    }

    if(in_array($kind."medikamente", $_POST[$kind.'eigenschaften']))
    {
        $kindMedi = 1;
    }

    if(in_array($kind."allergie", $_POST[$kind.'eigenschaften']))
    {
        $kindAllergie = 1;
    }

    $stmt_kids->execute();
}

$dbh->commit();
$dbh = null;
?>