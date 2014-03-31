<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]>
<html class="ie8" lang="de" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="de" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="de" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ortsranderholung Mutterstadt - Reservierung</title>
    <link rel="stylesheet" type="text/css" href="./jquery/idealforms/jquery.idealforms.min.css"/>
    <link rel="stylesheet" type="text/css" href="./style/default.css"/>
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
    //$dbh = new PDO('mysql:host=', '', '');
    include("inc/db_connect.inc.php");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare("SELECT * FROM ore WHERE cdateto > :cdate ORDER BY cdatefrom ASC LIMIT 0,1");
    $stmt->bindParam(':cdate', date('Y-m-d'));
    if(!$stmt->execute())
    {
        echo "Zur Zeit ist leider keine Online-Anmeldung m&ouml;glich.<br/>
                Für weiter Informationen kontaktieren sie bitte:<br/>
                <br/>
                Klaus Schemmel oder Haike Klaag<br/>
                Jugendtreff Mutterstadt<br/>
                Oggersheimer Str. 10<br/>
                67112 Mutterstadt<br/>
                Tel.: 06234 / 94 64 17<br/>";
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);


    // ##### Berechne freie Plätze der Woche EINS #####
    $stmt_wk1 = $dbh->prepare("SELECT sum(ckidcounter) as kc FROM ore_reservations WHERE cweekone = 1 and coreid = :oreid");
    $stmt_wk1->bindParam(':oreid', $row['cid']);
    if(!$stmt_wk1->execute())
    {
        $kids_wk1 = 0;
    }
    else
    {
        $kidCounter= $stmt_wk1->fetch(PDO::FETCH_ASSOC);
        $kids_wk1 = $kidCounter['kc'];
    }

    $free_wk1 = $row['cweekone'] - $kids_wk1;

    if($free_wk1 > 0)
    {
        $ersteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-eins\"/>Erste Ferienwoche <span style=\"color: green;\">".$free_wk1." freie Pl&auml;tze</span></label>";
    }
    else
    {
        $ersteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-eins\" disabled=\"disabled\"/><span style=\"text-decoration: line-through;\">Erste Ferienwoche</span> <span style=\"color: red;\">AUSGEBUCHT</span></label>";
    }


    // ##### Berechne freie Plätze der Woche ZWEI #####
    $stmt_wk2 = $dbh->prepare("SELECT sum(ckidcounter) as kc FROM ore_reservations WHERE cweektwo = 1 and coreid = :oreid");
    $stmt_wk2->bindParam(':oreid', $row['cid']);
    if(!$stmt_wk2->execute())
    {
        $kids_wk2 = 0;
    }
    else
    {
        $kidCounter_wk2 = $stmt_wk2->fetch(PDO::FETCH_ASSOC);
        $kids_wk2 = $kidCounter_wk2['kc'];
    }

    $free_wk2 = $row['cweektwo'] - $kids_wk2;

    if($free_wk2 > 0)
    {
        $zweiteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-zwei\"/>Zweite Ferienwoche <span style=\"color: green;\">".$free_wk2." freie Pl&auml;tze</span></label>";
    }
    else
    {
        $zweiteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-zwei\" disabled=\"disabled\"/><span style=\"text-decoration: line-through;\">Zweite Ferienwoche</span> <span style=\"color: red;\">AUSGEBUCHT</span></label>";
    }


    // ##### Berechne freie Plätze der Woche DREI #####
    $stmt_wk3 = $dbh->prepare("SELECT sum(ckidcounter) as kc FROM ore_reservations WHERE cweekthree = 1 and coreid = :oreid");
    $stmt_wk3->bindParam(':oreid', $row['cid']);
    if(!$stmt_wk3->execute())
    {
        $kids_wk3 = 0;
    }
    else
    {
        $kidCounter_wk3 = $stmt_wk3->fetch(PDO::FETCH_ASSOC);
        $kids_wk3 = $kidCounter_wk3['kc'];
    }

    $free_wk3 = $row['cweekthree'] - $kids_wk3;

    if($free_wk3 > 0)
    {
        $dritteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-drei\"/>Dritte Ferienwoche <span style=\"color: green;\">".$free_wk3." freie Pl&auml;tze</span></label>";
    }
    else
    {
        $dritteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-drei\" disabled=\"disabled\"/><span style=\"text-decoration: line-through;\">Dritte Ferienwoche</span> <span style=\"color: red;\">AUSGEBUCHT</span></label>";
    }


    // ##### Berechne freie Plätze der Woche VIER #####
    $stmt_wk4 = $dbh->prepare("SELECT sum(ckidcounter) as kc FROM ore_reservations WHERE cweekfour = 1 and coreid = :oreid");
    $stmt_wk4->bindParam(':oreid', $row['cid']);
    if(!$stmt_wk4->execute())
    {
        $kids_wk4 = 0;
    }
    else
    {
        $kidCounter_wk4 = $stmt_wk4->fetch(PDO::FETCH_ASSOC);
        $kids_wk4 = $kidCounter_wk4['kc'];
    }

    $free_wk4 = $row['cweekfour'] - $kids_wk4;

    if($free_wk4 > 0)
    {
        $vierteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-vier\"/>Vierte Ferienwoche <span style=\"color: green;\">".$free_wk4." freie Pl&auml;tze</span></label>";
    }
    else
    {
        $vierteWoche = "<label><input type=\"checkbox\" name=\"wochen[]\" value=\"zeitraum-woche-vier\" disabled=\"disabled\"/><span style=\"text-decoration: line-through;\">Vierte Ferienwoche</span> <span style=\"color: red;\">AUSGEBUCHT</span></label>";
    }

