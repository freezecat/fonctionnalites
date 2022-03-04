<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <head>
     
    </head>
    <main>
        <?php if(isset($msg)):?>
            <?php foreach($msg as $message): ?>
            <div class="msg"><?= $message ?></div>
            <?php endforeach ?>
        <?php endif;?>