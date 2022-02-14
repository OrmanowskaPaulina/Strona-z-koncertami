<?php
    session_start();
?>
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
    <title>Koncerty</title>
    </head>
    <body><center>
        <header> Wracamy na koncerty!
        <nav>
            <a href=zdjecia_artysciU.php?idAu=<?php echo $_GET['idAu']; ?>>| WSZYSTKIE |</a>
            <a href=ulubione.php?idAu=<?php echo $_GET['idAu']; ?>>| ULUBIONE |</a>
            <a href=nowy_koncert.php?idAu=<?php echo $_GET['idAu']; ?>>| DODAJ KONCERT |</a>
            <a href="wylogowanie.php">| WYLOGUJ SIĘ |</a>
        </nav></header>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "koncertydb";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql0 = "SELECT * FROM uzytkonicy_koncerty WHERE idKoncertu={$_GET['idK']} &&idUzytkownika={$_GET['idAu']}";
        $result0 = mysqli_query($conn, $sql0);
        if (mysqli_num_rows($result0) > 0) {
            while($row0 = mysqli_fetch_assoc($result0)) {
                if (true){
                    echo "<br><br><a href='ulubione_usun.php?idA={$_GET['idA']}&idAu={$_GET['idAu']}&idK={$_GET['idK']}'><img class='ulubione' src='serce_pelne.png' title='Usuń z ulubionych'></a>";
                }
                else{
                    echo "<br><br><a href='ulubione_dodaj.php?idA={$_GET['idA']}&idAu={$_GET['idAu']}&idK={$_GET['idK']}'><img class='ulubione' src='serce_puste.png' title='Dodaj do ulubionych'></a>";
                }
            }
        }
        else{
            echo "<br><br><a href='ulubione_dodaj.php?idA={$_GET['idA']}&idAu={$_GET['idAu']}&idK={$_GET['idK']}'><img class='ulubione' src='serce_puste.png' title='Dodaj do ulubionych'></a>";
        }
        
        $idK = $_GET['idK'];
                
        $sql = "SELECT * FROM koncerty WHERE id = {$_GET['idK']}";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $idMiejsca = $row['idMiejsca'];
                $sql2 = "SELECT * FROM wykonawca WHERE id = {$_GET['idA']}";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    while($row2 = mysqli_fetch_assoc($result2)) {
                        $sql3 = "SELECT nazwa FROM rodzaj WHERE id =".$row['idRodzaju'];
                        $result3 = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($result3) > 0) {
                            while($row3 = mysqli_fetch_assoc($result3)) {
                                $sql4 = "SELECT nazwa FROM miejsce WHERE id = $idMiejsca";
                                $result4 = mysqli_query($conn, $sql4);
                                if (mysqli_num_rows($result4) > 0) { 
                                    while($row4 = mysqli_fetch_assoc($result4)) {
                                        echo "<h1>".$row2['nazwa']."</h1>";
                                        echo "<img src=".$row2['zdjecie']." alt=".$row2['nazwa']." class='zdjecie' title=".$row2['nazwa']."><br>";
                                        $dataK = $row['data'];
                                        echo date("d/m/Y", strtotime($dataK))."<br>";
                                        echo "<h3>Miejsce: ".$row4['nazwa']."<br>";
                                        if ($row['czyBiletowany'] == 0){
                                            echo "Wstęp: wolny<br>";
                                        }
                                        else{
                                            echo "Wstęp: odpłatny<br>";
                                        }
                                        if ($row['festiwal'] == 0){
                                            echo "Festiwal: nie <br>";
                                        }
                                        else{
                                            echo "Festiwal: tak <br>";
                                        }
                                        echo "Rodzaj muzyki: ".$row3['nazwa']."<br>";
                                        echo "Szczegółowe informacje pod linkiem: <a href=".$row['szczegoly']."><br>LINK</a><br>";
                                        echo "</h3><br>";
                                        
                                        if (strcasecmp($_GET['idAu'], $row['idAutora']) ==0){
                                            echo "<a href='edytujPost.php?idA={$_GET["idA"]}&idAu={$_GET['idAu']}&idK={$_GET['idK']}'>|Edytuj koncert|</a><br><a href='usunPostP.php?idA={$_GET["idA"]}&idAu={$_GET['idAu']}&idK={$_GET['idK']}'>|Usuń koncert|</a><br><br>";
                                        }
                                    }
                                } 
                            }
                        } 
                    }
                }
            }
        } 
        else {
          echo "brak informacji na temat koncertu";
        }


        echo "<div> Skomentuj koncert: 
                <form action='dodajKomentarz.php?idAu={$_GET['idAu']}&idK={$_GET['idK']}&idA={$_GET['idA']}' method='post'>
                Treść: <input type='text' name='tresc'><br><br>
                <input type='hidden' name='idK' value='{$idK}'>
                <input type='hidden' name='idAutora' value='{$_GET['idAu']}'>  
                <input type='submit' value='Skomentuj'>
              </form></div><br><br>"; 
                
        $sql5 = "SELECT * FROM komentarze WHERE idKoncertu = {$idK}"; 
        $result5 = mysqli_query($conn, $sql5);
        if (mysqli_num_rows($result5) > 0) {
            while($row5 = mysqli_fetch_assoc($result5)) {
                    $sql6 = "SELECT login FROM uzytkownicy WHERE id =".$row5['idAutora']; 
                    $result6 = mysqli_query($conn, $sql6);
                    if (mysqli_num_rows($result6) > 0) {
                        while($row6 = mysqli_fetch_assoc($result6)) {
                            echo "<div>";
                            if (strcasecmp($_GET['idAu'], $row5['idAutora']) ==0){
                                echo "<a class='del' href='usunKomentarz.php?idK={$_GET["idK"]}&idAu={$_GET['idAu']}&idA={$_GET['idA']}'><img src='delete.png' title='Usuń komentarz' style='margin-top:5px; margin-right:-330px;'></a><br>";

                            }
                            echo "autor:   ".$row6["login"]."   data:   ".date("d.m.y", strtotime($row5["data"]))."<br>"; 
                            echo "<p class='komentarz'>   " . $row5["tresc"]. "</p>";
                            echo "</div><br>";
                        }
                    }
            }
        } 
        else {
          echo "0 komentarzy";
        }
        
            mysqli_close($conn); 
        ?> 
    </center></body>
</html>
