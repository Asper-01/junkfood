<?php
require_once 'action.php';
require_once "header.php";
?>

<body>
    <div class="container-fluid">
        <div class="create-form">
            <h1>Contactez nous</h1>
            <form action="submit_contact.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Votre adresse e-mail" name="email" aria-describedby="email-help">
                    <div id="email-help" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Votre message</label>
                    <textarea class="form-control" placeholder="Exprimez vous" id="message" name="message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Envoyer</button>
            </form>
            <br />
        </div>
    </div>