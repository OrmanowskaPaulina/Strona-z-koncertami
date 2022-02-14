<html>
    <head>
    <meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
    <title>Koncerty</title>
    </head>
    <body><center>
        <header> Wracamy na koncerty!
        <nav>
            <a href="zdjecia_artysci.php">| WSZYSTKIE |</a>
            <a href="nowy_uzytkownik.php">| REJESTRACJA |</a>
            <a href="index.php">| ZALOGUJ SIĘ |</a>
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
                                        echo "<br><br><h1>".$row2['nazwa']."</h1>";
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
        
        $sql5 = "SELECT * FROM komentarze WHERE idKoncertu = {$_GET['idK']}"; 
        $result5 = mysqli_query($conn, $sql5);
        if (mysqli_num_rows($result5) > 0) {
            while($row5 = mysqli_fetch_assoc($result5)) {
                    $sql6 = "SELECT login FROM uzytkownicy WHERE id =".$row5['idAutora']; 
                    $result6 = mysqli_query($conn, $sql6);
                    if (mysqli_num_rows($result6) > 0) {
                        while($row6 = mysqli_fetch_assoc($result6)) {
                            echo "<div> autor:   ".$row6["login"]."   data:   ".date("d.m.y ", strtotime($row5["data"]))."<br>"; 
                            echo "<p class='komentarz'><b>".$row5["tresc"]."</b></p>";
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

