
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
    <title>Koncerty</title>
    </head>
    <body><center>
        <header> Wracamy na koncerty!
        <nav>
            <a href="koncerty.php">| WSZYSTKIE |</a>
            <a href="nowy_uzytkownik.php">| REJESTRACJA |</a>
            <a href="index.php"><b>| ZALOGUJ SIĘ |</b></a>
        </nav></header>
        <h1> Pomyślnie wylogowano!</h1>
        <?php
    	session_destroy();
     
    	if ($_SESSION)
    		echo "Wylogowanie nie nastąpiło!";
    	else
    		header('Location: zdjecia_artysci.php');
        ?>
    </center></body>
</html>
