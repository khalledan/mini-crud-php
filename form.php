<?php 
include("db.php");
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nom=trim($_POST["nom"]);
    $age=filter_var($_POST["age"],FILTER_VALIDATE_INT);
        if(isset($nom) && $age!== false && $age>0){
            $stmt=$pdo->prepare("INSERT INTO etudiants(nom,age)
            VALUES(?,?)");
            $stmt->execute([$nom,$age]);

            // REDIRECTION : Crucial pour éviter les doublons au rafraîchissement (F5)
        header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
        exit();
            
        }
        else {
        $erreur ="Erreur : Le nom est requis et l'âge doit être un entier positif.";
    }



}
// --- LOGIQUE DE RÉCUPÉRATION (Toujours exécutée pour l'affichage) ---
$query = $pdo->query("SELECT * FROM etudiants");
$resultats = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foormulairee</title>
    <STYLE>
        table{ border-collapse:collapse; width:400px ;text-align: center;}
    </STYLE>
</head>
<body>
    
<form action="" method="post">
    <fieldset>
        <legend>Entrer Vous Info</legend><br>

        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        
        <label for="nom">Age:</label>
        <input type="text" id="age" name="age">
        <br><br>
        <input type="submit" value="entrer" >

    </fieldset>

</form><br><hr><br>

<h2>Etudiants a été Ajouté a la Base de donnée</h2>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <Th>Nom:</Th>
            <Th>Äge:</Th>
            <Th colspan="2">Actions:</Th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultats as $etudi): ?>
        <tr>
                <td><?= $etudi["id"] ?></td>
                <td><?= $etudi["nom"] ?></td>
                <td><?= $etudi["age"] ?> ans</td>
                <td><a style="color:green" href="modifier.php?id=<?= $etudi['id'] ?>">📝 Modifier</a>  |  <a style="color:red" href="supprimer.php?id=<?=$etudi['id'] ?>" onclick="confirm('Waach Rak mt2aaked Asahbi')">🗑️ Supprimer</a></td>
            
                
     </tr>
        <?php endforeach;  ?>

    </tbody>
    
</table>

<?php
if(isset($erreur)){ ?>
            <div style="color: red; margin-top:10px;"> <?=$erreur?> </div>
  <?php } ?>
</body>
</html>
