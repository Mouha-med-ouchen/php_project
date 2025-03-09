
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Catégorie</title>
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
            <h3 class="text-center">Modifier Catégorie</h3>
            <?php
           require_once 'include/database.php';
           $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
           $id = $_GET['id'];
           $sqlState->execute([$id]);
           $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);
           if(isset($_POST['modifier'])){

             $libelle = $_POST['libelle'];
                $description = $_POST['description'];
               if(!empty($libelle) && !empty($description)){
                    $sqlState = $pdo->prepare('UPDATE categorie SET libelle=? , description=? WHERE id=?');
                    $sqlState->execute([$libelle,$description,$id]);
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
                    <input readonly type="hidden" name="id" class="form-control" value="<?php echo $categorie['id']?>">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Libelle:<span class="text text-danger">*</span></label>
                    <input type="text" name="libelle" class="form-control" placeholder="Enter your " value="<?php echo $categorie['libelle']?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Description:<span class="text text-danger">*</span></label>
                     <textarea class="form-control" name="description" placeholder="Description...." ><?php echo $categorie['description']?></textarea>
                </div>
                <input type="submit" value="Modifier Catégorie" class=" add btn btn-primary w-50 " name="modifier">
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

