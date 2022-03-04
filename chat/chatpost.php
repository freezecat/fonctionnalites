<?php
$pdo = new PDO("mysql:host=localhost;dbname=chat","root","");
if($_POST){
    extract($_POST);
    if(!empty(trim($pseudonyme) && !empty(trim($comment)))){
        //echo "reponse de PHP:".$pseudonyme." ".$comment."<br>";
        $pseudonyme = htmlspecialchars(trim($pseudonyme));
        $comment = htmlspecialchars(trim($comment));
        $sql = "INSERT INTO chat(pseudo,commentaire) VALUES(:pseudo,:commentaire)";
        $pdostatement = $pdo->prepare($sql);
        $pdostatement->execute(array(
            ":pseudo"=>$pseudonyme,
            ":commentaire"=>$comment
        ));
        
        
          
        }
        return "Erreur technique qui empêche le message d'afficher.";
    }

 
    
    
    

    
