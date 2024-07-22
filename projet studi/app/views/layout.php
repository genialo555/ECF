

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Arcadia - Une expérience naturelle unique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <span class="logo-text">Zoo Arcadia</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#animaux">Animaux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#habitats">Habitats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#visiter">Visiter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#actualites">Actualités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white" href="#billetterie">Billetterie</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="modal fade" id="animalModal" tabindex="-1" aria-labelledby="animalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="animalModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="animalCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                   
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#animalCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#animalCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              <div class="animal-details mt-3">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="habitatModal" tabindex="-1" aria-labelledby="habitatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="habitatModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
            </div>
          </div>
        </div>
    </div>
        
<div class="modal fade" id="diversiteAnimaleModal" tabindex="-1" aria-labelledby="diversiteAnimaleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="diversiteAnimaleModalLabel">Notre Diversité Animale</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Découvrez la richesse de notre faune avec plus de 100 espèces réparties dans nos différents habitats.</p>
          <div class="row" id="modalAnimalGrid">
          
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="habitatsNaturelsModal" tabindex="-1" aria-labelledby="habitatsNaturelsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="habitatsNaturelsModalLabel">Nos Habitats Naturels</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Explorez nos 6 écosystèmes reconstitués, conçus pour offrir à nos animaux un environnement aussi proche que possible de leur habitat naturel.</p>
          <div class="row" id="modalHabitatGrid">
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
 
  <div class="modal fade" id="conservationModal" tabindex="-1" aria-labelledby="conservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="conservationModalLabel">Notre Engagement pour la Conservation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Au Zoo Arcadia, notre mission va bien au-delà de la simple présentation d'animaux exotiques. Nous sommes profondément engagés dans la protection et la préservation des espèces menacées à travers le monde.</p>
          <p>Notre programme de conservation s'articule autour de trois axes principaux :</p>
          <ul>
            <li><strong>Reproduction en captivité :</strong> Nous participons activement à des programmes d'élevage pour les espèces en danger, contribuant ainsi à maintenir des populations viables.</li>
            <li><strong>Recherche scientifique :</strong> Nos équipes collaborent avec des universités et des centres de recherche pour améliorer notre compréhension des espèces menacées et développer de meilleures stratégies de conservation.</li>
            <li><strong>Éducation et sensibilisation :</strong> Nous organisons régulièrement des ateliers, des conférences et des activités interactives pour sensibiliser le public à l'importance de la biodiversité et aux enjeux de la conservation.</li>
          </ul>
          <p>De plus, nous soutenons financièrement plusieurs projets de conservation in situ dans différents pays, contribuant directement à la protection des habitats naturels et des espèces qui y vivent.</p>
          <p>Chaque visite au Zoo Arcadia, chaque adoption d'animal, chaque don, aussi petit soit-il, contribue à ces efforts vitaux de conservation. Ensemble, nous pouvons faire la différence pour l'avenir de notre planète et de sa remarquable biodiversité.</p>
        </div>
      </div>
    </div>
  </div>
      <header id="accueil">
        <div id="headerCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/header1.jpg" class="d-block w-100" alt="Zoo Arcadia 1">
                    <div class="carousel-caption">
                        <h1>Bienvenue au Zoo Arcadia</h1>
                        <p>Découvrez la magie de la nature dans notre zoo écologique</p>
                        <a href="#animaux" class="btn btn-primary btn-lg">Découvrir nos animaux</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/header2.jpg" class="d-block w-100" alt="Zoo Arcadia 2">
                    <div class="carousel-caption">
                        <h1>Bienvenue au Zoo Arcadia</h1>
                        <p>Plongez au cœur de la biodiversité dans notre oasis écologique</p>
                        <a href="#animaux" class="btn btn-primary btn-lg">Découvrir nos animaux</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/header3.jpg" class="d-block w-100" alt="Zoo Arcadia 3">
                    <div class="carousel-caption">
                        <h1>Bienvenue au Zoo Arcadia</h1>
                        <p>Découvrez la magie de la nature dans notre zoo écologique</p>
                        <a href="#animaux" class="btn btn-primary btn-lg">Découvrir nos animaux</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/header4.jpg" class="d-block w-100" alt="Zoo Arcadia 4">
                    <div class="carousel-caption">
                        <h1>Bienvenue au Zoo Arcadia</h1>
                        <p>Rencontrez des espèces rares et préservées dans notre havre de paix</p>
                        <a href="#animaux" class="btn btn-primary btn-lg">Découvrir nos animaux</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/header5.jpg" class="d-block w-100" alt="Zoo Arcadia 5">
                    <div class="carousel-caption">
                        <h1>Bienvenue au Zoo Arcadia</h1>
                        <p>Explorez les merveilles du règne animal dans notre sanctuaire naturel</p>
                        <a href="#animaux" class="btn btn-primary btn-lg">Découvrir nos animaux</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#headerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#headerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
        <section id="points-forts" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Découvrez Zoo Arcadia</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100" style="cursor: pointer;">
                            <div class="card-body text-center">
                                <i class="fas fa-paw fa-3x mb-3 text-primary"></i>
                                <h3 class="card-title">Diversité Animale</h3>
                                <p class="card-text">Plus de 100 espèces à découvrir dans nos différents habitats.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100" style="cursor: pointer;">
                            <div class="card-body text-center">
                                <i class="fas fa-tree fa-3x mb-3 text-success"></i>
                                <h3 class="card-title">Habitats Naturels</h3>
                                <p class="card-text">6 écosystèmes reconstitués pour le bien-être de nos animaux.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100" style="cursor: pointer;">
                            <div class="card-body text-center">
                                <i class="fas fa-hand-holding-heart fa-3x mb-3 text-danger"></i>
                                <h3 class="card-title">Conservation</h3>
                                <p class="card-text">Engagés dans la protection des espèces menacées.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </header>

    <div class="side-nav">
        <a href="#" class="side-nav-item" data-modal="billeterieModal">
            <i class="fas fa-ticket-alt"></i>
            <span>Billetterie</span>
        </a>
        <a href="#" class="side-nav-item" data-modal="venirModal">
            <i class="fas fa-map-marker-alt"></i>
            <span>Comment venir ?</span>
        </a>
        <a href="#" class="side-nav-item" data-modal="agendaModal">
            <i class="fas fa-calendar-alt"></i>
            <span>Agenda</span>
        </a>
        <a href="#" class="side-nav-item" data-modal="parrainerModal">
            <i class="fas fa-paw"></i>
            <span>Parrainer un animal</span>
        </a>
        <a href="#" class="side-nav-item" data-modal="boutique">
            <i class="fas fa-shopping-bag"></i>
            <span>E-boutique</span>
        </a>
    </div>
                 
