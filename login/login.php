<?php

    require "../external/database.php";

    $sql = "SELECT * FROM users";

    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();

    $ok = false;

    if (isset($_COOKIE["_LOGIN"])) {
        $ok = $_COOKIE["_LOGIN"];
    }

    $root = false;

    if (isset($_COOKIE["_USER"]) && $_COOKIE["_USER"] == "ROOT") {
        $root = true;
    }

    if (isset($_POST["password"]) && isset($_POST["username"])) {
        $username = $_POST["username"];
        $password = hash("sha512",$_POST["password"]);
        if (empty($password) == false && empty($username) == false) {

            $sql = "SELECT * FROM users WHERE username='$username'";
            $stmt = $pdo->query($sql);
            $rows = $stmt->fetchAll();

            if (count($rows) > 0) {
                $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll();
                if (count($rows) > 0) {
                    setcookie("_LOGIN", true, time() +2592000);
                    setcookie("_USER", $username, time() +2592000);
                    $ok = true;
                    header("Location: http://www.funnymonkey.studio/login/");
                } else {
                    echo "Incorrect password!";
                }
            } else {
                echo "Not a valid account!";
            }
        } else {
            echo "Name or password cannot be empty!";
        }
    }

    if (isset($_POST["password_reg"]) && isset($_POST["username_reg"])) {
        $username_reg = $_POST["username_reg"];
        $password_reg = $_POST["password_reg"];
        if (empty($password_reg) == false && empty($username_reg) == false) {

            $sql = "SELECT * FROM users WHERE username='$username_reg'";
            $stmt = $pdo -> query($sql);
            $rows = $stmt -> fetchAll();

            if (count($rows) > 0) {
                echo "Username already exists!";
            } else {
                $sql = "INSERT INTO `users` (`userid`, `username`, `password`,`date_created`) VALUES (DEFAULT, ?, ?, NOW())";
                $data = array($username_reg, hash("sha512",$password_reg));

                $stmt = $pdo -> prepare($sql);
                $stmt -> execute($data);
                setcookie("_LOGIN", true, time() +2592000);
                setcookie("_USER", $username, time() +2592000);
                $ok = true;
                header("Location: http://www.funnymonkey.studio/login/");
            }
        } else {
            echo "Name or password cannot be empty!";
        }
    }

    if (isset($_POST["logout"])) {
        setcookie("_LOGIN", false, time() +0);
        setcookie("_USER", "", time() +0);
        $ok = false;
    }
    
    if ($ok == false) {
?>

<form method="post">
    <label>Register</label><br>
    <input type="text" name="username_reg" value="" maxlength="20"/><br>
    <input type="password" name="password_reg" value="" maxlength="128"/><br>   
    <input type="submit" name="register" value="Register"/>
</form><br>

<form method="post">
    <label>Log in</label><br>
    <input type="text" name="username" value="" maxlength="20"/><br>
    <input type="password" name="password" value="" maxlength="128"/><br>   
    <input type="submit" name="login" value="Log in"/>
</form>

<?php
    } else {
        if ($root == true) {
?>
            <img src="../images/interpizza.jpg" alt="interpizza">
            <img src="../images/hackerman.gif" alt="hackerman">
            <style>
                body {
                    background-image: url("../images/yes.gif") !important;
                    background-repeat: no-repeat;
                    background-size: cover;
                }
            </style>

<?php
        } else {
?>

            <img src="../images/monke.gif" alt="monke">


<?php
        }
?>
    <form method="post">
        <input type="submit" name="logout" value="Log out"/>
    </form>

<?php
    }
?>