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
    if (isset($_POST["mail"]) && isset($_POST["mdp"]) && isset($_POST["Genre"]) && isset($_POST["A"]) && isset($_POST["B"]) && isset($_POST["C"])) {
        $mail = $_POST["mail"];
        $mdp = $_POST["mdp"];
        $Genre = $_POST["Genre"];
        $A = $_POST["A"];
        $B = $_POST["B"];
        $C = $_POST["C"];
    } else {
        $mail = "";
        $mdp = "";
        $Genre = "";
        $A = "";
        $B = "";
        $C = "";
    }
    $c = mysql_connect("localhost", "root", "");
    $bd = mysql_select_db("bd2019");
    $req = "SELECT * FROM participant WHERE Mail = '$mail'";
    $res = mysql_query($req);
    if (mysql_num_rows($res) > 0) {
        $req2 = "SELECT * FROM participant WHERE Mail = '$mail' and Mdp != '$mdp' ";
        $res2 = mysql_query($req2);
        if (mysql_num_rows($res2) > 0)
            echo ("Erreur d'authentification");
        else {
            $req3 = "SELECT IdParticipant FROM participant WHERE Mail = '$mail' and Mdp = '$mdp' ";
            $res3 = mysql_query($req3);
            $e = mysql_fetch_array($res3);
            $IdParticipant = $e[0];
            $subreq4 = "SELECT * FROM reponse WHERE NumQ = '1' and NumS = '1' and IdParticipant = '$IdParticipant'  ";
            $subres4 = mysql_query($subreq4);
            if (mysql_num_rows($subres4) > 0) {
                $del = "DELETE FROM `bd2019`.`reponse` WHERE `reponse`.`NumQ` = 1 AND `reponse`.`NumS` = 1 AND `reponse`.`IdParticipant` = $IdParticipant";
                $resdel = mysql_query($del);
            }

            $req4 = "INSERT INTO `bd2019`.`reponse` (`NumQ`, `NumS`, `IdParticipant`, `Rep`) VALUES ('1', '1', '$IdParticipant', '$A');";
            $subreq5 = "SELECT * FROM reponse WHERE NumQ = '2' and NumS = '1' and IdParticipant = '$IdParticipant' ";
            $subres5 = mysql_query($subreq5);
            if (mysql_num_rows($subres5) > 0) {
                $del2 = "DELETE FROM `bd2019`.`reponse` WHERE `reponse`.`NumQ` = 2 AND `reponse`.`NumS` = 1 AND `reponse`.`IdParticipant` = $IdParticipant";
                $resdel2 = mysql_query($del2);
            }
            $req5 = "INSERT INTO `bd2019`.`reponse` (`NumQ`, `NumS`, `IdParticipant`, `Rep`) VALUES ('2', '1', '$IdParticipant', '$B');";
            $subreq6 = "SELECT * FROM reponse WHERE NumQ = '3' and NumS = '1' and IdParticipant = '$IdParticipant'  ";
            $subres6 = mysql_query($subreq6);
            if (mysql_num_rows($subres6) > 0) {
                $del3 = "DELETE FROM `bd2019`.`reponse` WHERE `reponse`.`NumQ` = 3 AND `reponse`.`NumS` = 1 AND `reponse`.`IdParticipant` = $IdParticipant";
                $resdel3 = mysql_query($del3);
            }
            $req6 = "INSERT INTO `bd2019`.`reponse` (`NumQ`, `NumS`, `IdParticipant`, `Rep`) VALUES ('3', '1', '$IdParticipant', '$C');";
            $res4  = mysql_query($req4);
            $res5  = mysql_query($req5);
            $res6  = mysql_query($req6);
        }
    } else {
        $req1 = "INSERT INTO `bd2019`.`participant` (`IdParticipant`, `Mail`, `Mdp`, `Genre`) VALUES (NULL, '$mail', '$mdp', '$Genre');";
        $res1 = mysql_query($req1);
        $req3 = "SELECT IdParticipant FROM participant WHERE Mail = '$mail' and Mdp = '$mdp' ";
        $res3 = mysql_query($req3);
        $e = mysql_fetch_array($res3);
        $IdParticipant = $e[0];
        $req4 = "INSERT INTO reponse (NumQ, NumS, IdParticipant, Rep) VALUES ('1', '1', '$IdParticipant', '$A');";
        $req5 = "INSERT INTO reponse (NumQ, NumS, IdParticipant, Rep) VALUES ('2', '1', '$IdParticipant', '$B');";
        $req6 = "INSERT INTO reponse (NumQ, NumS, IdParticipant, Rep) VALUES ('3', '1', '$IdParticipant', '$C');";
        $res4  = mysql_query($req4);
        $res5  = mysql_query($req5);
        $res6  = mysql_query($req6);
    }

    ?>
</body>

</html>