?>

<form id="my-form" action="save_reservation.php" method="post">
<input type="hidden" name="oreid" value="<?=$row['cid'];?>"/>
<section name="Zeitraum" id="tabs">
    <div>
        <h1>Zeitraum</h1>
        <p>F&uuml;r welche Ferienwochen, der Sommerferien Rheinland-Pfalz,<br/> m&ouml;chten Sie ihr Kind / ihre Kinder anmleden?</p>
    </div>

    <div>
        <label>Ich m&ouml;chte mein Kind f&uuml;r folgende<br/> Wochen zur Ortsranderholung anmelden:</label>
        <?php
            echo $ersteWoche;
            echo $zweiteWoche;
            echo $dritteWoche;
            echo $vierteWoche;
        ?>
    </div>
</section>

<!-- TAB -->
<section name="Erziehungsberechtigte/r" id="tabs">

    <!-- Heading -->
    <div>
        <h1>Erziehungsberechtigte/r (EZB)</h1>

        <p>Kontaktdaten der EZB</p>
    </div>

    <!-- Text -->
    <div><label>Vorname:</label><input type="text" name="ezb-vorname"/></div>
    <div><label>Name:</label><input type="text" name="ezb-name"/></div>
    <div><label>Stra&szlig;e / Hausnummer:</label><input type="text" name="ezb-strasse"/></div>
    <div><label>PLZ:</label><input type="text" name="ezb-plz"/></div>
    <div><label>Ort:</label><input type="text" name="ezb-ort"/></div>

    <div><label>Telefon:</label><input type="text" name="ezb-tel"/></div>
    <div><label>Telefon (Mobil):</label><input type="text" name="ezb-tel-mobil"/></div>
    <div><label>Telefon (Arbeitsplatz):</label><input type="text" name="ezb-tel-arbeit"/></div>

    <div><label>E-Mail:</label><input type="text" name="ezb-mail"/></div>
</section>
<!-- END TAB -->

