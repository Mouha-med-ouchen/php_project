
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php include "include/nav.php";
   if(!isset($_SESSION['utilisateur'])){
    header("location: connexion.php");
    exit();
}
   ?>

<div class="container py-2">
   <h2 class="mt-5 product-title">Liste Des Catégories:</h2>
   <table  class="table table-bordered table-hover table-striped table-sm mt-5">
             <thead  class="table-dark">
             <tr>
               <th>#ID</th>
               <th>titre</th>
               <th>Description</th>
               <th>Date_creation</th>
               <th>Opération</th>
             </tr>
         </thead>
         <tbody>
              <?php 
               // connetion db:
                require_once 'include/database.php';
                $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                foreach($categories as $categorie){
                    ?>
                    <tr>
                        <th><?php echo $categorie['id'] ?></th>
                        <th><?php echo $categorie['libelle']?></th>
                        <th><?php echo $categorie['description']?></th>
                        <th><?php echo $categorie['date_creation']?></th>
                        <th id="sup" class="action-buttons">
                            <a href="modifier_categorie.php?id=<?php echo $categorie['id']?>" class="btn-modifier btn btn-sm">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="supprimer_categorie.php?id=<?php echo $categorie['id']?>" onclick="return confirm('Voulez vous vriment supprimer la catégorie??(<?php echo $categorie['libelle']?>)')" class="btn-supprimer btn btn-sm">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </th>

                    </tr>
                    <?php
                }
                
                ?>
         </tbody>
 </table>
 <!-- ------------------------------------------------------ -->
<a href="ajouter_categorie.php" class="btn btn-primary mt-3">Ajouter Catégorie</a>
              </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

