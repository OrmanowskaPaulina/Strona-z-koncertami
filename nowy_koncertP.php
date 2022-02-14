<html>
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
            $wykonawca = $_POST["wykonawca"];
            $miejsce = $_POST["miejsce"];
            $rodzajmuzyki = $_POST["rodzaj"];
            $data = $_POST["dataK"];
            $bilet = $_POST["selectB"];
            $festiwal = $_POST["selectF"];
            $link = $_POST["linkW"];
            $autor = $_GET['idAu'];

            $sql = "INSERT INTO koncerty (idWykonawcy, data, idMiejsca, idRodzaju, czyBiletowany, festiwal, szczegoly, idAutora)   
                    VALUES ($wykonawca, '$data', $miejsce, $rodzajmuzyki , $bilet, $festiwal, '$link' , $autor)";

            if (mysqli_query($conn, $sql)) {
                echo "Dodano koncert!";
                header("Location: artystaU.php?id={$wykonawca}&idAu={$_GET['idAu']}");
            } 
            else {
                echo "Błąd podczas dodawania koncertu: " . $sql . "<br>" . mysqli_error($conn);
            }

        mysqli_close($conn);
    ?> 
<br>
</center>
</body>
</html> 