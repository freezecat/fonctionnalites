<?php  
$pdo = new PDO("mysql:host=localhost;dbname=commentaire","root","");
$erreurs = [];
$success = [];
//Dans la Bdd , on a ajouté un champ rang qui s'incrémente à chaque réponse :
//la réponse d'un commentaire à un rang 1 , la réponse de la réponse de ce commentaire à un rang 2 etc...

function selectByParentId($parentId){ 
    global $pdo;
    $sql = "SELECT * FROM commentaire WHERE parent_id=:parent_id";
    $pdostatement= $pdo->prepare($sql);
    $pdostatement->bindValue(":parent_id",$parentId);
    if($pdostatement->execute()){
        return $pdostatement->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
    }

    function selectById($id){ 
        global $pdo;
        $sql = "SELECT * FROM commentaire WHERE id=:id";
        $pdostatement= $pdo->prepare($sql);
        $pdostatement->bindValue(":id",$id);
        if($pdostatement->execute()){
            return $pdostatement->fetch(PDO::FETCH_ASSOC);
        }
        return null;
        }

    
if($_POST){
    extract($_POST);
    if(!empty(trim($pseudo)) && !empty(trim($commentaire))){
        if(strlen($pseudo)>20 || strlen($pseudo)<2){
            $erreurs[]= "Le pseudo doit avoir entre 2 et 20 caractères";
        }
        
    } else {
        $erreurs[] = "Veuillez remplir tout les champs";
    }

    if(empty($erreurs)){
        $pseudo = htmlspecialchars(trim($pseudo));
        $commentaire = htmlspecialchars(trim($commentaire));
      
        $sql = "INSERT INTO commentaire(pseudo,commentaire,parent_id,rang) VALUES(:pseudo,:commentaire,:parent_id,:rang)";
        $pdostatement = $pdo->prepare($sql);
        if(isset($_GET["id"])){
            $id = htmlspecialchars(trim($_GET["id"]));
            $pdostatement->execute(array(
                ":pseudo"=>$pseudo,
                ":commentaire"=>$commentaire,
                ":parent_id" => intval($id),
                ":rang" => selectById($id)["rang"]+1
            ));
            $success[] = "Réponse enregistrée";
        } else {
            $pdostatement->execute(array(
                ":pseudo"=>$pseudo,
                ":commentaire"=>$commentaire,
                ":parent_id" => null,
                ":rang"=> 0
            ));
            $success[] = "Commentaire enregistré";
        }
      

    }
}
$sql = "SELECT * FROM commentaire";
$pdostatement = $pdo->query($sql);

$pdostatement->execute();
$commentaires = $pdostatement->fetchAll(PDO::FETCH_ASSOC);

//var_dump($commentaires);




function children($id){
   
   
    foreach(selectByParentId($id) as $commentaire){
        $parent = selectById($id);
        echo '<div class="children" style="margin-left:'.(2*$commentaire["rang"]).'rem;">'; 
        //la réponse est décalé de 2rem de son commentaire parent
        echo '<div style="width:100%;border:1px solid black">';
        echo '<p>'.$parent["pseudo"].' a écrit:</p>';
        echo  '<p>'.$parent["commentaire"].'</p>';
        echo '</div>';
        echo '<p>pseudo:'.$commentaire["pseudo"].'</p><br>';
        echo '<p>commentaire:'.$commentaire["commentaire"].'</p><br>';
        echo '<a href="index.php?id='.$commentaire["id"].'"><button>repondre</button></a>';
        echo '</div>';
    
        children($commentaire["id"]); //appelle récursive de children 
       
    }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<style>
    .parents{
        width:100%;
        border:1px solid black;
        background:pink;
    }
    .children{
        width:100%;
        border:1px solid black;
        background:lightblue;
    }
    /*
    les commentaires normals sont roses , les réponses aux commentaires sont bleues.
     */
</style>
<body>

    <h1>Commentaires imbriqués</h1>
    <?php if($erreurs): ?>
        <?php foreach($erreurs as $erreur):?>
            <div style="width:100%;height:50px;background:pink;"><?= $erreur ;?></div>
        <?php endforeach ?>
    <?php endif ?>
    <?php if($success): ?>
        <?php foreach($success as $s):?>
            <div style="width:100%;height:50px;background:lightgreen;"><?= $s ;?></div>
        <?php endforeach ?>
    <?php endif ?>
 
    <form method="post">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" name="pseudo" id="pseudo" placeholder="entrez votre pseudo"><br>
        <label for="commentaire">Commentaire</label><br>
        <textarea name="commentaire" id="commentaire" cols="30" rows="10" placeholder="entrez votre commentaire"></textarea><br>
        <button type="submit">Poster</button>
    </form>
    <hr>
    <div>
        <h2>Commentaires</h2> 
    </div>
    <div class="commentaires">
       <?php foreach($commentaires as $commentaire):?>
        
        <?php if(!$commentaire["parent_id"]):?> 
            <!-- les commentaires qui ne sont pas des réponses à d'autres
        commentaires ont des parent_id à null , donc on retire tous 
    les commentaires dont le parent_id n'est pas null , on ne veut pas afficher les réponses
de commentaires à la fin ( on aurait des doublons)-->

        <div class="parents">
            <p>pseudo:<?= $commentaire["pseudo"] ?></p><br>
            <p>commentaire:<br><?= $commentaire["commentaire"] ?></p><br>
            <a href="index.php?id=<?= $commentaire["id"]?>"><button>repondre</button></a>
        </div>
        
        <!-- reponse des commentaires $commentaire["id"]-->
        <!-- selectionne toutes les reponses dont le parent_id = id du commentaire-->
        <?php children($commentaire["id"]);?>

        <?php endif ?>

       <?php endforeach ?>

       <?php 
       
       ?>
    </div>
</body>
</html>