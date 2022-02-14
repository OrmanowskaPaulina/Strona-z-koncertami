<?php
    session_start();
?>
<html>
<body>
<meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
<center> 
        <header> Wracamy na koncerty!
        <nav>
            <a href=zdjecia_artysciU.php?idAu=<?php echo $_GET['idAu']; ?>>| WSZYSTKIE |</a>
            <a href=ulubione.php?idAu=<?php echo $_GET['idAu']; ?>>| ULUBIONE |</a>
            <a href=nowy_koncert.php?idAu=<?php echo $_GET['idAu']; ?>>| DODAJ KONCERT |</a>
            <a href="wylogowanie.php">| WYLOGUJ SIĘ |</a>
        </nav></header>
    <h1> Edytuj artystę:</h1>
    <br>
        <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "koncertydb";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        echo "<div><form action='edytujArtysteP.php?idAu={$_GET["idAu"]}&idA={$_GET["idA"]}' method='post'>";
        $sql = "SELECT * FROM wykonawca WHERE id ={$_GET['idA']}";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "Wykonawca: <input type='text' name='nazwaW' value='{$row['nazwa']}'><br>
                Link do zdjęcia: <input type='text' name='linkW' value='{$row['zdjecie']}'><br>
                <input type='submit' value='Edytuj artystę'><br>
                </form></div></h1>";
            }
        }
        
    mysqli_close($conn);
    ?> 
    
</center>
</body>
</html> 