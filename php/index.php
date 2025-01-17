<?php

$db_host = "localhost";
$db_user = "wizdom";
$db_password = "";
$db_name = "karteikarten_db";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
	die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$minlevel=0;
$maxlevel=2;
$keyword = "";
if (array_key_exists("minlevel",$_GET)){
	$minlevel=$_GET["minlevel"];
}
if (array_key_exists("maxlevel",$_GET)){
	$maxlevel=$_GET["maxlevel"];
}
if (array_key_exists("keyword",$_GET)){
	$keyword=$_GET["keyword"];
}

if ($minlevel > $maxlevel) $minlevel = $maxlevel;


$query = "SELECT *  FROM karteikarten WHERE schwierigkeit >= " . $minlevel . " and schwierigkeit <= " . $maxlevel . " and frage LIKE '%" . $keyword . "%' ;" ;
$result = $conn->query($query);

$i=0;
if (array_key_exists("i",$_GET)){
	$i = $_GET["i"];
}

$frageid=2;
$antwortid=3;
$schwierigkeitid=1;
$idid=0;

$arr = $result->fetch_all();

$conn->close();


$random = rand(0,count($arr)-1);

$frage = $arr[$random][$frageid];
$schwierigkeit = $arr[$random][$schwierigkeitid];
$antwort = $arr[$random][$antwortid];

?>
<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
    <link rel="stylesheet" type="text/css" href="../css/kartenstyle.css">
    <style>
        body {
            background-image: url('../image/background6.gif');
            background-size: cover;
            /* Optional: Das Bild so skalieren, dass es den gesamten Hintergrund bedeckt */
            background-repeat: no-repeat;
            /* Optional: Wiederholung des Bildes deaktivieren */
        }
    </style>




</head>



<header>
    <div style="text-align: center;">
        <img src="../image/logoblabla.png" alt="Dein Logo" class="logo" width="970" height="275">
    </div>


</header>

<body>




    <main>
        <div class="nav-container">
            <div class="navigation">
                <ul>
                    <li class="list active">
                        <a href="../php/index.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="../landingpage/agb.html">
                            <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                            <span class="text">Profiel</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#">
                            <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                            <span class="text">Mesaage</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#">
                            <span class="icon"><ion-icon name="camera-outline"></ion-icon></span>
                            <span class="text">Fotos</span>
                        </a>
                    </li>
                    <li class="list">
                        <a href="#">
                            <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                            <span class="text">Settings</span>
                        </a>
                    </li>
                    <div class="indicator"></div>
                </ul>
            </div>
        </div>
        <script>
            const list = document.querySelectorAll('.list');
            function activeLink() {
                list.forEach((item) =>
                    item.classList.remove('active'));
                this.classList.add('active');
            }
            list.forEach((item) =>
                item.addEventListener('click', activeLink));

        </script>


<div class="frage_antwort">

	<!--<div class = "clicker" tabindex="1">Antwort anzeigen</div>-->
	<input id="cb" type="checkbox" class="flip" />
	<div class = "fliplabel" ><label for="cb" class="fliplabel"><img class="fliplabel" src="../image/flip.svg"/></label></div>
	<div class = "frage">
	<?php
	echo $frage;
	?>
	</div>
	
	<div class = "antwort">
		<?php 
		echo $antwort;
		?>
	</div>
	<img class="icon" src=<?php
	if ($schwierigkeit == 2) {
		echo '../image/schwer.svg';
	} elseif ($schwierigkeit == 1) {
		echo '../image/mittel.svg';
	} else {
		echo '../image/easy.svg';
	}
	?> />

</div>

<br/>
<form action=#>
	
	<div class="radio">
	<div class="neue_frage" width=200px>minlevel</div>
	<br/>
	<label><input type = "radio" value = 0 name="minlevel"  <?php if ($minlevel == 0) echo "checked" ?> /><span/></label>
	<label><input type = "radio" value = 1 name="minlevel"  <?php if ($minlevel == 1) echo "checked" ?> /><span/></label>
	<label><input type = "radio" value = 2 name="minlevel"  <?php if ($minlevel == 2) echo "checked" ?> /><span/></label>
	<br/>
	<div class="neue_frage" width=200px>maxlevel</div>
	<br/>
	<label><input type = "radio" value = 0 name="maxlevel"  <?php if ($maxlevel == 0) echo "checked" ?> /><span/></label>
	<label><input type = "radio" value = 1 name="maxlevel"  <?php if ($maxlevel == 1) echo "checked" ?> /><span/></label>
	<label><input type = "radio" value = 2 name="maxlevel"  <?php if ($maxlevel == 2) echo "checked" ?> /><span/></label>
	<input type = "hidden" name=i value = <?php echo $i + 1 ?> />
	<br/>
	<div class="neue_frage" width=200px>keyword</div>
	<br/>
	<input type = "text" name="keyword" value = "<?php echo $keyword ?>" style="width: 155px;" />
	<br/>
	<br/>
	<div class="index" ><?php echo $i ?></div>
	</div>
	<input type = "submit" value=">" class="next" />
</form>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </main>





    <footer>
        <div class="footer-content">
            <ul class="footer-links">
                <li><a href="landingpage/agb.html">AGB</a></li>
                <li><a href="#">Über uns</a></li>
                <li><a href="#">Kontakt</a></li>
            </ul>
            <p class="footer-email">E-Mail: <a href="mailto:info@example.com">info@example.com</a></p>
        </div>
    </footer>
    </div>

</body>


</html>
