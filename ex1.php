<?php
// Connecte-toi à MySQL avec PDO, crée une table etudiants (id, nom, age), puis affiche un message de succès. C'est la base de tout le reste.

try{
    $pdo=new PDO("mysql:host=localhost; dbname=newdb","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      echo "connected !" . "<br>"; 

}
catch(PDOException $e){
    die($e->getMessage());
}
$qwery="CREATE TABLE IF NOT EXISTS etudiants (
id INT AUTO_INCREMENT PRIMARY KEY ,
nom varchar(20),
age int(6)
)";
$pdo->exec($qwery);
echo "Table 'etudiants' créée avec succès." . "<br>";



//Insère 3 étudiants dans la table avec des requêtes préparées. Les requêtes préparées protègent contre les injections SQL.
$stmt=$pdo->prepare("INSERT INTO etudiants(nom,age)    VALUES(?,?)");
$etudiants=[
        ['khalid', 22],
        ['ahmed', 23],
        [ 'youssef', 45],
             
];



// foreach($etudiants as $eleve){
//     $stmt->execute($eleve);

// }
echo "3 etudiant a ete ajoute avec succee!"  . "<br>";


// Récupère tous les étudiants de la table et affiche-les dans un tableau HTML. Utilise fetchAll() pour récupérer toutes les lignes.


// // 1. Préparation et exécution (pas besoin de prepare si pas de variables, mais c'est une bonne habitude)
// $stmtt = $pdo->query("SELECT * FROM etudiants");

$stmtt=$pdo->prepare("SELECT * from etudiants ");
$stmtt->execute();
$resultats=$stmtt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style></table>
</head>
<body>
    
<table>
    <thead>
        <tr>
            <th>id</th>            
            <th>Nom</th>            
            <th>AGE</th>         
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultats as $etud): ?>
                <tr>
                    <td><?php echo $etud["id"]  ?></td>
                    <td><?php echo $etud["nom"]  ?></td>
                    <<td> <?php echo $etud["age"]  ?> ans</td>
                </tr>

            <?php endforeach?>
    </tbody>
</table>
</body>
</html>