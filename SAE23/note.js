// Fonction qui génère une notation en étoiles en fonction de la note donnée (note allant de 0 à 5)
function generateStars(note) {
    // Calcule le nombre d'étoiles pleines (partie entière de la note)
    let fullStars = Math.floor(note);

    // Calcule si une étoile partiellement pleine est nécessaire (si la partie décimale de la note est supérieure ou égale à 0.5)
    let halfStar = (note % 1) >= 0.5 ? 1 : 0;

    // Calcule le nombre d'étoiles vides (5 étoiles au total moins les étoiles pleines et les étoiles partielles)
    let emptyStars = 5 - fullStars - halfStar;

    // Variable qui contiendra le code HTML pour afficher les étoiles
    let starsHTML = '';

    // Ajoute les étoiles pleines (&#9733; représente une étoile pleine)
    for (let i = 0; i < fullStars; i++) {
        starsHTML += '&#9733;';
    }

    // Si une étoile partiellement pleine est nécessaire, on ajoute une demi-étoile
    if (halfStar) {
        starsHTML += '&#9733;';
    }

    // Ajoute les étoiles vides (&#9734; représente une étoile vide)
    for (let i = 0; i < emptyStars; i++) {
        starsHTML += '&#9734;';
    }

    // Met à jour le contenu HTML de l'élément avec l'ID 'stars' pour afficher les étoiles
    document.getElementById('stars').innerHTML = starsHTML;
}