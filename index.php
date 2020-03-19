<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test hebergeur d'images</title>
    <link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container" >
  <div class="alert alert-primary mx-auto mt-4 text-center" style="height:400px; width:600px;">
    <h1 class="mt-1">Heberger votre image</h1>


    <?php

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $error = 1;
      if ( $_FILES['image']['size'] < 3000000) {
        $informationsImage = pathinfo($_FILES['image']['name']);
        $imageExtension = $informationsImage['extension'];
        $extensions = array('jpg','jpeg','png');
        if (in_array($imageExtension,$extensions)) {
          $adresse = 'serveur/'.time().rand().'.'.$imageExtension;
          //send img on server
          move_uploaded_file($_FILES['image']['tmp_name'],$adresse);
          $error = 0;

        }else{
          echo 'l image n\'est pas au bon format';
        }
      }else {
        echo 'Le fichier est trop volumineux';
      }

    } else {
      echo 'L image n\'a pas été téléchargée';
    }
    ?>

    <?php
      if (isset($error) && $error == 0) {
    ?>
        <div>
          <img src="<?php echo $adresse ?>" id="image" />
          <div class="m-2" style="background: white"> <?php echo 'localhost/jl/php/hebergeur_images/'.$adresse ?> </div>
        </div>
    <?php
      }
      ?>

      <form method="post" action="index.php" enctype="multipart/form-data">
              <input class="mb-4" type="file" required name="image" /><br />
              <button type="submit">Héberger</button>
      </form>


</div>
</div>


</body>

</html>
