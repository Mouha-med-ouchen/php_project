 <?php 
session_start();
$connecte = false;
if(isset($_SESSION['utilisateur'])){
    $connecte = true;
}
?> 

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
       
        <?php
        if($connecte == true){?>
           <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ajouter_utilisateur.php">Ajouter Utilisateur</a>
        </li>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="categories.php">Liste des Catégories</a>
         </li>
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="produits.php">List Des Produits</a>
         </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ajouter_categorie.php">Ajouter Catégorie</a>
         </li>
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="ajouter_produit.php">Ajouter Produit</a>
         </li>
         <!-- Button trigger modal Deconnexion  -->
        <a type="button" class="nav-link active " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Déconnexion
       </a>    

       <?php
        
        }else{?>

            <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="connexion.php">Connexion</a>
        </li>
       

       <?php
        }

        ?>
        
        
       
      </ul>
    </div>
  </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 product-title" id="exampleModalLabel">Déconnection</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
        <a type="button" href="deconnexion.php" class="btn btn-danger">Oui</a>
      </div>
    </div>
  </div>
</div>