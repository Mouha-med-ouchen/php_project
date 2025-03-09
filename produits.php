
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Des Produits</title>
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
    require_once 'include/database.php';
   ?>

<div class="container py-2">
    <h2 class="mt-5 product-title">Liste Des Produits:</h2>
      <table  class="table table-bordered table-hover table-striped table-sm mt-5">
             <thead  class="table-dark">
             <tr>
               <th>#ID</th>
               <th>Titre</th>
               <th>Prix</th>
               <th>Discount</th>
               <th>Prix Final</th>
               <th>Catégorie</th>
               <th>Image</th>
               <th>Date_creation</th>
               <th  class="text-center">Opération</th>
             </tr>
         </thead>
         <tbody>
              <?php 
               // connetion db:
                require_once 'include/database.php';
                $produits = $pdo->query("SELECT porduit.*,categorie.libelle as 'categorie_libelle' FROM porduit INNER JOIN categorie ON porduit.id_categorie = categorie.id")->fetchAll(PDO::FETCH_ASSOC);
                foreach($produits as $produit){
                    $prix =  $produit['prix'];
                    $discount = $produit['discount'];
                    $prixFinal = $prix - (($prix*$discount)/100);
                    ?>
                    <tr>
                        <th><?= $produit['id'] ?></th>
                        <th><?= $produit['libelle']?></th>
                        <th><?= $prix ?> DH</th>
                        <th><?= $discount ?> %</th>
                        <th><?= $prixFinal?> DH</th>
                        <th><?= $produit['categorie_libelle']?></th>
                        <th><img src="upload/produit/<?= htmlspecialchars($produit['image'] ?? 'default.jpg'); ?>" 
                                    alt="<?= htmlspecialchars($produit['libelle'] ?? 'Image du produit'); ?>" 
                                    width="70">
                            </th>

                        <th><?= $produit['date_creation']?></th>


                        
                        <th id="sup" class=" action-buttons d-flex justify-content-center gap-2">
                            <a href="modifier_produit.php?id=<?php echo $produit['id']?>" class="btn-modifier">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="supprimer_produit.php?id=<?php echo $produit['id']?>" onclick="return confirm('Voulez vous vriment supprimer la catégorie??(<?php echo $produit['libelle']?>)')" class="btn-supprimer btn btn-sm">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </th>

                    </tr>
                    <?php
                }
                
                ?>
         </tbody>

      </table>
    <a href="ajouter_produit.php" class="btn btn-primary mt-3">Ajouter Produit</a>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