<div class="modal fade" id="billeterieModal" tabindex="-1" aria-labelledby="billeterieModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="billeterieModalLabel">Acheter un billet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Réservez vos billets en ligne pour une expérience sans attente. Profitez de nos tarifs préférentiels et de nos offres spéciales.</p>
        <a href="#" class="btn btn-primary">Réserver maintenant</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="venirModal" tabindex="-1" aria-labelledby="venirModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="venirModalLabel">Comment venir ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Le Zoo Arcadia est facilement accessible en voiture et en transports en commun. Consultez notre plan d'accès et nos conseils pour préparer votre visite.</p>
        <a href="#" class="btn btn-primary">Voir le plan d'accès</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="agendaModal" tabindex="-1" aria-labelledby="agendaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agendaModalLabel">Agenda des événements</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Découvrez nos prochains événements, animations et ateliers. Ne manquez pas nos moments forts !</p>
        <a href="#" class="btn btn-primary">Voir l'agenda complet</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="parrainerModal" tabindex="-1" aria-labelledby="parrainerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="parrainerModalLabel">Parrainer un animal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Contribuez à la protection des espèces en parrainant un de nos animaux. Recevez des nouvelles régulières et des avantages exclusifs.</p>
        <a href="#" class="btn btn-primary">Découvrir le parrainage</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="boutique" tabindex="-1" aria-labelledby="boutiqueModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="boutiqueModalLabel">E-boutique</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Découvrez notre sélection de souvenirs, peluches et produits éco-responsables. Chaque achat soutient nos actions de conservation.</p>
        <a href="#" class="btn btn-primary">Visiter la boutique</a>
      </div>
    </div>
  </div>
</div>

    <main>
        <section id="avis-valides" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Avis de nos visiteurs</h2>
                <div id="avis-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                       
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#avis-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#avis-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>
        </section>
        <section id="animaux" class="py-5 section-animaux">
            <div class="container">
                <h2 class="text-center mb-5">Nos Stars</h2>
                <div class="filter-buttons mb-4">
                    <button class="btn btn-filter" data-filter="all">Tous</button>
                    <button class="btn btn-filter" data-filter="savane africaine">Savane africaine</button>
                    <button class="btn btn-filter" data-filter="forêt tropicale">Forêt tropicale</button>
                    <button class="btn btn-filter" data-filter="banquise arctique">Banquise arctique</button>
                    <button class="btn btn-filter" data-filter="forêt tempérée">Forêt tempérée</button>
                    <button class="btn btn-filter" data-filter="désert">Désert</button>
                    <button class="btn btn-filter" data-filter="récif corallien">Récif corallien</button>
                    <button class="btn btn-filter" data-filter="carnivore">Carnivores</button>
                    <button class="btn btn-filter" data-filter="herbivore">Herbivores</button>
                    <button class="btn btn-filter" data-filter="omnivore">Omnivores</button>
                </div>
                <div class="mb-4">
                    <input type="text" id="searchBar" class="form-control" placeholder="Rechercher un animal...">
                </div>
                <div class="row" id="animal-grid">
                  
                </div>
            </div>
        </section>
        <script type="module"></script>
        
        <section id="habitats" class="py-5 section-habitats">
            <div class="container">
                <h2 class="text-center mb-5">Nos Habitats</h2>
                <div class="row" id="habitat-grid">
                  
                </div>
            </div>
        </section>

        <section id="services" class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Nos Services</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-signs fa-3x mb-3"></i>
                                <h3 class="card-title">Visites guidées</h3>
                                <p class="card-text">Explorez le zoo avec nos experts passionnés</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-utensils fa-3x mb-3"></i>
                                <h3 class="card-title">Restauration</h3>
                                <p class="card-text">Savourez des plats locaux et durables</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-train fa-3x mb-3"></i>
                                <h3 class="card-title">Petit train</h3>
                                <p class="card-text">Découvrez le zoo confortablement installé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="avis" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">Laissez votre avis</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form id="formulaire-avis">
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Votre pseudo" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Votre commentaire" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Soumettre votre avis</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3 mb-md-0">
                    <h3>Zoo Arcadia</h3>
                    <p>123 Rue de la Nature, 75000 Paris</p>
                    <p>Tél : 01 23 45 67 89</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h3>Liens rapides</h3>
                    <ul class="list-unstyled">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#animaux">Animaux</a></li>
                        <li><a href="#habitats">Habitats</a></li>
                        <li><a href="#services">Services</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h3>Suivez-nous</h3>
                    <div class="social-icons">
                        <a href="#" class="me-3"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3>Espace éleveur</h3>
                    <a href="#" class="btn btn-outline-light">Connexion éleveur</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>&copy; 2024 Zoo Arcadia. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>



</div>
</body>
</html>
