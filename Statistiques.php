<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="./Statistiques2.php" method="POST">
        <fieldset>
            <legend>Statistiques</legend>
            <label for="theme">Theme du sondage</label>
            <select name="theme" id="theme">
                <option value="0" name='id' disabled hidden selected>choisir un theme</option>
                <?php
                $c = mysql_connect("localhost", "root", "");
                $bd = mysql_select_db("bd2019");
                $req = "SELECT NumS,Theme FROM sondage";
                $res = mysql_query($req);
                while ($e = mysql_fetch_array($res))
                    echo ("<option value='$e[0]' name='id'>$e[1]</option>");
                ?>
            </select>
            <input type="submit" value="Editer">
        </fieldset>
    </form>
</body>

</html>