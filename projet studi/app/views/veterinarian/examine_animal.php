<h1>Examiner <?= $animal->getName() ?></h1>
<form method="post" action="index.php?page=veterinarian_examine_animal&id=<?= $animal->getId() ?>">
    <div class="form-group">
        <label for="examination">Résultats de l'examen</label>
        <textarea name="examination" id="examination" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>