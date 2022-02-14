<?php
    session_start();
?>
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#kalendarz").click(function(){
                $("#data").load("dzis_data.php");
                });
        });
    </script>
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
        
        $sql2 = "SELECT * FROM wykonawca WHERE id = {$_GET['id']}";
        $result2 = mysqli_query($conn, $sql2);
        
        echo "<br><br><a><img id='kalendarz' src='kalendarz.png' alt='Kalendarz' width='30'></a><br><a id='data'></a>";
        
        if (mysqli_num_rows($result2) > 0) {
            while($row = mysqli_fetch_assoc($result2)) {
                echo "<h1>".$row['nazwa']."</h1>";
                if (strcasecmp($_GET['idAu'], $row['idAutora']) == 0){
                    echo "<a href='edytujArtyste.php?idA={$_GET["id"]}&idAu={$_GET['idAu']}'>|Edytuj artystę|</a><br><a href='usunArtysteP.php?idA={$_GET["id"]}&idAu={$_GET['idAu']}'>|Usuń artystę|</a><br><br>";
                    }
            }
        } 
        else {
          echo "0 results";
        }
        
        $idArtysty = $_GET['id'];
        $sql = "SELECT * FROM koncerty WHERE idWykonawcy = $idArtysty ORDER BY data";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $idMiejsca = $row['idMiejsca'];
                $sql3 = "SELECT * FROM miejsce WHERE id = $idMiejsca";
                $result3 = mysqli_query($conn, $sql3);
                if (mysqli_num_rows($result3) > 0) {
                    while($row3 = mysqli_fetch_assoc($result3)) {
                        echo "<div>".$row3['nazwa']." ";
                        $dataK = $row['data'];
                        echo date("d/m/Y", strtotime($dataK))."<br>";
                        echo "<a class=link href='koncert_szczegolowoU.php?idA={$_GET["id"]}&idK=".$row["id"]."&idAu=".$_GET['idAu']."'>Szczegóły</a><br>";
                        echo "</div><br>";
                    }
                } 
            }
        } 
        else {
          echo "nie ma nadchodzących koncertów";
        }

            mysqli_close($conn); 
        ?> 
    </center></body>
</html>
