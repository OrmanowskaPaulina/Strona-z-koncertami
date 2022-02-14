
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
        <title></title>
    </head>
    <body><center>
        <header> Wracamy na koncerty!
        <nav>
            <a href=zdjecia_artysciU.php?idAu=<?php echo $_GET['idAu']; ?>>| WSZYSTKIE |</a>
            <a href=ulubione.php?idAu=<?php echo $_GET['idAu']; ?>>| ULUBIONE |</a>
            <a href=nowy_koncert.php?idAu=<?php echo $_GET['idAu']; ?>><b>| DODAJ KONCERT |</b></a>
            <a href="wylogowanie.php">| WYLOGUJ SIĘ |</a>
        </nav></header>
        <h1> Dodaj nowy koncert:
            <div><form action="nowy_koncertP.php?idAu=<?php echo $_GET['idAu'];?>" method="post">
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "koncertydb";

                $conn = mysqli_connect($servername, $username, $password, $dbname);
                
                echo 'Wykonawca: <select name="wykonawca">';

                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM wykonawca";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                    }
                }
                    
                echo '</select><br>';
                echo "<a class='artysta'>nie ma artysty, którego koncert chcesz dodać?</a><br>
                      <a class='artystalink' href=nowy_artysta.php?idAu={$_GET["idAu"]}> KLIKNIJ TUTAJ :)</a><br>";
                echo 'Miejsce: <select name="miejsce">';
                
                $sql = "SELECT * FROM miejsce";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                    }
                }
                
                echo '</select><br>';
                echo 'Data: 
                    <input type="date" name="dataK"><br>
                Rodzaj muzyki:<select name="rodzaj">';
                $sql = "SELECT * FROM rodzaj";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<option value='.$row["id"].'>'.$row["nazwa"].'</option>';
                    }
                }
                echo '</select>';
                ?>
                <br>czy biletowany:<select name="selectB"><option value="1">Tak</option> <option value="0">Nie</option></select><br>
                czy festiwal:<select name="selectF"><option value="1">Tak</option> <option value="0">Nie</option></select><br>
                Link do wydarzenia:<input type="text" name="linkW" ><br>
            <br><br><input type="submit" value="Dodaj nowy koncert"><br>
            </form></div></h1>
    </center></body>
</html>
