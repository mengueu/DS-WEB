<?php
// config/database.php
function getDBConnection() {
    $host = 'localhost';
    $dbname = 'saep_db';
    $username = 'root';
    $password = ''; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("<div class='alert alert-danger m-3'>Erro de ligação à base de dados: Verifique se a base de dados 'saep_db' existe.</div>");
    }
}
?>