<section name="Anzahl Kinder" id="tabs">
    <div>
        <h1>Anzahl Kinder</h1>

        <p>Anzahl der Kinder die Sie anmelden m&ouml;chten</p>
    </div>

    <div>
        <label>Ich m&ouml;chte ...</label>
        <label><input type="radio" name="anz-kinder" class="anz-kinder" value="kinder-anz-eins"/>... ein Kind anmelden</label>
        <label><input type="radio" name="anz-kinder" class="anz-kinder" value="kinder-anz-zwei"/>... zwei Kinder anmelden</label>
        <label><input type="radio" name="anz-kinder" class="anz-kinder" value="kinder-anz-drei"/>... drei Kinder anmelden</label>

        <!--select name="anz-kinder" class="anz-kinder">
            <option value="kinder-anz-eins">ein Kind anmelden</option>
            <option value="kinder-anz-zwei">zwei Kinder anmelden</option>
            <option value="kinder-anz-drei">drei Kinder anmelden</option>
        </select></label-->
    </div>
</section>

<!-- TAB -->
<section name="Kind(er)" id="tabs">
    <div id="kind1">
        <div>
            <h1>1. Kind</h1>

            <p>Daten ihres Kindes</p>
        </div>

        <div><label>Vorname:</label><input type="text" name="kind-eins-vorname"/></div>
        <div><label>Name:</label><input type="text" name="kind-eins-name"/></div>
        <div><label>Geburtsdatum:</label><input type="text" name="kind-eins-geburt" placeholder="z.B.: 16.04.1997"/></div>

        <!-- Checkbox -->
        <div>
            <label>Mein Kind ...</label>
            <label><input type="checkbox" name="kind-eins-eigenschaften[]" value="kind-eins-schwimmer"/>... kann Schwimmen</label>
            <label><input type="checkbox" name="kind-eins-eigenschaften[]" value="kind-eins-hallenbad"/>... darf mit in das
                Hallenbad</label>
            <label><input type="checkbox" name="kind-eins-eigenschaften[]" value="kind-eins-medikamente"/>... ben&ouml;tigt
                Medikamente</label>
            <label><input type="checkbox" name="kind-eins-eigenschaften[]" value="kind-eins-allergie"/>... hat Allergien</label>
        </div>
    </div>
    <div id="kind2">
        <div>
            <h1>2. Kind</h1>

            <p>Daten ihres zweiten Kindes</p>
        </div>

        <div><label>Vorname:</label><input type="text" name="kind-zwei-vorname"/></div>
        <div><label>Name:</label><input type="text" name="kind-zwei-name"/></div>
        <div><label>Geburtsdatum:</label><input type="text" name="kind-zwei-geburt" placeholder="z.B.: 16.04.1997"/></div>

        <!-- Checkbox -->
        <div>
            <label>Mein kind ...</label>
            <label><input type="checkbox" name="kind-zwei-eigenschaften[]" value="kind-zwei-schwimmer"/>... kann Schwimmen</label>
            <label><input type="checkbox" name="kind-zwei-eigenschaften[]" value="kind-zwei-hallenbad"/>... darf mit in das
                Hallenbad</label>
            <label><input type="checkbox" name="kind-zwei-eigenschaften[]" value="kind-zwei-medikamente"/>... ben&ouml;tigt
                Medikamente</label>
            <label><input type="checkbox" name="kind-zwei-eigenschaften[]" value="kind-zwei-allergie"/>... hat Allergien</label>
        </div>
    </div>
    <div id="kind3">
        <div>
            <h1>3. Kind</h1>

            <p>Daten ihres dritten Kindes</p>
        </div>

        <div><label>Vorname:</label><input type="text" name="kind-drei-vorname"/></div>
        <div><label>Name:</label><input type="text" name="kind-drei-name"/></div>
        <div><label>Geburtsdatum:</label><input type="text" name="kind-drei-geburt" placeholder="z.B.: 16.04.1997"/></div>

        <!-- Checkbox -->
        <div>
            <label>Mein kind ...</label>
            <label><input type="checkbox" name="kind-drei-eigenschaften[]" value="kind-drei-schwimmer"/>... kann Schwimmen</label>
            <label><input type="checkbox" name="kind-drei-eigenschaften[]" value="kind-drei-hallenbad"/>... darf mit in das Hallenbad</label>
            <label><input type="checkbox" name="kind-drei-eigenschaften[]" value="kind-drei-medikamente"/>... ben&ouml;tigt Medikamente</label>
            <label><input type="checkbox" name="kind-drei-eigenschaften[]" value="kind-drei-allergie"/>... hat Allergien</label>
        </div>
    </div>
