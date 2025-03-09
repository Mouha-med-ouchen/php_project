<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <?php include "include/nav.php"?>

<div class="container">
    <?php
    if(isset($_POST['connexion'])){
        $login = $_POST['login'];
        $pwd = $_POST['password'];
        

    }
    ?>
        <div class="login-container">
           <?php if(!empty($login) && !empty($pwd)){
            require_once 'include/database.php';
             $sqlState = $pdo->prepare('SELECT * FROM utilisateur WHERE login=? AND password=?');

            $sqlState->execute([$login,$pwd]);
            // condition:
            if($sqlState->rowCount()>= 1){
                // start session:
                session_start();
               $_SESSION['utilisateur'] = $sqlState->fetch();
               header(header:'location: admin.php');
                
        
            }
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur:</strong> Essayez encore!!.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
        }
        ?>
            <h3 class="text-center">Page de Connexion</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="login" class="form-label">Nom d'utilisteur:<span class="text text-danger">*</span></label>
                    <input type="text" name="login" class="form-control" placeholder="votre nom ">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe:<span class="text text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe" autocomplete="new password">
                </div>
                <input type="submit" value="Connection" class=" add btn btn-primary w-50 " name="connexion">
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

