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
            <a href=zdjecia_artysciU.php?idAu=<?php echo $_GET['idAu']; ?>><b>| WSZYSTKIE |</b></a>
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
            
            echo "<br><br><h2 id=zdjecie>";
            $sql = "SELECT * FROM wykonawca ORDER BY nazwa"; 
            $result = mysqli_query($conn, $sql);  

            if (mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result) ){ 
                    $sql2 = "SELECT * FROM koncerty"; 
                    $result2 = mysqli_query($conn, $sql2);  
                if (mysqli_num_rows($result2) > 0 ){
                    while($row2 = mysqli_fetch_assoc($result2) ){ 
                        if ($row['id'] == $row2['idWykonawcy']){
                            echo "<a href=artystaU.php?id=".$row['id']."&idAu=".$_GET['idAu']."><img class='zdjecie' src=".$row['zdjecie']." alt=".$row['nazwa']." class='zdjecie' title=".$row['nazwa'].">";
                            break;
                            }
                        }
                    } 
                }
            } 
            else {
                echo "<h2><br><br><br><br>brak koncertów :(";
            }
            echo '</h2>';
            
            mysqli_close($conn); 
        ?> 
    </center></body>
</html>
