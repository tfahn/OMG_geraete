<?php
if (isset($_POST['hinzugefugt'])){
    $howmuch = runSQL("SELECT * FROM geraete WHERE ID = '$_POST[ID]'");
    $data = mysqli_fetch_array($howmuch, MYSQLI_NUM);
    if($data[0] > 1){
        if($_POST['selectoroverride'] == 'add'){
            $problems = runSQL("SELECT Probleme FROM geraete WHERE ID = '$_POST[ID]' ");
            runSQL("UPDATE geraete SET Probleme = '$problems . $_POST[problem]' WHERE ID = '$_POST[ID]' ");
            echo("<div id=\"content\">");
            echo ("<p>Es wurde ein Geräte-Defekt hinzugefügt</p>");
            echo ("Weiterleitung...");
            echo("<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">");
            echo("</div>");
        }else{
            runSQL("UPDATE geraete SET Probleme = '$_POST[problem]' WHERE ID = '$_POST[ID]' ");
            echo("<div id=\"content\">");
            echo ("<p>Es wurde ein Geräte-Defekt hinzugefügt</p>");
            echo ("Weiterleitung...");
            echo("<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">");
            echo("</div>");
        }

    }else{
        echo("<div id=\"content\">");
        echo("<p>Es gibt kein Gerät mit dieser ID</p>");
        echo ("Weiterleitung...");
        echo("<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">");
        echo("</div>");
    }

}else{
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Gerät defekt hinzufügen</title>
    </head>
    <body>
    <h1>Geräte-Defekt hinzufügen</h1>
    <form action="index.php" method="post">
        ID:<input type="number" name="ID"><br><br>
        <input type="radio" name="selectoroverride" value="add" checked>Geräte-Defekt zu bestehenden hinzufügen<br><br>
        <input type="radio" name="selectoroverride" value="override">Geräte-Defekte überschreiben und dieses als einziges Geräte-Defekt setzen<br>
        <br>Problem:<input type="text"  name="problem"><br><br> 
        <input type="submit" name="hinzugefugt" value="Bestätigen">
    </form>
    </body>
    </html>
<?php
}