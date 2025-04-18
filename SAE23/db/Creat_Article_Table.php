<?php
$servername = "localhost";
$username = "root";

// Create connection
$conn = new mysqli($servername, $username);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS mydb ";
$conn -> query($sql);

$sql = "USE mydb;";
$conn -> query($sql);

$sql = "
CREATE TABLE Article (
  id_article mediumint AUTO_INCREMENT PRIMARY KEY,
  titre varchar(100) NOT NULL,
  description varchar(3000) NOT NULL,
  type enum('film', 'série'),
  duree mediumint unsigned NOT NULL,
  annee smallint unsigned NOT NULL,
  prix decimal(8,2) NOT NULL,
  categorie enum('action', 'aventure', 'comédie', 'drame', 'horreur', 'romance', 'science-fiction', 'fantaisie', 'thriller', 'documentaire', 'animation', 'famille'),
  quantite smallint unsigned,
  image varchar(250)
  );";

$conn -> query($sql);

$sql = "
INSERT INTO Article (titre, description, type, duree, annee, prix, categorie, quantite, image) VALUES
  ('Jurassic Park', 'Jurassic Park est un film réalisé par Steven Spielberg. Il raconte l histoire de John Hammond, un milliardaire qui réussit à cloner des dinosaures et à créer un parc d attractions révolutionnaire sur une île isolée. Avant l ouverture officielle, il invite un groupe de scientifiques et ses petits-enfants à découvrir le parc. Mais lorsque les systèmes de sécurité tombent en panne, les visiteurs se retrouvent en danger, traqués par des créatures préhistoriques redevenues les prédateurs ultimes.', 'film', 127, 1993, 14.99, 'aventure', 41, 'jurassic.jpg'),
  ('Avengers: Endgame', 'Avengers: Endgame est un film réalisé par Anthony et Joe Russo. Après les événements dévastateurs causés par Thanos, qui a anéanti la moitié de l univers, les Avengers survivants, aux côtés de leurs alliés, élaborent un plan audacieux pour inverser le cours du temps et ramener leurs proches. Entre sacrifices héroïques et batailles épiques, les héros doivent affronter leur plus grand défi afin de restaurer l équilibre de l univers.', 'film', 181, 2019, 19.99, 'action', 22, 'endgame.jpg'),
  ('The Dark Knight', 'The Dark Knight est un film réalisé par Christopher Nolan. Dans cette suite de Batman Begins, Bruce Wayne, sous l identité de Batman, collabore avec le commissaire Gordon et le procureur Harvey Dent pour éradiquer le crime organisé à Gotham City. Mais leur mission est compromise par l arrivée du Joker, un criminel imprévisible et sadique, qui plonge la ville dans le chaos et pousse Batman à remettre en question ses propres limites.', 'film', 152, 2008, 18.99, 'action', 36, 'darknight.jpg'),
  ('Inception', 'Inception est un film réalisé par Christopher Nolan. Dom Cobb est un voleur d un genre unique : il s infiltre dans les rêves de ses cibles pour leur voler des secrets enfouis dans leur subconscient. Engagé pour une mission encore plus complexe, il doit cette fois implanter une idée dans l esprit d un homme d affaires. Mais plus il s enfonce dans les différents niveaux du rêve, plus la frontière entre réalité et illusion devient floue, menaçant de le piéger à jamais.', 'film', 148, 2010, 15.99, 'science-fiction', 19, 'inception.jpg'),
  ('Mad Max: Fury Road', 'Mad Max: Fury Road est un film réalisé par George Miller. Dans un monde post-apocalyptique désertique où l eau et l essence sont des ressources rares, Imperator Furiosa trahit le tyran Immortan Joe pour libérer un groupe de femmes réduites en esclavage. En fuite à bord d un puissant war rig, elle croise la route de Max Rockatansky, un survivant solitaire. Ensemble, ils affrontent une horde de poursuivants dans une course-poursuite explosive à travers le désert.', 'film', 120, 2015, 17.00, 'action', 26, 'madmax.jpg'),
  ('Gladiator', 'Gladiator est un film réalisé par Ridley Scott. Maximus, un général romain loyal à l empereur Marc Aurèle, est trahi par le fils de ce dernier, Commode, qui le condamne à mort et fait assassiner sa famille. Réduit en esclavage et devenu gladiateur, Maximus gravit les échelons de l arène avec un seul objectif : se venger de Commode et rétablir l honneur de Rome.', 'film', 155, 2000, 18.99, 'action', 51, 'gladiator.jpg'),
  ('Interstellar', 'Interstellar est un film réalisé par Christopher Nolan. Dans un futur où la Terre est en train de devenir inhabitable, un groupe d explorateurs mené par l ancien pilote de la NASA Cooper est envoyé à travers un trou de ver près de Saturne pour trouver une nouvelle planète capable d accueillir l humanité. Alors qu il s éloigne de sa fille restée sur Terre, Cooper découvre que le voyage dans l espace et le temps réserve des défis bien plus complexes que prévu, remettant en question les lois de la physique et le lien qui unit un père à son enfant.', 'film', 169, 2014, 15.99, 'science-fiction', 32, 'interstellar.jpg'),
  ('Joker', 'Joker est un film réalisé par Todd Phillips. À Gotham City, Arthur Fleck, un comédien raté souffrant de troubles mentaux, est rejeté par la société et sombre peu à peu dans la folie. Alors qu il subit humiliations et violences, il adopte une nouvelle identité, celle du Joker, et embrasse une spirale de chaos et de violence qui va bouleverser la ville.', 'film', 122, 2019, 23.99, 'drame', 22, 'joker.jpg'),
  ('Blade Runner', 'Blade Runner est un film réalisé par Ridley Scott. Dans un futur dystopique de 2019, les réplicants, des androïdes créés pour servir les humains dans les colonies spatiales, sont illégaux sur Terre. Rick Deckard, un ancien Blade Runner chargé de traquer et d éliminer les réplicants rebelles, est contraint de revenir à l action pour retrouver un groupe de réplicants en fuite. En poursuivant sa mission, Deckard se retrouve confronté à des questions existentielles sur la nature de l humanité et de l intelligence artificielle.', 'film', 117, 1982, 15.99, 'science-fiction', 26, 'bladerunner.jpg'),
  ('Avatar', 'Avatar est un film réalisé par James Cameron. Sur la planète Pandora, une équipe de scientifiques humains utilise des avatars — des corps génétiquement modifiés — pour interagir avec les habitants autochtones, les Navi. Jake Sully, un ancien marine paralysé, prend la place de son frère décédé et devient l un de ces avatars. Alors qu il s intègre progressivement à la culture Na vi, il se retrouve déchiré entre sa loyauté envers les humains, qui veulent exploiter les ressources de Pandora, et sa nouvelle famille Na vi, déterminée à défendre leur planète.', 'film', 162, 2009, 16.99, 'science-fiction', 29, 'avatar.jpg'),
  ('The Revenant', 'The Revenant est un film réalisé par Alejandro González Iñárritu. Hugh Glass, un trappeur et explorateur du XIXe siècle, est laissé pour mort par ses compagnons après avoir été gravement blessé par un ours. Lorsqu il survit miraculeusement, il entreprend un voyage brutal et solitaire à travers des paysages sauvages pour se venger de ceux qui l ont trahi. Ce film intense explore la résilience humaine et la lutte pour la survie dans un environnement implacable.', 'film', 156, 2015, 17.99, 'drame', 43, 'therevenant.jpg'),
  ('Stranger Things - Saison 1', 'Stranger Things, série réalisée par les frères Duffer, commence avec la disparition mystérieuse de Will Byers dans une petite ville de l Indiana. Ses amis et sa famille, aidés par une étrange jeune fille aux pouvoirs surnaturels, se lancent dans une enquête qui les mène à découvrir un monde parallèle et une organisation secrète impliquée dans des expériences dangereuses.', 'série', 480, 2016, 24.99, 'horreur', 56, NULL),
  ('Game of Thrones - Saison 1', 'Game of Thrones, série réalisée par David Benioff et D.B. Weiss, débute avec l arrivée de l hiver à Westeros et l installation du roi Robert Baratheon sur le trône de fer. L intrigue politique s intensifie alors que plusieurs familles nobles se battent pour le pouvoir, en particulier les Stark du Nord et les Lannister du Sud, tandis que des menaces surnaturelles se profilent à l horizon.', 'série', 540, 2011, 29.99, 'fantaisie', 62, NULL),
  ('Breaking Bad - Saison 1', 'Breaking Bad, série réalisée par Vince Gilligan, suit l évolution de Walter White, un professeur de chimie devenu fabricant de méthamphétamine après avoir appris qu il souffre d un cancer en phase terminale. Dans cette première saison, Walter s associe à Jesse Pinkman, un ancien élève, pour entrer dans le commerce des drogues tout en devant gérer les conséquences de ses choix sur sa famille.', 'série', 360, 2008, 19.99, 'drame', 45, NULL),
  ('The Crown - Saison 1', 'The Crown, série réalisée par Peter Morgan, se concentre sur les premières années du règne de la reine Elizabeth II. Alors qu elle monte sur le trône après la mort de son père, Elizabeth doit faire face aux défis politiques et personnels liés à son rôle de monarque, tout en jonglant avec sa famille et la tradition royale britannique.', 'série', 500, 2016, 27.99, 'drame', 39, NULL),
  ('The Witcher - Saison 1', 'The Witcher, série réalisée par Lauren Schmidt Hissrich, suit Geralt de Riv, un chasseur de monstres solitaire, dans un monde où magie et créatures surnaturelles sont monnaie courante. La saison 1 explore les premières aventures de Geralt, son lien avec la mystérieuse Ciri, et sa quête pour comprendre son destin dans un monde déchiré par la guerre et les complots.', 'série', 450, 2019, 22.99, 'fantaisie', 58, NULL),
  ('Stranger Things - Saison 2', 'Stranger Things, série réalisée par les frères Duffer, continue avec la rentrée scolaire des enfants de Hawkins après les événements de la saison précédente. Alors qu ils essaient de reprendre une vie normale, une nouvelle menace surnaturelle émerge du Monde à l Envers, et Will, toujours marqué par son passage dans cet univers parallèle, lutte contre des visions de plus en plus terrifiantes.', 'série', 480, 2017, 24.99, 'horreur', 46, NULL),
  ('Game of Thrones - Saison 3', 'Game of Thrones, série réalisée par David Benioff et D.B. Weiss, suit l intensification du conflit pour le trône de fer avec l avancée de la guerre des Cinq Rois. La saison 3 est marquée par des événements dramatiques tels que le tristement célèbre Red Wedding, une trahison dévastatrice qui bouleverse l équilibre des pouvoirs à Westeros.', 'série', 540, 2013, 29.99, 'fantaisie', 63, NULL),
  ('Breaking Bad - Saison 5', 'Breaking Bad, série réalisée par Vince Gilligan, atteint son apogée dans cette dernière saison. Walter White, désormais au sommet de son empire de méthamphétamine, se trouve pris dans une spirale de violence et de trahison. Avec ses alliés et ennemis qui se rapprochent, Walter doit faire face aux conséquences de ses choix, avec un final intense et mémorable.', 'série', 360, 2012, 19.99, 'drame', 28, NULL),
  ('The Crown - Saison 2', 'The Crown, série réalisée par Peter Morgan, poursuit l histoire de la reine Elizabeth II alors qu elle navigue dans les années 1950 et 1960, une période marquée par des défis personnels et politiques. La saison 2 explore notamment les tensions croissantes au sein de la famille royale et le déclin du mariage de la reine avec le prince Philip.', 'série', 500, 2017, 27.99, 'drame', 48, NULL),
  ('The Witcher - Saison 2', 'The Witcher, série réalisée par Lauren Schmidt Hissrich, reprend les aventures de Geralt de Riv après les événements dramatiques de la saison 1. Cette saison plonge plus profondément dans la quête de Geralt pour protéger Ciri, la mystérieuse enfant de la prophétie, alors qu une nouvelle menace plane sur eux, venant des créatures de l ombre et des puissants sorciers.', 'série', 450, 2021, 22.99, 'fantaisie', 53, NULL);";
$conn -> query($sql);

$conn -> close();

?>