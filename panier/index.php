<?php
session_start();
//session_destroy();
 $pdo = new PDO("mysql:host=localhost;dbname=panier","root","");
 $pdostatement = $pdo->query("SELECT * FROM articles");
$pdostatement->execute(); 
$articles = $pdostatement->fetchAll();

if($_POST){
    //var_dump($_POST);
    extract($_POST);
    addPanier($id,$quantite);
    if($quantite > 0){
    $msg[] = $quantite." article".$id." ajouté(s) au panier";
    }
   // var_dump($_SESSION["panier"]);
}

function addPanier($article_id,$quantite){
    if(empty($_SESSION["panier"][$article_id])){
        if($quantite > 0){
        $_SESSION["panier"][$article_id]["quantite"] = intval($quantite);
        }
    } else {
        if($quantite > 0){
        $_SESSION["panier"][$article_id]["quantite"] += intval($quantite);
        }
    }
    
}

?>
<?php include ("header.php");?>
   
      <div id="container">
       
          <?php foreach($articles as $article): ?>
        
        <div class="article">
            
                <p class="titre"><?= $article["titre"] ?></p>
                <img src="<?= $article['image'] ?>" width=300 height=200 alt="Un <?= $article["titre"] ?>">
                <p class="ajouter">
                    prix:<?= $article["prix"]?>€ 
                    
                    <form method="post">
                        <input type="number" name="id" value="<?= $article["article_id"] ?>" hidden><br>
                        <label for="quantite<">quantite</label><br>
                        <input type="number" id="quantite" name="quantite" value="1"><br><br>
                        
                        <button type="submit">Ajouter</button>
                        
                    </form><br>
                    <a href="panier.php"><button >Voir votre panier</button></a>
                </p>
            
          </div>
    <?php endforeach?>
      </div>
    </main>
   