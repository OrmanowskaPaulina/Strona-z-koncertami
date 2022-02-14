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

        $idArtysty = $_GET["idA"];
        $idAutora = $_POST["idAutora"];
        $tresc = $_POST["tresc"];
        $idKoncertu = $_POST["idK"];

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO komentarze (idAutora, tresc, idKoncertu) VALUES ($idAutora,'$tresc',$idKoncertu)";

        if (mysqli_query($conn, $sql)) {
            echo "Dodano komentarz!";
            header("Location: koncert_szczegolowoU.php?idA={$idArtysty}&idK={$idKoncertu}&idAu={$idAutora}");
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