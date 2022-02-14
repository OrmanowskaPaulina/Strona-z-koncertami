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
            
            $nazwa = $_POST["nazwaA"];
            $link = $_POST["linkA"];

            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO wykonawca (nazwa, zdjecie) VALUES ('$nazwa','$link')";

            if (mysqli_query($conn, $sql)) {
              echo "Dodano artystę!";
              header("Location: nowy_koncert.php?idAu={$_GET['idAu']}");
              
            } 
            else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);

    ?> 
<br>
</center>
</body>
</html> 