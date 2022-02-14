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
            $nazwa= $_POST["nazwaW"];
            $link = $_POST["linkW"];

            $sql = "UPDATE wykonawca SET nazwa = '$nazwa', zdjecie = '$link' WHERE id={$_GET['idA']}";

            if (mysqli_query($conn, $sql)) {
                echo "Edytowano artystę!";
                header("Location: artystaU.php?id={$_GET['idA']}&idAu={$_GET['idAu']}");
            } 
            else {
                echo "Błąd podczas edytowania artysty: " . $sql . "<br>" . mysqli_error($conn);
            }

        mysqli_close($conn);
    ?> 
<br>
</center>
</body>
</html> 