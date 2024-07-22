<h1>Ajouter un avis</h1>
<form method="post" action="index.php?page=avis_add">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="contenu">Contenu de l'avis</label>
        <textarea name="contenu" id="contenu" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>