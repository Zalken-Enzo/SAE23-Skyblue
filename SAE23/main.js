var swiper = new Swiper(".home", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

// Sélectionner tous les boutons "Ajouter au panier"
const addToCartButtons = document.querySelectorAll('.add-to-cart');

// Ajoute un événement à chaque bouton
addToCartButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        // Trouver le titre du film
        const title = event.target.closest('.box').querySelector('h2').innerText;

        // Trouver la quantité sélectionnée
        const quantityInput = event.target.closest('.box').querySelector('input[name="quantity"]');
        const quantity = parseInt(quantityInput.value);

        // Afficher une alerte avec le titre du film et la quantité
        alert(`Vous avez ajouté ${quantity} exemplaire(s) de "${title}" au panier.`);
    });
});

document.addEventListener('DOMContentLoaded', function() {
  // Clic sur le bouton du nom de l'utilisateur pour afficher/masquer le menu déroulant
  const userMenuBtn = document.getElementById('userMenuBtn');
  const userMenu = document.getElementById('userMenu');

  if (userMenuBtn) { // Assurez-vous que le bouton existe sur la page
      userMenuBtn.addEventListener('click', function(e) {
          e.stopPropagation();
          if (userMenu.style.display === 'block') {
              userMenu.style.display = 'none';
          } else {
              userMenu.style.display = 'block';
          }
      });

      // Fermer le menu si l'utilisateur clique en dehors
      window.addEventListener('click', function() {
          userMenu.style.display = 'none';
      });
  }
});
