<h1>Nourrir <?= $animal->getName() ?></h1>
<form method="post" action="index.php?page=employee_feed_animal&id=<?= $animal->getId() ?>">
    <div class="form-group">
        <label for="food">Nourriture</label>
        <input type="text" name="food" id="food" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="quantity">Quantité</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>