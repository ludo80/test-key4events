<section>
    <div class="card text-center">
        <div class="card-header">
            <h5><?= $user->getLastname().' '.$user->getFirstname(); ?></h5>
            <small><?= $user->getRole() == 'role_admin' ? 'Administrateur' : 'Utilisateur'; ?></small>
        </div>
        <div class="card-body">
            <p class="card-title"><?= $user->getEmail(); ?></p>
            <p class="my-0">Enregistré le <?= date('d-m-Y à H:i', strtotime($user->getCreatedAt())); ?></p>
            <?php if ($user->getUpdatedAt() != null) : ?>
            <p class="my-0">Modifié le <?= date('d-m-Y à H:i', strtotime($user->getUpdatedAt())); ?></p>
            <?php endif; ?>
        </div>
        <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Modifier</button>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deleteModal">Supprimer</button>
        </div>
    </div>
</section>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier Utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $baseUrl ?>/profile/<?= $user->getId(); ?>/update" id="editUser" method="POST" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="lastname" class="col-form-label">Nom</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $user->getLastname(); ?>" required>
                        <div class="invalid-feedback">Veuillez entrer un nom</div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-form-label">Prénom</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $user->getFirstname(); ?>" required>
                        <div class="invalid-feedback">Veuillez entrer un prénom</div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?= $user->getEmail(); ?>" required>
                        <div class="invalid-feedback">Veuillez entrer une adresse email valide</div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Privilèges</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="role_user" <?= $user->getRole() == 'role_user' ? '' : 'selected'; ?>>Utilisateur</option>
                            <option value="role_admin" <?= $user->getRole() == 'role_admin' ? 'selected' : ''; ?>>Administrateur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Laisser libre si inchangé">
                        <small id="passwordHelp" class="form-text text-muted">Minimum 8 caractères</small>
                    </div>
                    <div class="form-group">
                        <label for="checkpassword" class="col-form-label">Confirmer le mot de passe</label>
                        <input type="password" name="checkpassword" class="form-control" id="checkpassword" aria-describedby="checkPasswordHelp" placeholder="Laisser libre si inchangé">
                        <small id="checkPasswordHelp" class="form-text text-muted">Minimum 8 caractères</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" id="editSubmit">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Supprimer Utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $baseUrl ?>/profile/<?= $user->getId(); ?>/delete" id="deleteUser" method="POST">
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                    <p>Vous allez supprimer l'utilisateur <em class="font-weight-bold"><?= $user->getLastname().' '.$user->getFirstname(); ?></em></p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger" id="deleteSubmit">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>