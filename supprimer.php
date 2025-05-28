<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $rqt = $conn->prepare("DELETE FROM todo WHERE id = ?");
    $rqt->bind_param("i", $id);
    $rqt->execute();
    $rqt->close();
}

$conn->close();
?>
