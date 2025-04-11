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
