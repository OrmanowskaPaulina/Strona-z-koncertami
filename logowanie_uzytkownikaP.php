<?php
    session_start();
?>
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
            $passwordU = $_POST["password"];
            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
                
            $sql = "SELECT * FROM uzytkownicy WHERE login='$login'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0 ){
                while($row = mysqli_fetch_assoc($result) ){ 
                    if (strcasecmp($login, $row['login']) ==0 && strcasecmp($passwordU, $row['haslo']) ==0){
                        //$idUz = $row['id'];
                        $_SESSION["id"] = $row['id'];
                        header("Location: zdjecia_artysciU.php?idAu={$_SESSION['id']}");
                    }
                    else {
                        echo "błąd podczas logowania:(";
                    }
                }
            }
            else {
                echo "Błąd bazy danych";
            }   
        mysqli_close($conn);
        ?> 
    </center>
    </body>
    </html> 