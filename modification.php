<?php
include('db.php');

if (isset($_POST['id']) && isset($_POST['newTodo'])) {
    $id = $_POST['id'];
    $newTodo = $_POST['newTodo'];

    
    $rqt = $conn->prepare("UPDATE todo SET todo = ? WHERE id = ?");
    $rqt->execute([$newTodo, $id]);
    
    echo $newTodo;
}
?>
