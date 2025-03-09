<nav class="navbar navbar-expand-lg custom-navbar top">
  <div class="container-fluid">
    <img src="../images/logo.jpg" width="100" alt="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li>
           <a type="button" class="nav-link active nav-item-custom" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Voir Tous Les Catégories
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active nav-item-custom" href="index.php">Nos Produits</a>
        </li>
         
      </ul>   
    </div>
  </div>
 <?php
if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
    $total_products = 0;
    
    foreach ($cart as $product) {
        $total_products += $product['quantity']; 
    }
} else {
    $total_products = 0; 
}
?>

<a id="panierBtn" class="btn" href="panier.php">
    <i class="fa-solid fa-bag-shopping"></i>  
    <span id="total"><?php echo $total_products; ?></span>  
</a>

</nav>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="offcanvas-title title mt-2 product-title" id="offcanvasExampleLabel">Liste Des catégories</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php
  
    include '../include/database.php';

// Préparer la requête
$sqlState = $pdo->prepare('SELECT * FROM categorie');

// Exécuter la requête
$sqlState->execute();

// Récupérer les résultats
$categories = $sqlState->fetchAll(PDO::FETCH_ASSOC);
  ?>
          <ul class="list-group mt-5 w-100">
        <?php
        foreach($categories as $categorie){
            ?>
            <li class="list-group-item">
               <a href="categorie.php?id=<?php echo $categorie['id']?>" class="btn btn-light"> <?php echo $categorie['libelle']?></a>
            </li>
            <?php
        }
        ?>
        
        
     </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



