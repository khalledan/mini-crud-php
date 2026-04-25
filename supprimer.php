<?php
include("db.php");


$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
    $stmt->execute([$id]);
    
    header("Location: form.php?status=AsafeRahTmsah");
    exit();
} else {
    // Si pas d'ID, on retourne au formulaire quand même
    header("Location: form.php");
    exit();
}
// include("db.php");

// $id=$_GET['id'];
// $stmt=$pdo->prepare("DELETE from etudiants where id=?");
// $stmt->execute([$id]);
// header("Location:form.php" ,"statut=?AsafeRahTmsah");
// exit();