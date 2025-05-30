<?php
include('db.php');
$result = $conn->query("SELECT * FROM todo");

$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$racine = $xml->createElement('taches');
$xml->appendChild($racine);

foreach ($result as $todo) {
    $tache = $xml->createElement('tache');
    $tache->appendChild($xml->createElement('todo', htmlspecialchars($todo['todo'])));
    $racine->appendChild($tache);
}

$conn->close();


$fichier = 'tache.xml';
if ($xml->save($fichier)) {
    echo "Fichier XML genere <br>";
    echo "<a href='$fichier' download>fichier XML</a>";
} else {
    echo "Erreur lors de lenregistrement";
}
?>
