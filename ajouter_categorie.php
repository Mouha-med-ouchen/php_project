
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <?php include "include/nav.php";
   if(!isset($_SESSION['utilisateur'])){
    header("location: connexion.php");
    exit();
}
   ?>

<div class="container">
    <?php

    ?>
        <div class="login-container">
            <h3 class="text-center product-title">Ajouter Catégorie</h3>
            <?php
            if(isset($_POST['ajouter'])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
               if(!empty($libelle) && !empty($description)){
                   //connection db:
                    require_once 'include/database.php';
                    $sqlState = $pdo->prepare('INSERT INTO categorie (libelle, description) VALUES (?, ?)');
                    $sqlState->execute([$libelle,$description]);
                    header(header:'location:categories.php');

                 }else{?>
                    <div class="alert alert-danger">
                          <p>libelle et description sont obligatoires!!</p>
                    </div>
                    <?php
                 }
            }
            ?>
           
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Le Titre:<span class="text text-danger">*</span></label>
                    <input type="text" name="libelle" class="form-control" placeholder="Entrez le nom de la catégorie  ">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Description:<span class="text text-danger">*</span></label>
                    <!-- <input type="password" class="form-control" name="password" placeholder="Enter your password" autocomplete="new password"> -->
                     <textarea class="form-control" name="description" placeholder="Description...." ></textarea>
                </div>
                <input type="submit" value="Ajouter Catégorie" class=" add btn btn-primary w-50 " name="ajouter">
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

