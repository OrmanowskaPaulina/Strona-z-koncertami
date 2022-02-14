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
            //$wykonawca = $_POST["wykonawca"];
            //$miejsce = $_POST["miejsce"];
            //$rodzajmuzyki = $_POST["rodzaj"];
            $data = $_POST["dataK"];
            $bilet = $_POST["selectB"];
            $festiwal = $_POST["selectF"];
            $link = $_POST["linkW"];

            $sql = "UPDATE koncerty SET data = '$data', czyBiletowany = $bilet, festiwal = $festiwal, szczegoly = '$link' WHERE id={$_GET['idK']}";

            if (mysqli_query($conn, $sql)) {
                echo "Edytowano koncert!";
                header("Location: koncert_szczegolowoU.php?idA={$_GET['idA']}&idK={$_GET['idK']}&idAu={$_GET['idAu']}");
            } 
            else {
                echo "Błąd podczas edytowania koncertu: " . $sql . "<br>" . mysqli_error($conn);
            }

        mysqli_close($conn);
    ?> 
<br>
</center>
</body>
</html> 