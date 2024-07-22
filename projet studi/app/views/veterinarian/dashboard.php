<h1>Tableau de bord vétérinaire</h1>
<h2>Liste des animaux</h2>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Espèce</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($animals as $animal): ?>
            <tr>
                <td><?= $animal->getName() ?></td>
                <td><?= $animal->getSpecies() ?></td>
                <td>
                    <a href="index.php?page=veterinarian_examine_animal&id=<?= $animal->getId() ?>" class="btn btn-primary">Examiner</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<form method="get" action="index.php">
    <input type="hidden" name="page" value="employee_dashboard">
    <div class="form-group">
        <input type="text" name="search" id="search" class="form-control" placeholder="Rechercher un animal..." value="<?= $searchTerm ?>">
    </div>
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="index.php?page=employee_dashboard&search=<?= $searchTerm ?>&p=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>