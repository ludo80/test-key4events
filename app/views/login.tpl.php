<section class="d-flex justify-content-center">
    <div class="col-sm-8 col-lg-4 bg-light py-3 mt-5 border rounded-lg">
        <h5 class="text-white text-center bg-dark py-2 mb-3 rounded">Connexion</h5>
        <form action="<?= $baseUrl ?>/" method="POST" class="d-flex flex-column justify-content-center needs-validation" id="loginForm" novalidate>
            <div class="form-group">
                <label for="emailLogin">E-mail</label>
                <input type="email" name="emailLogin" class="form-control" id="emailLogin" aria-describedby="emailHelp" required>
                <div class="invalid-feedback">Veuillez entrer une adresse email valide</div>
            </div>
            <div class="form-group">
                <label for="passwordLogin">Mot de passe</label>
                <input type="password" name="passwordLogin" class="form-control" id="passwordLogin" required>
                <div class="invalid-feedback">Veuillez fournir un mot de passe</div>
            </div>
            <button type="submit" class="btn btn-primary">Entrer</button>
        </form>
    </div>
</section>