
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adim_page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include "include/nav.php"?>
<div class="container">
<?php
   if(!isset($_SESSION['utilisateur'])){
    ?>
    <div class="alert alert-danger mt-5" role="alert">
      <h3>La page est actuellement indisponible <hr> Vous ne pouvez pas accéder à cette page !!! <a href="connexion.php">Retour</a>
      </h3>
  </div>
    <?php
}else{
    ?>
    <h3 class="alert alert-success mt-5">Salut !!. 
           <?php
            echo ($_SESSION['utilisateur']['login']);
            ?>
            <p>
            Bienvenue sur la page d'administration</p>
    </h3>
    <?php
}
?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

