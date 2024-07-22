<h1>Avis de nos visiteurs</h1>
<div class="row">
    <?php foreach ($avis as $a): ?>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $a->getPseudo() ?></h5>
                    <p class="card-text"><?= $a->getContenu() ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>