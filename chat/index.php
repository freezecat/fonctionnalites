<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un chat en jquery (Ajax)</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="chat.js" async></script>
</head>
<style>
    .pseudo{
        font-weight:800;
    }
    #smileys{
        width:400px;
        height:auto;
        border:1px solid black;
    }
</style>
<body>
    <h1>Mini chat</h1>
    <div id="alert"></div>
    <div id="postcomment">
        <form method="post">
            <label for="pseudo">pseudo</label><br>
            <input type="text" name="pseudo" id="pseudo" required><br>
            <label for="commentaire">commentaire</label><br>
            <textarea name="commentaire" id="commentaire" cols="30" rows="10" required></textarea><br>
            <!-- introduire ici BBCODE -->
            <div id="rr">ghg</div>  
            <div id="smileys">
                
               <a href="#" class="smileys"id=":tongue"><img src="img/tongue.gif" alt="smiley langue"></a>
               <a href="#" class="smileys"id=":sunglass"><img src="img/sunglass.gif" alt="smiley lunette de soleil"></a>
               <a href="#" class="smileys"id=":ninja"><img src="img/ninja.gif" alt="smiley ninja"></a>
               <a href="#" class="smileys"id=":siffle"><img src="img/siffle.gif" alt="smiley siffle"></a>
               <a href="#" class="smileys"id=":pleure"><img src="img/pleure.gif" alt="smiley pleure"></a>
               <a href="#" class="smileys"id=":diable"><img src="img/diable.gif" alt="smiley diable"></a>
               <a href="#" class="smileys"id=":angry"><img src="img/angry.gif" alt="smiley fache"></a>
               <a href="#" class="smileys"id=":smile"><img src="img/smile.gif" alt="smiley sourire"></a>
               <a href="#" class="smileys"id=":sad"><img src="img/sad.gif" alt="smiley triste"></a>
               <a href="#" class="smileys"id=":loveit"><img src="img/loveit.gif" alt="smiley aime"></a>
               
            </div><br>
            <button type="submit">poster</button>
        </form>
    </div>
    <hr>
    <div id="chat">
      
    </div>
</body>
</html>