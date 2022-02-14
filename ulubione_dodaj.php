<html> <title>Koncerty</title>
<body>
<meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
<center> 
    
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "koncertydb";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO uzytkonicy_koncerty (idUzytkownika, idKoncertu) VALUES ({$_GET['idAu']},{$_GET['idK']})";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: koncert_szczegolowoU.php?idA={$_GET['idA']}&idK={$_GET['idK']}&idAu={$_GET['idAu']}");
        } 
        else {
          echo "Błąd: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);


    ?> 
<br>
</center>
</body>
</html> 