<section>
    <h2 class="text-center my-3">Utilisateurs enregistrés</h2>
    <div class="d-flex flex-wrap">
        <?php foreach ($users as $user) : ?>
        <div class="my-1 col-sm-6 col-lg-4 col-xl-3" id="profile-tag">
            <a href="<?= $baseUrl ?>/profile/<?= $user->getId() ?>" class="list-group-item list-group-item-action <?= $user->getRole() == 'role_admin' ? 'bg-light' : ''; ?>">
                <?= $user->getLastname().' '.$user->getFirstname(); ?> 
                <small class="font-italic" id="profile-role"><?= $user->getRole() == 'role_admin' ? 'Administrateur' : 'Utilisateur'; ?></small>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-center py-2 mt-3 bg-dark">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addModal">Ajouter un utilisateur</button>
    </div>
</section>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Nouvel Utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $baseUrl ?>/profile/create" id="addUser" method="POST" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Nom</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" required>
                        <div class="invalid-feedback">Veuillez entrer un nom</div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Prénom</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" required>
                        <div class="invalid-feedback">Veuillez entrer un prénom</div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Veuillez entrer une adresse email valide</div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Privilèges</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="role_user">Utilisateur</option>
                            <option value="role_admin">Administrateur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Laisser libre si inchangé" required>
                        <small id="passwordHelp" class="form-text text-muted">Minimum 8 caractères</small>
                        <div class="invalid-feedback">Veuillez entrer un mot de passe</div>
                    </div>
                    <div class="form-group">
                        <label for="checkpassword" class="col-form-label">Vérification du mot de passe</label>
                        <input type="password" name="checkpassword" class="form-control" id="checkpassword" aria-describedby="checkPasswordHelp" placeholder="Laisser libre si inchangé" required>
                        <small id="checkPasswordHelp" class="form-text text-muted">Minimum 8 caractères</small>
                        <div class="invalid-feedback">Veuillez confirmer le mot de passe</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="addSubmit">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>