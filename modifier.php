<?php
//modifier?php
// try{
//     $pdo=new PDO("mysql:host=localhost;dbname=newdb","root","");
//     $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// }
//  catch(PDOException $e){
//     die($e->getMessage());
// }
include("db.php");


// On récupère l'ID depuis l'URL
$id=$_GET["id"] ?? null  ;

if($id){
    $stmt=$pdo->prepare("SELECT * from etudiants where id=?");
    $stmt->execute([$id]);
    $resultats=$stmt->fetch(PDO::FETCH_ASSOC);
}else {
    // Si on arrive sur la page sans ID du tout
    die("Erreur : Aucun identifiant fourni.");
}


if($_SERVER["REQUEST_METHOD"]==="POST"){
    $nom=trim($_POST["nom"]);
    $age=filter_var($_POST["age"],FILTER_VALIDATE_INT);

    if(!empty($nom) && $age!==false && $age>0){
        $stmt=$pdo->prepare("UPDATE  etudiants 
        SET nom=?,age=?
        where id=?");
     $stmt->execute([$nom,$age,$id]);
     header("Location: form.php?statuts=dakchiRahTchonga");
     exit();

    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
</head>
<body>
    
<form action="" method="POST">

<fieldset>
    <legend>MODIFIER</legend>
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?=htmlspecialchars($resultats['nom'])  ?>"required>
    
    <label for="nom">Age:</label>
    <input type="number" id="age" name="age" value="<?= $resultats['age']  ?>">
    <br><br>
    <input type="submit" value="Enregistrer LEs modifications" >
</fieldset>
</form>
</body>
</html>