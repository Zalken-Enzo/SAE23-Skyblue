 <?php

    function creationPanier() {

        if (!isset($_SESSION['panier'])){
            $_SESSION['panier']=array();
            $_SESSION['panier']['nomProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['imageProduit'] = array(); // Ajout pour stocker les images
            $_SESSION['panier']['verrou'] = false;
         }
         return true;
    }

    function isVerrouille() {
      return isset($_SESSION['panier']['verrou']) && $_SESSION['panier']['verrou'] == true;
  }
  

    function ajouterArticle($nomProduit,$qteProduit,$prixProduit, $imageProduit = "default.jpg")  {

        // Si le panier existe
        if (creationPanier() && !isVerrouille())
        {
           // Si le produit existe déjà on ajoute seulement la quantité
           $positionProduit = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);
     
           if ($positionProduit !== false)
           {
              $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
           }
           else
           {
              //Sinon on ajoute le produit
              array_push( $_SESSION['panier']['nomProduit'],$nomProduit);
              array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
              array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
              array_push($_SESSION['panier']['imageProduit'], $imageProduit); // Ajout de l'image

           }
        }
        else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
     }

     function supprimerArticle($nomProduit) {

        //Si le panier existe
        if (creationPanier() && !isVerrouille())
        {
           //Nous allons passer par un panier temporaire
           $tmp=array();
           $tmp['nomProduit'] = array();
           $tmp['qteProduit'] = array();
           $tmp['prixProduit'] = array();
           $tmp['verrou'] = $_SESSION['panier']['verrou'];
     
           for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
           {
              if ($_SESSION['panier']['nomProduit'][$i] !== $nomProduit)
              {
                 array_push( $tmp['nomProduit'],$_SESSION['panier']['nomProduit'][$i]);
                 array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                 array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
              }
     
           }
           //On remplace le panier en session par notre panier temporaire à jour
           $_SESSION['panier'] =  $tmp;
           //On efface notre panier temporaire
           unset($tmp);
        }
        else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
     }

     function modifierQTeArticle($nomProduit,$qteProduit) {

      //Si le panier existe
      if (creationPanier() && !isVerrouille())
      {
         //Si la quantité est positive on modifie sinon on supprime l'article
         if ($qteProduit > 0)
         {
            //Recherche du produit dans le panier
            $positionProduit = array_search($nomProduit,  $_SESSION['panier']['nomProduit']);
   
            if ($positionProduit !== false)
            {
               $_SESSION['panier']['qteProduit'][$positionProduit] = max(1, (int)$qteProduit);
            }
         }
         else
         supprimerArticle($nomProduit);
      }
      else
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";

   }

   function MontantGlobal() {

      $total=0;
      for($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++)
      {
         $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
      }
      return $total;

   }

   function montantTotal() {
      $total = 0;
      if (isset($_SESSION['panier']) && !empty($_SESSION['panier']['nomProduit'])) {
          for ($i = 0; $i < count($_SESSION['panier']['nomProduit']); $i++) {
              $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
          }
      }
      return $total;
  }
  

   function compterArticles() {

      if (isset($_SESSION['panier']))
      return count($_SESSION['panier']['nomProduit']);
      else
      return 0;
   
   }

   function supprimePanier() {

      $_SESSION['panier'] = array();
   
   }

   