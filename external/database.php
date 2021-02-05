<?php
// Yhteys
$dsn = 'mysql:dbname=epiz_27799799_genericdatabasename;host=sql204.byetcluster.com';
$user = 'epiz_27799799';
$password = 'ajQ1Tng5QUNBV2Y2RA==';

try {
    $pdo = new PDO($dsn, $user, base64_decode($password));
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>