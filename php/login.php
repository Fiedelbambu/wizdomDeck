<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/index.css">
    <title>WISDOM DECK</title>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="index.php" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" name="email" id="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox"> Remember me <a href="#">Forget Password</a></label>

                    </div>
                    <button>Log In</button>
                    <div class="register">
                        <p>Don't have an account <a href="#">Register</a></p>
                    </div>

                </form>
            </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <?php
    $db_host = "localhost";
    $db_user = "wizdom";
    $db_password ="dPK/8tQitbOlQ2Ba";
    $db_name = "karteikarten_db";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $benutzer = $_POST["email"];
        $passwort = $_POST["password"];



        $query = "SELECT * FROM benutzer WHERE name = '$benutzer' AND passwort = '$passwort'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            header("Location: ../php/index.php");
            session_start();
            $_SESSION["name"] = $benutzer;
        } else {
            echo "Falsche Zugangsdaten";
        }


    }

    ?>
</body>

</html>
