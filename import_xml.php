<?php
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=localhost;dbname=php-todo", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$xmlFile = 'tache.xml'; 

if (!file_exists($xmlFile)) {
    die("Fichier XML introuvable.");
}

$xml = simplexml_load_file($xmlFile);

foreach ($xml->tache as $tache) {
    $todo = (string)$tache->todo;
    $rqt = $pdo->prepare("SELECT COUNT(*) FROM todo WHERE todo = ?");
    $rqt->execute([$todo]);
    if ($rqt->fetchColumn() == 0) {
        $insert = $pdo->prepare("INSERT INTO todo (todo) VALUES (?)");
        $insert->execute([$todo]); 
    }
}
echo "Importation réussie.";
?>


