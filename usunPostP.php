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
        $idK = $_GET["idK"];

        $sql = "DELETE FROM koncerty WHERE id = {$idK}"; 

        if ($conn->query($sql) === TRUE) {
            echo "Usunięto koncert!<br>";
            header("Location: artystaU.php?id={$_GET['idA']}&idAu={$_GET['idAu']}");
        } 
        else {
            echo "Błąd: " . $conn->error;
        }
        
    $conn->close();
    ?>
</center>
</body>
</html> 