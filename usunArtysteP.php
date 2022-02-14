<html>
<body>
<meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
<center> 

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "koncertydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $idA = $_GET['idA'];
        $sql = "DELETE FROM wykonawca WHERE id = {$idA}"; 

        if ($conn->query($sql) === TRUE) {
            echo "Usunięto artystę!<br>";
            header("Location: zdjecia_artysciU.php?idAu={$_GET['idAu']}");
        } 
        else {
            echo "Błąd: " . $conn->error;
        }
        
    $conn->close();
    ?>
</center>
</body>
</html> 