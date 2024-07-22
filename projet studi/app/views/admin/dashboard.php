<h1>Tableau de bord administrateur</h1>
<h2>Liste des utilisateurs</h2>
<table class="table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getRole() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php?page=admin_create_user" class="btn btn-primary">Créer un utilisateur</a>