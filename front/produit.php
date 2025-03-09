<?php
session_start();
require_once '../include/database.php';
// Vérifiez si l'ID est bien passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Préparer la requête
    $sqlState = $pdo->prepare('SELECT * FROM porduit WHERE id=?');
    // Exécuter la requête avec la valeur de $id
    $sqlState->execute([$id]);
    // Récupérer les résultats
    $produit = $sqlState->fetch(PDO::FETCH_ASSOC); 
} else {
    echo "ID non fourni.";
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit|<?php echo $produit['libelle']?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include "../include/nav_front.php"?>
<div class="container py-3">
<h3 id="titr"><?php echo $produit['libelle']?></h3>
<hr style="border: 1px solidrgb(0, 0, 0); height: 5px; width: 100%; margin-top: 20px; margin-bottom: 20px;">
<div class="container my-5 ">
    <div class="row align-items-center shadow-lg p-4 rounded bg-white rounddiv">
        <div class="col-md-6 text-center">
            <img  class="img-fluid rounded shadow-sm w-80" src="../upload/produit/<?php echo htmlspecialchars($produit['image']); ?>"  alt="<?php echo htmlspecialchars($produit['libelle']); ?>">
        </div>
        <div class="col-md-6">
            <h1 id="title_c" class="fw-bold text-primary text-center"><?php echo htmlspecialchars($produit['libelle']); ?></h1>
            <hr class="border-primary">
            <?php
            $discount = $produit['discount'];
            $prix = $produit['prix'];
            if(!empty($discount)){
                $total = $prix - (($prix*$discount)/100);

            }else{
                $total = $prix;
            }

            ?>
            
            <p id="" class="lead text-muted"><?php echo nl2br(htmlspecialchars($produit['description'])); ?></p>
            <h3 id="prix">Prix: <strike><?php echo $prix; ?></strike> MAD</h3>

            <?php
            if(!empty($produit['discount'])){
                ?>
                 <div id="discount" class="d-flex align-items-center my-3">
                    <h3 id="disc" class=" ">-<?php echo $discount; ?> %</h3> 
            </div>
                <?php
            }
            ?>
            <p id="prix_final">Prix Final avec une remise de <span class="text text-danger"><?php echo $discount ?>%</span></p>
            <h3 id="prix">Prix Final: <?php echo $total; ?> MAD</h3>
             
            <div class="counter">
                    
                    <form method="POST" action="panier.php" class="d-flex">
                         <button type="button" id="moin" class="counter-moins">-</button>
                         <input type="hidden" name="product_id" value="<?php echo $produit['id']; ?>">
                         <input type="hidden" name="product_name" value="<?php echo $produit['libelle']; ?>">
                         <input type="hidden" name="product_price" value="<?php echo $produit['prix']; ?>">
                          <input type="hidden" name="product_image" value="<?php echo $produit['image']; ?>"> 
                         <input value="1" id="pl" type="number" name="qty" max="99" min="1">
                         <button type="button" id="plus" class="counter-plus">+</button>
                         <input  id="ajouterbtn" class="btn ml-2" type="submit" value="Ajouter" name="ajouter">
                    </form>      
            </div>
        </div>
    </div>
</div>
</div>    
<?php include "../include/foter.php";?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/produit/counter.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

