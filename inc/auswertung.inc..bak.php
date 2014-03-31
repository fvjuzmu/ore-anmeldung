<h3>Anmeldezeitraum</h3>
<table border="1">
<tr>
    <td>Reserviert f&uuml;r:</td>
    <td>
        <?
        $firstloop = true;
        foreach($_POST['wochen'] as $blubber)
        {
            if(!$firstloop)
            {
                echo ", ";
            }
            else
            {
                $firstloop = false;
            }

            switch($blubber)
            {
                case 'zeitraum-woche-eins':
                    echo "Woche EINS";
                    break;
                case 'zeitraum-woche-zwei':
                    echo "Woche ZWEI";
                    break;
                case 'zeitraum-woche-drei':
                    echo "Woche DREI";
                    break;
                case 'zeitraum-woche-vier':
                    echo "Woche VIER";
                    break;
            }
        }
        ?>
    </td>
</tr>
</table>

<h3>Ihre Kontaktdaten (Erziehungsberechtigte Person)</h3>
<table border="1">
<tr>
    <td>Vorname:</td>
    <td><?=$_POST['ezb-vorname'];?></td>
</tr>
<tr>
    <td>Name:</td>
    <td><?=$_POST['ezb-name'];?></td>
</tr>
<tr>
    <td>Stra&szlig;:</td>
    <td><?=$_POST['ezb-strasse'];?></td>
</tr>
<tr>
    <td>PLZ:</td>
    <td><?=$_POST['ezb-plz'];?></td>
</tr>
<tr>
    <td>Ort:</td>
    <td><?=$_POST['ezb-ort'];?></td>
</tr>
<tr>
    <td>Telefon:</td>
    <td><?=$_POST['ezb-tel'];?></td>
</tr>
<tr>
    <td>Tel.-Mobil:</td>
    <td><?=$_POST['ezb-tel-mobil'];?></td>
</tr>
<tr>
    <td>Tel.-Arbeit:</td>
    <td><?=$_POST['ezb-tel-arbeit'];?></td>
</tr>
<tr>
    <td>E-Mail:</td>
    <td><?=$_POST['ezb-mail'];?></td>
</tr>
</table>

<?
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

    echo "<h3>Kind ".$yeep."</h3>";
    echo "<table border=\"1\"><tr><td>Vorname</td><td>".$_POST[$outKind.'vorname']."</td><tr></tr>";
    echo "<tr><td>Name</td><td>".$_POST[$outKind.'name']."</td><tr></tr>";
    echo "<tr><td>Geburtstag</td><td>".$_POST[$outKind.'geburt']."</td><tr></tr>";
    echo "<tr><td>kann schwimmen</td><td>";
    if(in_array($outKind."schwimmer", $_POST[$outKind.'eigenschaften']))
    {
        echo "JA";
    }
    else
    {
        echo "NEIN";
    }
    echo "</td><tr></tr>";

    echo "<tr><td>darf in das Hallenbad</td><td>";
    if(in_array($outKind."hallenbad", $_POST[$outKind.'eigenschaften']))
    {
        echo "JA";
    }
    else
    {
        echo "NEIN";
    }
    echo "</td><tr></tr>";

    echo "<tr><td>ben&ouml;tigt Medikamente</td><td>";
    if(in_array($outKind."medikamente", $_POST[$outKind.'eigenschaften']))
    {
        echo "JA";
    }
    else
    {
        echo "NEIN";
    }
    echo "</td><tr></tr>";

    echo "<tr><td>hat Allergien</td><td>";
    if(in_array($outKind."allergie", $_POST[$outKind.'eigenschaften']))
    {
        echo "JA";
    }
    else
    {
        echo "NEIN";
    }
    echo "</td><tr></tr></table>";
}
?>

<h3>Abholung</h3>
</table>
<table border="1">
<tr>
    <td>Kind(er) d&uuml;rfen alleine nach Hause?</td>
    <td>
        <?
        if('abhol-person' == $_POST['abhol'])
        {
            echo "NEIN";
        }
        else
        {
            echo "JA";
        }
        ?>
    </td>
</tr>
<tr>
    <td>Zum abholen berechtigte Personen:</td>
    <td>
        <?
        echo $_POST['abholer-eins'].", ";
        echo $_POST['abholer-zwei'].", ";
        echo $_POST['abholer-drei'].", ";
        echo $_POST['abholer-vier'].", ";
        echo $_POST['abholer-fuenf'];
        ?>
    </td>
</tr>
</table>

<h3>Nachricht an die Organisatoren</h3>
<table border="1">
<tr>
    <td>Notiz:</td>
    <td><?=$_POST['message'];?></td>
</tr>
</table>