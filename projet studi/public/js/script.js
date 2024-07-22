document.addEventListener('DOMContentLoaded', function() {
    initializeCarousel();
    loadAnimals();
    loadHabitats();
    setupContactForm();
    setupFilters();
    chargerAvisValides();
    setupHabitatTooltips();
    setupSideNavModals();
    setupSearchBar();
    setupDiscoveryModals();
});

function initializeCarousel() {
    const carousel = new bootstrap.Carousel(document.querySelector('#headerCarousel'), {
        interval: 5000,
        wrap: true
    });
}
function createCard(item, type) {
    if (type === 'habitat') {
        const safeId = item.name.replace(/[^a-z0-9]/gi, '');
        return `
            <div class="col-md-4 mb-4">
                <div class="card habitat-card h-100">
                    <img src="${item.image}" class="card-img-top" alt="${item.name}">
                    <div class="animal-count">${item.animals.length} animaux</div>
                    <div class="card-body">
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text">${item.description}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-discover" data-bs-toggle="modal" data-bs-target="#habitatModal-${safeId}">Découvrir</button>
                    </div>
                    <div class="habitat-tooltip">
                        <h6>Animaux de cet habitat :</h6>
                        <ul>
                            ${item.animals.map(animal => `
                                <li>
                                    <strong>${animal.name}</strong> (${animal.species})
                                    <br>Régime : ${animal.diet}
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                </div>
            </div>
        `;
    }
    // ... le reste de la fonction pour les autres types de cartes
}

function loadAnimals() {
    fetch('get_animals.php')
        .then(response => response.json())
        .then(animals => {
            const animalGrid = document.getElementById('animal-grid');
            if (animalGrid) {
                animalGrid.innerHTML = animals.map(animal => createCard(animal, 'animal')).join('');
                setupAnimalModals();
                setupFilters();
                hideAllExceptThreeRandom();
            }
        })
        .catch(error => console.error('Erreur lors du chargement des animaux:', error));
}

function loadHabitats() {
    const animalsByHabitat = groupAnimalsByHabitat(animals);
    
    const habitats = Array.from(animalsByHabitat.entries()).map(([habitatName, habitatAnimals]) => ({
        name: habitatName,
        description: `Habitat des ${habitatAnimals.length} animaux listés ci-dessous.`,
        image: `images/habitats/${habitatName.toLowerCase().replace(/\s+/g, '_')}.jpg`,
        animals: habitatAnimals
    }));

    const habitatGrid = document.getElementById('habitat-grid');
    if (habitatGrid) {
        habitatGrid.innerHTML = habitats.map(habitat => createCard(habitat, 'habitat')).join('');
        setupHabitatModals(habitats);
    }
}

function setupFilters() {
    const filterButtons = document.querySelectorAll('.btn-filter');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter').toLowerCase();
            filterAnimals(filter);
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
}

function filterAnimals(filter) {
    const animalItems = document.querySelectorAll('.animal-item');
    animalItems.forEach(item => {
        const habitat = item.getAttribute('data-habitat').toLowerCase();
        const diet = item.getAttribute('data-diet').toLowerCase();
        if (filter === 'all' || habitat === filter || diet === filter) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function setupContactForm() {
    const form = document.getElementById('formulaire-contact');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const formProps = Object.fromEntries(formData);
            console.log('Données du formulaire:', formProps);
            alert('Merci pour votre message ! Nous vous contacterons bientôt.');
            form.reset();
        });
    }
}

function chargerAvisValides() {
    const avisValides = [
        { pseudo: "Alice", commentaire: "Une expérience incroyable ! Les animaux sont magnifiques." },
        { pseudo: "Bob", commentaire: "Très instructif et amusant pour toute la famille." },
        { pseudo: "Charlie", commentaire: "J'ai adoré la visite guidée, le guide était passionnant." }
    ];

    const carousel = document.querySelector('#avis-carousel .carousel-inner');
    avisValides.forEach((avis, index) => {
        const item = document.createElement('div');
        item.className = `carousel-item ${index === 0 ? 'active' : ''}`;
        item.innerHTML = `
            <div class="avis-content">
                <h5>${avis.pseudo}</h5>
                <p>${avis.commentaire}</p>
            </div>
        `;
        carousel.appendChild(item);
    });
}

function setupHabitatTooltips() {
    const habitatCards = document.querySelectorAll('.habitat-card');
    habitatCards.forEach(card => {
        card.addEventListener('touchstart', function(e) {
            e.preventDefault();
            habitatCards.forEach(c => c.classList.remove('touch-active'));
            this.classList.add('touch-active');
        });
    });

    document.addEventListener('touchstart', function(e) {
        if (!e.target.closest('.habitat-card')) {
            habitatCards.forEach(c => c.classList.remove('touch-active'));
        }
    });
}

function setupAnimalModals() {
    fetch('get_animals.php')
        .then(response => response.json())
        .then(animals => {
            const modalContainer = document.createElement('div');
            modalContainer.id = 'animal-modals';
            
            animals.forEach(animal => {
                const safeId = animal.name.replace(/[^a-z0-9]/gi, '');
                const modalId = `animalModal-${safeId}`;
                const modal = `
                    <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="${modalId}Label">${animal.name}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="carousel-${safeId}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            ${animal.images.map((img, index) => `
                                                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                                    <img src="${img}" class="d-block w-100" alt="${animal.name}">
                                                </div>
                                            `).join('')}
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-${safeId}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-${safeId}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="animal-details mt-3">
                                        <p><strong>Prénom:</strong> ${animal.firstName}</p>
                                        <p><strong>Espèce:</strong> ${animal.species}</p>
                                        <p><strong>Habitat:</strong> ${animal.habitat}</p>
                                        <p><strong>Régime alimentaire:</strong> ${animal.diet}</p>
                                        <p><strong>État:</strong> ${animal.etat}</p>
                                        <p><strong>Nourriture proposée:</strong> ${animal.nourritureProposee}</p>
                                        <p><strong>Grammage:</strong> ${animal.grammageNourriture} g</p>
                                        <p><strong>Date de passage:</strong> ${animal.datePassage}</p>
                                        <p><strong>Détails de l'état:</strong> ${animal.detailEtat}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                modalContainer.innerHTML += modal;
            });

            document.body.appendChild(modalContainer);
        })
        .catch(error => console.error('Erreur lors du chargement des modales des animaux:', error));
}

function setupHabitatModals(habitats) {
    const modalContainer = document.createElement('div');
    modalContainer.id = 'habitat-modals';
    
    habitats.forEach(habitat => {
        const safeId = habitat.name.replace(/[^a-z0-9]/gi, '');
        const modalId = `habitatModal-${safeId}`;
        const modal = `
            <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="${modalId}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="${modalId}Label">${habitat.name}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="${habitat.image}" class="img-fluid mb-3" alt="${habitat.name}">
                            <p>${habitat.description}</p>
                            <h6>Animaux dans cet habitat :</h6>
                            <ul>
                                ${habitat.animals.map(animal => `
                                    <li>${animal.name} (${animal.species}) - ${animal.diet}</li>
                                `).join('')}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        `;
        modalContainer.innerHTML += modal;
    });

    document.body.appendChild(modalContainer);
}

function setupSideNavModals() {
    const sideNavItems = document.querySelectorAll('.side-nav-item');
    sideNavItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const modalId = this.getAttribute('data-modal');
            if (modalId) {
                const modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            }
        });
    });
}

function setupDiscoveryModals() {
    const discoveryCards = document.querySelectorAll('#points-forts .card');
    discoveryCards.forEach(card => {
        card.addEventListener('click', function() {
            const cardTitle = this.querySelector('.card-title').textContent;
            let modalId;
            switch(cardTitle) {
                case 'Diversité Animale':
                    modalId = 'diversiteAnimaleModal';
                    loadAnimalCards();
                    break;
                case 'Habitats Naturels':
                    modalId = 'habitatsNaturelsModal';
                    loadHabitatCards();
                    break;
                case 'Conservation':
                    modalId = 'conservationModal';
                    break;
            }
            if (modalId) {
                const modal = new bootstrap.Modal(document.getElementById(modalId));
                modal.show();
            }
        });
    });
}

function loadAnimalCards() {
    fetch('get_animals.php')
        .then(response => response.json())
        .then(animals => {
            const modalAnimalGrid = document.getElementById('modalAnimalGrid');
            modalAnimalGrid.innerHTML = animals.map(animal => createCard(animal, 'animal')).join('');
        })
        .catch(error => console.error('Erreur lors du chargement des cartes d\'animaux:', error));
}

function loadHabitatCards() {
    const modalHabitatGrid = document.getElementById('modalHabitatGrid');
    modalHabitatGrid.innerHTML = habitats.map(habitat => createCard(habitat, 'habitat')).join('');
}

function setupSearchBar() {
    const searchBar = document.getElementById('searchBar');
    if (searchBar) {
        searchBar.addEventListener('keyup', function(event) {
            const searchText = event.target.value.toLowerCase();
            const animalItems = document.querySelectorAll('.animal-item');
            animalItems.forEach(item => {
                const animalName = item.querySelector('.animal-name').textContent.toLowerCase();
                if (animalName.includes(searchText)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
}

function hideAllExceptThreeRandom() {
    const animalItems = document.querySelectorAll('.animal-item');
    const totalAnimals = animalItems.length;
    
    if (totalAnimals <= 3) return;

    const indices = Array.from(Array(totalAnimals).keys());
    for (let i = indices.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [indices[i], indices[j]] = [indices[j], indices[i]];
    }

    const visibleIndices = indices.slice(0, 3);
    animalItems.forEach((item, index) => {
        item.style.display = visibleIndices.includes(index) ? 'block' : 'none';
    });
}

function groupAnimalsByHabitat(animals) {
    const habitatMap = new Map();

    animals.forEach(animal => {
        if (!habitatMap.has(animal.habitat)) {
            habitatMap.set(animal.habitat, []);
        }
        habitatMap.get(animal.habitat).push(animal);
    });

    return habitatMap;
}