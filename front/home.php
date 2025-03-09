<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php 
session_start();

 include "../include/nav_front.php";
?>
 <div class=" py-2">
<?php    require_once '../include/database.php';?>
<!-- afichaje toute les produits -->
<?php
$sqlpro = $pdo->prepare('SELECT * FROM porduit');
//Exécuter la requête
$sqlpro->execute();
// Récupérer les résultats
$produits = $sqlpro->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container py-3">
  <h1 class="product-title  ">Tous Les Produits</h1>
<hr style="border: 1px solidrgb(0, 0, 0); height: 5px; width: 100%; margin-top: 20px; margin-bottom: 20px;">
<div class="container">
    <div class="row">
        <?php
        foreach($produits as $produit){
           ?>
             <div class="card col-md-3 col-sm-6 mb-3 m-5">
                <img src="../upload/produit/<?php echo $produit['image']; ?>" width="50" height="350" class="card-img-top" alt="Produit">            
                <div class="card-body">
                    <a href="produit.php?id=<?php echo $produit['id'] ?>" class="btn">Afficher D´tails</a>
                    <h5 class="card-title"><?php echo $produit['libelle'] ?></h5>
                    <p class="card-text"><?php echo $produit['prix'] ?> DH</p>                   
                    <p class="card-text"><small class="text-body-secondary">Ajouté Le: <?php echo date_format(date_create($produit['date_creation']), 'Y/m/d'); ?>
                  </small></p>
               </div>
               <div>
                    <form method="POST" action="panier.php" class="d-flex">
                         <input type="hidden" name="product_id" value="<?php echo $produit['id']; ?>">
                         <input type="hidden" name="product_name" value="<?php echo $produit['libelle']; ?>">
                         <input type="hidden" name="product_price" value="<?php echo $produit['prix']; ?>">
                         <input value="1" type="hidden" id="pl" type="number" name="qty" max="99" min="1">
                        <button onclick="return false;" id="ajouterbtn" class="btn ml-2" name="ajouter">
                            Ajouter <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>
               </div>
               <hr>
            </div>
            
           <?php 
        } 
        ?>
     </div>
     <hr>
 </div>
</div>
<?php include "../include/foter.php";?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>




