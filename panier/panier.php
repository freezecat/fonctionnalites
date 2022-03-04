<?php
session_start();
$pdo = new PDO("mysql:host=localhost;dbname=panier","root","");

function totalArticle(){
global $pdo;
$sql= "SELECT * FROM articles";
$pdostatement = $pdo->query($sql);
return $pdostatement->rowCount();  
}


$articles = [];

if(!empty($_SESSION["panier"])){
//var_dump($_SESSION["panier"]);

//echo count($_SESSION["panier"]);
for($i=1; $i<=totalArticle();$i++){ 
    //echo $i."<br>";
     if(isset($_SESSION["panier"][$i])) //si l'article dont l'article_id vaut $i est dans le panier alors je fais la requête
     {
    $pdostatement = $pdo->prepare("SELECT * FROM articles WHERE article_id=:article_id");
    $pdostatement->execute(array(":article_id"=>$i));
    $fetch = $pdostatement->fetch();
    array_push($articles,$fetch);
     }
    
   
   }
}
//var_dump($_SESSION["panier"][1]["quantite"]); quantite de article n°1 déposé dans panier

if($_POST){
    extract($_POST);
    unset($_SESSION["panier"][$id]);
    header("Location:panier.php"); 
}
if(isset($_GET["session"])){
    session_destroy();
    header("Location:panier.php");
  
   
}
include ("header.php");
?>
<?php if($articles):?>
    <table>
        <tr>
            <th>Image</th>
            <th>titre</th>
            <th>quantites</th>
            <th>prix</th>
            <th>supprimer</th>
        </tr>
   
        <!-- verifie si le panier est vide ou pas-->
        
        <?php foreach($articles as $index=>$article):?>
        <!-- verifie qu'il y a un article dont l'id est $article["article_id"] dans le panier-->
            <?php if(isset($_SESSION["panier"][$article["article_id"]])): ?>
            <tr>
                <td><img src="<?= $article["image"]?>" width=150 heigh=100 alt="Un<?= $article['titre']?>"></td>
            
                <td><?= $article["titre"]?></td>
               <!-- l'id de l'article vaut $article["article_id"] et la quantite de l'article du panier
               est de la forme $_SESSION["panier"][l'id de l'article]["quantite"]
            -->
               <td><?= $_SESSION["panier"][$article["article_id"]]["quantite"]?></td>
            
                <td><?= $article["prix"]?>€</td>
                <td>
                    <form action="panier.php" name="supprimer" method="post">
                        <input type="number" name="id" value="<?= $article["article_id"]?>" hidden>
                        <button type="submit">supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endif ?>
        <?php endforeach ?>
    </table>
        <?php else:?>
            <div>
                <h3>Votre panier est vide</h3>
            </div>
        <?php endif ?>
    <a href="index.php"><button>Retourner à la page d'accueil</button></a>
    <a href="panier.php?session=destroy"><button>Vider tout le panier</button></a>


<?php include("footer.php"); 