</section>
<!-- END TAB -->

<section name="Abholberechtigte" id="tabs">
    <div>
        <h3>Abholung</h3>

        <p>Wird Ihr Kind abgeholt oder darf es alleine nach Hause</p>
    </div>

    <div>
        <label>Mein Kind...</label>
        <label><input type="radio" name="abhol" value="abhol-alleine"/>... darf alleine nach Hause</label>
        <label><input type="radio" name="abhol" value="abhol-person"/>... wird von einer der untenstehenden Personen
            abgeholt</label>
    </div>

    <div>
        <h1>Abholberechtigte</h1>

        <p>Bitte die Namen (Vor- und Nachname) der zur Abholung berechtigten Personen angeben</p>
    </div>

    <div>
        <div><label>Person 1:</label><input type="text" name="abholer-eins"/></div>
    </div>
    <div>
        <div><label>Person 2:</label><input type="text" name="abholer-zwei"/></div>
    </div>
    <div>
        <div><label>Person 3:</label><input type="text" name="abholer-drei"/></div>
    </div>
    <div>
        <div><label>Person 4:</label><input type="text" name="abholer-vier"/></div>
    </div>
    <div>
        <div><label>Person 5:</label><input type="text" name="abholer-fuenf"/></div>
    </div>
</section>

<section name="Hinweis" id="tabs" class="hinweis">
    <div>
        <h3>Hinweis</h3>

        <p>An dieser Stelle m&ouml;chten wir Sie noch einmal darauf hinweisen,<br/>
        dass Sie mit dem Absenden dieses Formulars <strong>nur eine Reservierung</strong> erhalten,<br/>
        die f&uuml;r die n&auml;chsten <strong>10 Tage</strong> g&uuml;ltig ist.<br/>
        Um den Anmeldevorgang abzuschlie&szlig;en m&uuml;ssen Sie den auf der folgenden<br/>
        Seite ersichtlichen Gesamtbetrag innerhalb der n&auml;chsten 10 Tagen &uuml;berweisen.</p>
    </div>

    <div>
        <h1>Sonstiges</h1>

        <p>
        </p>
    </div>
    <div>
        <label>
            Sie m&ouml;chten uns noch etwas mitteilen?<br/>
            Hier haben Sie die M&ouml;glichkeit:</label>
        </label>
        <textarea autocomplete="off" id="message" name="message" cols="70" rows="10"></textarea>
    </div>
</section>

<!-- Separator -->
<div>
    <hr/>
</div>

<!-- Buttons -->
<div>
    <!--button id="reset" type="button">Formular zur&uumlcksetzen</button-->
    <button type="submit" id="button-senden">Reservierung senden</button>
    <button type="button" id="button-weiter">Weiter</button>
</div>

