

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommercer_Login-page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <?php include "include/nav.php";
   if(!isset($_SESSION['utilisateur'])){
    header("location: connexion.php");
    exit();
}?>

<div class="container">
    <?php
        if(isset($_POST['ajouter'])){
            $login = $_POST['login'];
            $pwd = $_POST['password'];

             

         }
          
        
      
    ?>
        <div class="login-container">
            <h3 class="text-center product-title">Ajouter Utilisateur</h3>
               <?php
                 if(!empty($login) && !empty($pwd)){
                    // include DB:
                    require_once "include/database.php";
                    $date = date(format:'Y-m-d');
                    $sqlState = $pdo->prepare(query:'INSERT INTO utilisateur VALUES(null,?,?,?)');
                    $sqlState->execute([$login,$pwd,$date]);
                    //redirection:
                    //header(header:'location:connexion.php');
                    

                echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Succès :</strong>  Formulaire soumis avec succès !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Errur!!: </strong> Essayez encore.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
               ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Nom d'utilisateur:<span class="text text-danger">*</span></label>
                    <input type="text" name="login" class="form-control" placeholder="entrez votre nom">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mod de passe:<span class="text text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Choisissez un mot de passe sécurisé" autocomplete="new password">
                </div>
                <input type="submit" value="Ajouter" class=" add btn btn-primary w-50 " name="ajouter">
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

