<?php
    if (isset($_POST["home"])) {
        header("Location: http://www.funnymonkey.studio/");
    }
    if (isset($_POST["snek"])) {
        header("Location: http://www.funnymonkey.studio/snek");
    }
    if (isset($_POST["login"])) {
        header("Location: http://www.funnymonkey.studio/login");
    }
    if (isset($_POST["krowsgames"])) {
        header("Location: http://www.funnymonkey.studio/krowsgames");
    }
?>

<div class="navbar">
    <form method="post">
        <input type="submit" name="snek" value="Snek"/>
    </form>
    <form method="post">
        <input type="submit" name="home" value="Home"/>
    </form>
    <form method="post">
        <input type="submit" name="login" value="Login"/>
    </form>
    <form method="post">
        <input type="submit" name="krowsgames" value="krowsgames"/>
    </form>
</div>