<!-- Scripts -->
<script type="text/javascript" src="jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="jquery/idealforms/jquery.idealforms.min.js"></script>
<script type="text/javascript" src="jquery/ui/jquery-ui.js"></script>
<!--[if lt IE 9]>
<script src="dist/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript">
    $( ".ui-datepicker-div" ).datepicker( $.datepicker.regional[ "fr" ] );

    $(document).ready(function () {
        $('#kind2').hide();
        $('input[name="kind-zwei-name"]').addClass('hidemyass');
        $myform.toggleFields(['kind-zwei-vorname', 'kind-zwei-name', 'kind-zwei-geburt', 'kind-zwei-eigenschaften[]'])

        $('#kind3').hide();
        $('input[name="kind-drei-name"]').addClass('hidemyass');
        $myform.toggleFields(['kind-drei-vorname', 'kind-drei-name', 'kind-drei-geburt', 'kind-drei-eigenschaften[]'])
    });

    $('.anz-kinder').change(function() {


        if($(this).val() == 'kinder-anz-zwei')
        {
            $('#kind2').show();
            if($('input[name="kind-zwei-name"]').hasClass('hidemyass'))
            {
                $('input[name="kind-zwei-name"]').removeClass('hidemyass');
                $myform.toggleFields(['kind-zwei-vorname', 'kind-zwei-name', 'kind-zwei-geburt', 'kind-zwei-eigenschaften[]'])
            }


            $('#kind3').hide();
            if(!$('input[name="kind-drei-name"]').hasClass('hidemyass'))
            {
                $('input[name="kind-drei-name"]').addClass('hidemyass');
                $myform.toggleFields(['kind-drei-vorname', 'kind-drei-name', 'kind-drei-geburt', 'kind-drei-eigenschaften[]'])
            }
        }

        if($(this).val() == 'kinder-anz-drei')
        {
            $('#kind2').show();
            if($('input[name="kind-zwei-name"]').hasClass('hidemyass'))
            {
                $('input[name="kind-zwei-name"]').removeClass('hidemyass');
                $myform.toggleFields(['kind-zwei-vorname', 'kind-zwei-name', 'kind-zwei-geburt', 'kind-zwei-eigenschaften[]'])
            }

            $('#kind3').show();
            if($('input[name="kind-drei-name"]').hasClass('hidemyass'))
            {
                $('input[name="kind-drei-name"]').removeClass('hidemyass');
                $myform.toggleFields(['kind-drei-vorname', 'kind-drei-name', 'kind-drei-geburt', 'kind-drei-eigenschaften[]'])
            }
        }

        if($(this).val() == 'kinder-anz-eins')
        {
            $('#kind2').hide();
            if(!$('input[name="kind-zwei-name"]').hasClass('hidemyass'))
            {
                $('input[name="kind-zwei-name"]').addClass('hidemyass');
                $myform.toggleFields(['kind-zwei-vorname', 'kind-zwei-name', 'kind-zwei-geburt', 'kind-zwei-eigenschaften[]'])
            }

            $('#kind3').hide();
            if(!$('input[name="kind-drei-name"]').hasClass('hidemyass'))
            {
                $('input[name="kind-drei-name"]').addClass('hidemyass');
                $myform.toggleFields(['kind-drei-vorname', 'kind-drei-name', 'kind-drei-geburt', 'kind-drei-eigenschaften[]'])
            }
        }
    });

    $(document).ready(function () {
        $('#button-senden').hide();
    });

    $('.ideal-tabs-wrap li').on('click', function() {
        var tabIndex = $(this).index();
        if(tabIndex == 5)
        {
            $('#button-senden').show();
            $('#button-weiter').hide();
        }
        else
        {
            $('#button-senden').hide();
            $('#button-weiter').show();
        }
    });

    $('#button-weiter').click(function () {
        if($('#button-senden').is(":visible"))
        {
            $('#button-weiter').hide();
        }
    });


</script>
</form>
</div>
<div class="cleaner_h40"></div>
<div class="content_section">
</div>
</div>
<!-- end of content -->
<div class="cleaner"></div>
</div>
<div id="content_wrapper_bottom"></div>
<!-- end of content_wrapper -->
<div id="footer">
    Copyright &copy; <?=date('Y');?> <a href="http://jugendtreff.mutterstadt.de">Jugendtreff Mutterstadt</a> | Umsetzung durch den <a href="http://foerderverein-juzmu.de">F&oumlrderverein des Jugendtreff Mutterstadt</a> | Designed by <a href="http://www.templatemo.com/">Free CSS Templates</a></div>
<!-- end of footer -->
</body>
</html>
