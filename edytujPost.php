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
    <h1> Edytuj koncert:</h1>
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
        echo "<div><form action='edytujPostP.php?idAu={$_GET["idAu"]}&idK={$_GET["idK"]}&idA={$_GET["idA"]}' method='post'>";
        echo "Wykonawca: "; //<select name='wykonawca'>"; //moze nie zmieniac
                
        $sql = "SELECT * FROM wykonawca WHERE id ={$_GET['idA']}";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                //echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                echo $row["nazwa"];
            }
        }

        //echo '</select><br>
        //echo 'Miejsce: <select name="miejsce"><br>';

        $sql = "SELECT * FROM koncerty WHERE id={$_GET['idK']}";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                //echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                $sql1 = "SELECT nazwa FROM rodzaj WHERE id={$row['idRodzaju']}";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while($row1 = mysqli_fetch_assoc($result1)) {
                            //echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                    $sql2 = "SELECT nazwa FROM miejsce WHERE id={$row['idMiejsca']}";
                    $result2 = mysqli_query($conn, $sql2);
                    if (mysqli_num_rows($result2) > 0) {
                        while($row2 = mysqli_fetch_assoc($result2)) {
                            //echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                            echo '<br>Miejsce: '.$row2["nazwa"].'<br>';
                            echo 'Data: 
                            <input type="date" name="dataK"><br>
                            Rodzaj muzyki: '.$row1["nazwa"].'<br>';
                        }
                    }
                }
            }
        }
    }

        /*echo '</select><br>';

        Rodzaj muzyki:<select name="rodzaj">'; //moze nie zmieniac
        $sql = "SELECT * FROM rodzaj";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
            }
        }
        echo '</select>';*/
        
        $sql = "SELECT * FROM koncerty WHERE id = {$_GET['idK']}";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo 'czy biletowany:<select name="selectB" value='.$row['czyBiletowany'].'><option value="1">Tak</option> <option value="0">Nie</option></select><br>
                czy festiwal:<select name="selectF" value='.$row['festiwal'].'><option value="1">Tak</option> <option value="0">Nie</option></select><br>
                Link do wydarzenia:<input type="text" name="linkW" value='.$row['szczegoly'].'><br>
            <input type="submit" value="Edytuj koncert"><br>
            </form></div></h1>';
            }
        } 

    mysqli_close($conn);
    ?> 
    
</center>
</body>
</html> 