<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
</head>

<?php include_once('header.php'); ?>
<?php include_once('login.php'); ?>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <br>
        

        <h1>Ajouter une recette</h1>
            <form action="<?php echo ($rootUrl . 'post_create.php'); ?>" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label"> Titre de la recette</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                    <div id="title-help" class="form-text"> Choissisez un titre percutant ! </div>
                </div>
                <div class="mb-3">
                    <label for="recipe" class="form-label"> Description de la recette </label>
                    <textarea class="form-control" placeholder="Seulement du contenu vous appartenant">  </textarea>
                    
                </div>

                <button type="submit" class="btn btn-primary"> Envoyer </button>
            </form>

         <br />
    </div>

    
</body>
</html>