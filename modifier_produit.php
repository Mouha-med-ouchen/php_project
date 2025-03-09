
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include "include/nav.php";
if(!isset($_SESSION['utilisateur'])){
    header("location: connexion.php");
    exit();
}
require_once 'include/database.php';
?>

<div class="container">
    <?php
    $id = $_GET['id'];
    require_once 'include/database.php';
         $sqlState = $pdo->prepare('SELECT * FROM porduit WHERE id=?');
           
           $sqlState->execute([$id]);
           $produit = $sqlState->fetch(PDO::FETCH_ASSOC);
           if(isset($_POST['modifier'])){
              $libelle = $_POST['libelle'];
              $prix = $_POST['prix'];
              $discount = $_POST['discount'];
              $categorie = $_POST['categorie'];
            $description = $_POST['description'];
            //image:
           $filename = "";
          if(!empty($_FILES['image']['name'])){
             $image = $_FILES['image']['name'];
             $filename = uniqid() . $image;
             move_uploaded_file($_FILES['image']['tmp_name'],'upload/produit/' . $filename) ;
                
              
         }


     if (!empty($libelle) && !empty($prix) && !empty  ($categorie)) {
        
        if (!empty($filename)) {
        $query = "UPDATE porduit SET libelle=?, prix=?, discount=?, id_categorie=?, description=?, image=? WHERE id=?";
        $sqlState = $pdo->prepare($query);
        $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $filename, $id]);
    } else {
        $query = "UPDATE porduit SET libelle=?, prix=?, discount=?, id_categorie=?, description=? WHERE id=?";
        $sqlState = $pdo->prepare($query);
        $sqlState->execute([$libelle, $prix, $discount, $categorie, $description, $id]);
    }
          

            //locatin:
            header(header:'location: produits.php');
        
            
        }else{
            ?>
             <div class="alert alert-danger">
                          <p><span>Erreur! </span>veuillez réessayer<span class="text text-danger">(*)</span>sont obligatoires</p>
                    </div>
            <?php
        }

           }
            
        

    ?>
        <div class="">
            <h3 class="text-center">Modifier Produit</h3>
            <?php
            
                  
            ?>
           
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input readonly type="hidden" name="id" class="form-control" value="<?php echo $produit['id']?>">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Libelle:<span class="text text-danger">*</span></label>
                    <input type="text" name="libelle" class="form-control" placeholder="Enter your "value="<?php echo $produit['libelle']?>">
                </div>
                <div class="mb-3">
                    <label for="pirx" class="form-label">Prix:<span class="text text-danger">*</span></label>
                    <input type="number" class="form-control" name="prix" placeholder="prix..." min="0" step="0.1" value="<?php echo $produit['prix']?>">
                     
                </div>

                <div class="mb-3">
                    <label for="pirx" class="form-label">Discount:</label>
                    <input type="number" class="form-control"  name="discount" placeholder="discount..." min="0" max="80" value="<?php echo $produit['discount']?>">
                     
                </div>
                <div class="mb-3">
                    <label for="pirx" class="form-label">Description:<span class="text text-danger">*</span></label>
                    <textarea class="form-control" name="description" id="description"><?php echo htmlspecialchars($produit['description'] ?? ''); ?></textarea>
                     
                </div>

                <div class="mb-3">
                    <label for="pirx" class="form-label">Image:<span class="text text-danger">*</span></label>
                    <input type="file" class="form-control"  name="image" >
                    <img class="img img-fluid" width="100" src="upload/produit/<?php echo htmlspecialchars($produit['image'] ?? 'default.jpg'); ?>" alt="Image du produit">

                </div>
                
                <?php
                    // Prepare the query
                    $sqlState = $pdo->prepare('SELECT * FROM categorie');

                    // Execute the query
                    $sqlState->execute();

                    // Fetch all results
                    $categories = $sqlState->fetchAll(PDO::FETCH_ASSOC);

                ?>

                <div class="mb-3">
                    <label for="" class="form-label">Catégorie:<span class="text text-danger">*</span></label>
                    <select name="categorie" class="form-control" >
                        <option value="">Choissez une Catégorie</option>
                       <?php
                       foreach($categories as $categoraie){
                        if($produit['id_categorie'] == $categoraie['id']){
                             echo "<option selected  value='".$categoraie['id']."'>".$categoraie['libelle']."</option>";
                        }else{
                               echo "<option value='".$categoraie['id']."'>".$categoraie['libelle']."</option>";
                        }
                        
                       }
                       ?>
                        
                    </select>
                </div>
               <div class="text-center ">
                 <input type="submit" value="Modifier Produit" class="  btn btn-primary w-50 " name="modifier">
               </div>
            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

