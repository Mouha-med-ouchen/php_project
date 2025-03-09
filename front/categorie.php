<?php
session_start();

require_once '../include/database.php';
// Vérifiez si l'ID est bien passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Préparer la requête
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    // Exécuter la requête avec la valeur de $id
    $sqlState->execute([$id]);
    // Récupérer les résultats
    $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);
} else {
    echo "ID non fourni.";
} 
?>
<?php
 $sqlState = $pdo->prepare('SELECT * FROM porduit WHERE id_categorie = ?');
    $sqlState->execute([$id]);
    // Fetch results
    $produits = $sqlState->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories|<?php echo $categorie['libelle']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include "../include/nav_front.php"?>
<div class="container py-3">
<h3 class=" product-catego product-title">⫸<?php echo $categorie['libelle']?></h3>
<hr style="border: 1px solidrgb(0, 0, 0); height: 5px; width: 100%; margin-top: 20px; margin-bottom: 20px;">
<div class="container">
    <div class="row">
        <?php
        foreach($produits as $produit){
           ?>
             <div class="card col-md-3 col-sm-6 mb-3 m-5">
                <img src="../upload/produit/<?php echo $produit['image']; ?>" width="100%" height="250" class="card-img-top" alt="Produit">
                <div class="card-body">
                    <a href="produit.php?id=<?php echo $produit['id'] ?>" class="btn stretched-link">Afficher D´tails</a>
                    <h5 class="card-title"><?php echo $produit['libelle'] ?></h5>
                    <p class="card-text"><?php echo $produit['prix'] ?> DH</p>                 
                    <p class="card-text"><small class="text-body-secondary">Ajouté Le: <?php echo date_format(date_create($produit['date_creation']), 'Y/m/d'); ?>
                  </small></p>
               </div>
               
               <div id="crd_fo" class="card-foter">
                 <div class="counter">
                    
                    <form method="POST" action="panier.php" class="d-flex">
                         <button type="button" id="moin" class="counter-moins">-</button>
                         <input type="hidden" name="product_id" value="<?php echo $produit['id']; ?>">
                         <input type="hidden" name="product_name" value="<?php echo $produit['libelle']; ?>">
                         <input type="hidden" name="product_price" value="<?php echo $produit['prix']; ?>">
                         <input value="1" id="pl" type="number" name="qty" max="99" min="1">
                         <button type="button" id="plus" class="counter-plus">+</button>
                         <input id="ajouterbtn" class="btn ml-2" type="submit" value="Ajouter" name="ajouter">
                    </form>

               
                    
            </div>
               </div>
            </div> 
           <?php 
        }
        if(empty($produit)){
            ?>
            <div class="alert alert-info" role="alert">
                        <span>Pas! </span>de <span>Produit pour l'instant</span> 
                </div>
            <?php
        }
        ?> 
     </div>
 </div>
</div>
  <?php include "../include/foter.php";?>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../assets/js/produit/counter.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

