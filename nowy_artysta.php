
<html><title>Koncerty</title>
<body>
<meta http-equiv="Content-type" content="text/html"  charset="utf-8" " /><link rel="stylesheet" href="arkusz.css">
<center> 
        <header> Wracamy na koncerty!
        <nav>
            <a href=zdjecia_artysciU.php?idAu=<?php echo $_GET['idAu']; ?>>| WSZYSTKIE |</a>
            <a href=ulubione.php?idAu=<?php echo $_GET['idAu']; ?>>| ULUBIONE |</a>
            <a href=nowy_koncert.php?idAu=<?php echo $_GET['idAu']; ?>><b>| DODAJ KONCERT |</b></a>
            <a href="wylogowanie.php">| WYLOGUJ SIĘ |</a>
        </nav></header>
    
        <br><br><h1> Uzupełnij dane o artyście:
        <div><form action="nowy_artystaP.php?idAu=<?php echo $_GET['idAu']; ?>" method="post">
            Pełna nazwa: <input type="text" name="nazwaA"><br>
            Link do zdjęcia: <input type="text" name="linkA"><br>
        <input type="submit" value="Dodaj artystę">
        </form></div></h1>
</center>
</body>
</html> 
