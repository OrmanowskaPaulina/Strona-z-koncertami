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
            
            $login = $_POST["login"];
            $password1 = $_POST["password"];
            $password2 = $_POST["password2"];
            
            if (strcasecmp($password1, $password2) == 0){
                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login','$password1')";

                if (mysqli_query($conn, $sql)) {
                  echo "Dodano użytkownika!";
                  header("Location: index.php");
                } 
                else {
                  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
            else{
                header('Location: blad.html');
            }

    ?> 
<br>
</center>
</body>
</html> 