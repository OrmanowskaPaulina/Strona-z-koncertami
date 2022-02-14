
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
    <title>Koncerty</title>
    </head>
    <body><center>
        <header> Wracamy na koncerty!
        <nav>
            <a href=zdjecia_artysciU.php?idAu=<?php echo $_GET['idAu']; ?>>| WSZYSTKIE |</a>
            <a href=ulubione.php?idAu=<?php echo $_GET['idAu']; ?>><b>| ULUBIONE |</b></a>
            <a href=nowy_koncert.php?idAu=<?php echo $_GET['idAu']; ?>>| DODAJ KONCERT |</a>
            <a href="wylogowanie.php">| WYLOGUJ SIĘ |</a>
        </nav></header>
        <h1> Ulubione koncerty:</h1>
        <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "koncertydb";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM uzytkonicy_koncerty WHERE idUzytkownika = {$_GET['idAu']}"; 
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $sql2 = "SELECT * FROM koncerty WHERE id={$row['idKoncertu']} ORDER BY data"; 
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    while($row2 = mysqli_fetch_assoc($result2)) {
                        $sql3 = "SELECT * FROM wykonawca WHERE id =".$row2['idWykonawcy']; 
                        $result3 = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($result3) > 0) {
                            while($row3 = mysqli_fetch_assoc($result3)) {
                                    /*$sql0 = "SELECT * FROM uzytkonicy_koncerty WHERE idKoncertu={$row['idKoncertu']} &&idUzytkownika={$_GET['idAu']}";
                                    $result0 = mysqli_query($conn, $sql0);
                                    if (mysqli_num_rows($result0) > 0) {
                                        while($row0 = mysqli_fetch_assoc($result0)) {
                                            if (true){
                                                echo "<div><a href='ulubione_usun.php?idAu={$_GET['idAu']}&idK={$row['idKoncertu']}'><img class='ulubione' src='serce_pelne.png' title='Usuń z ulubionych'></a>";
                                            }
                                            else{
                                                echo "<div><a href='ulubione_dodaj.php?idAu={$_GET['idAu']}&idK={$row['idKoncertu']}'><img class='ulubione' src='serce_puste.png' title='Dodaj do ulubionych'></a>"; 
                                                
                                                }
                                        }
                                    }
                                    else{
                                        echo "<div><a href='ulubione_dodaj.php?idAu={$_GET['idAu']}&idK={$row['idKoncertu']}'><img class='ulubione' src='serce_puste.png' title='Dodaj do ulubionych'></a>";
                                    }*/
                                echo "<div>".$row3['nazwa']." ";
                                $dataK = $row2['data'];
                                echo date("d/m/Y", strtotime($dataK))."<br>";
                                echo "<a class=link href='koncert_szczegolowoU.php?idA={$row2['idWykonawcy']}&idK={$row['idKoncertu']}&idAu={$_GET['idAu']}'>Szczegóły</a><br>";
                                echo "</div><br>";
                            }
                        }
                    }
                }
            }
        } 
        else {
          echo "0 ulubionych koncertów";
        }
        mysqli_close($conn); 
        ?>
    </center></body>
</html>
