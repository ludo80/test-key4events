<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= $baseUrl ?>/home">
        <img src="<?= $baseUrl ?>/assets/images/Logo-background-key4events.png" height="30" alt="">
    </a>
    <?php if (isset($_SESSION['user'])) : ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?= $baseUrl ?>/home">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= $baseUrl ?>/logout">Déconnexion</a>
            </li>
        </ul>
        <a href="<?= $baseUrl ?>/profile/<?= $_SESSION['userId']; ?>" class="text-muted border p-1 pr-2">
            <img class="mb-1" src="<?= $baseUrl ?>/assets/images/profile-icon.png" height="18" alt="">
            <?= $_SESSION['user']; ?>
        </a>
    </div>
    <?php endif; ?>
</nav>