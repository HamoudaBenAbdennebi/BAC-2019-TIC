<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_POST["theme"]))
        $id = $_POST["theme"];
    else
        $id = "";
    $date = date('d-m-Y');
    $c = mysql_connect("localhost", "root", "");
    $bd = mysql_select_db("bd2019");
    $req = "SELECT DateDebut FROM sondage WHERE NumS = $id";
    $res = mysql_query($req);
    $e = mysql_fetch_array($res);
    if ($e[0] < $date)
        echo ("Sondage non encore lancé !");
    else {
        $req2 = "SELECT * FROM reponse WHERE NumS = $id";
        $res2 = mysql_query($req2);
        if (mysql_num_rows($res2) == 0)
            echo ("Aucune participation enregistrée à ce moment");
        else {
            echo ("<h2>Statistiques du sondage</h2>");
            $req3 = "SELECT SUM( NumS ) FROM reponse WHERE numS =$id";
            $res3 = mysql_query($req3);
            $e = mysql_fetch_array($res3);
            echo ("<br>Nombre total des participants au sondage : $e[0]<br>");
            $req4 = "SELECT COUNT(Rep) FROM reponse,participant WHERE reponse.IdParticipant = participant.IdParticipant AND participant.Genre = 'F'";
            $res4 = mysql_query($req4);
            $e2 = mysql_fetch_array($res4);
            echo ("Nombre des femmes : $e2[0]<br>");
            $req5 = "SELECT COUNT(Rep) FROM reponse,participant WHERE reponse.IdParticipant = participant.IdParticipant AND participant.Genre = 'M'";
            $res5 = mysql_query($req5);
            $e3 = mysql_fetch_array($res5);
            echo ("Nombre des hommes : $e3[0]");
    ?>
            <table>
                <tr>
                    <th>N°</th>
                    <th>Question</th>
                    <th>oui</th>
                    <th>non</th>
                    <th>sans avis</th>
                </tr>
                <?php
                $req = "SELECT NumQ , Contenu FROM question WHERE NumS = $id";
                $res = mysql_query($req);
                while ($e = mysql_fetch_array($res)) {
                    $nb = "SELECT COUNT(Rep) FROM reponse WHERE NumS = $id AND NumQ = $e[0]";
                    $nb2 = mysql_query($nb);
                    $n = mysql_fetch_array($nb2);
                    $OUI = "SELECT COUNT(Rep) FROM reponse WHERE NumS = $id AND NumQ = $e[0] AND Rep = 'O'";
                    $O = mysql_query($OUI);
                    $e2 = mysql_fetch_array($O);
                    $NON = "SELECT COUNT(Rep) FROM reponse WHERE NumS = $id AND NumQ = $e[0] AND Rep = 'N'";
                    $N = mysql_query($NON);
                    $e3 = mysql_fetch_array($N);
                    $SANS = "SELECT COUNT(Rep) FROM reponse WHERE NumS = $id AND NumQ = $e[0] AND Rep = 'S'";
                    $S = mysql_query($SANS);
                    $e4 = mysql_fetch_array($S);
                ?>

                    <tr>
                        <td><?php echo ($e[0]) ?></td>
                        <td><?php echo ($e[1]) ?></td>
                        <td><?php echo (intval($e2[0]) * 100 / intval($n[0])) ?></td>
                        <td><?php echo (intval($e3[0]) * 100 / intval($n[0])) ?></td>
                        <td><?php echo (intval($e4[0]) * 100 / intval($n[0])) ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
    <?php
        }
    }
    ?>
</body>

</html>