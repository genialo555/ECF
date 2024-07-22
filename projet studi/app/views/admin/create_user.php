<h1>Créer un utilisateur</h1>
<form method="post" action="index.php?page=admin_create_user">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Rôle</label>
        <select name="role" id="role" class="form-control" required>
            <option value="employee">Employé</option>
            <option value="veterinarian">Vétérinaire</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
</form>