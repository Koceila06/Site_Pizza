
# Site de Pizza


## Présentation du Site
<p> <strong>Le site permet d'effectuer des commandes de pizza(à emporter), il comporte 3 acteur : </strong></p>
<ul>
<li>Les utilisateurs: ils peuvent parcourir la liste des pizzas, les rajouter au panier, passer la commande et en être informé de son statut</li>
<li>Le gérant (administrateur) du site: il peut rajouter/modifier les pizzas, voir l’état des commandes, ainsi que la recette du jour</li>
 <li>Le pizzaiolo: il peut voir les commandes dans l’ordre et de changer leur statut</li>
 </ul>
 
## Fonctionnalités
<ol>
    <li>
       <strong>Administrateur : </strong></li>
<br/>
<ul>
 <li> Gestion des pizzas :
    <ul> 
      <li>Ajouter une nouvelle pizza</li>
      <li>Voir la liste des pizzas</li>
      <li>Changer le descriptif ou le nom d’une pizza</li>
      <li>«Supprimer» une pizza(une pizza déjà commandée ne peut pas être supprimée définitivement –uniquement en utilisant SoftDelete)</li>  
   </ul>    
 </li>
   
 <li> Gestion des commandes:
    <ul> 
      <li>Afficher la liste des commandes pour une date</li>
      <li>Afficher la liste des commandes du jour triées par le statut et la date</li>
      <li>Afficher la liste de toutes les commandes (avec pagination)</li>
      <li>Afficher la recette du jour</li> 
      <li>Voir le détail d’une commande(pizzaset prix total)</li>   

   </ul> 
   
   
 </li>

 <li> Gestion des utilisateurs :
    <ul> 
      <li>Changer son mot de passe</li>
      <li>Créer un utilisateur administrateur</li>
      <li>Créer un pizzaiolo</li>
      <li>Changer le mot de passe du pizzaiolo</li> 
      <li>Supprimer un utilisateur (admin ou pizzaiolo)</li>   

   </ul>  
 </li>      
 </ul>
 <li><strong> Utlisateurs: </strong></li>
 </ol>
 
 
 
 
 
Le but du jeu est d'aligner une suite de 4 pions de même couleur sur une grille comptant 6 rangées et 7
colonnes. Tour à tour les deux joueurs placent un
pion dans la colonne de leur choix, le pion coulisse alors jusqu'à la position la plus basse possible dans
la colonne à la suite de quoi c'est à l'adversaire de jouer. Le vainqueur est le joueur qui réalise le
premier un alignement (horizontal, vertical ou diagonal) consécutif d'au moins quatre pions de sa
couleur. Si, alors que toutes les cases de la grille de jeu sont remplies, aucun des deux joueurs n'a
réalisé un tel alignement, la partie est déclarée nulle
## Comment jouer ? 
*Pour jouer,il faut chercher la classe "Partie" et l'exécuter,il y'a deux mode de jeu :*
<br/>
<br/>

**Humain vs Humain :** 
<br/>
Les joueurs ont la possibilité de choisir la taille de la grille( elle doit impérativement être supérieure à 4 pour les lignes et les colonnes, sinon ça contredirait le principe du jeu), le choix de colonne se fait selon la volonté du joueur à qui est le tour.
<br/>
<br/>

**Humain vs IA :**
<br/>
Il y a trois niveaux de difficulté de l'IA:
<br/>

1_IA_simple :
<br/>
De même que pour humain vs humain, le joueur peut choisir la taille de la grille, le choix de colonne se fait aléatoirement pour l'IA.
<br/>
2_IA_max :
<br/>
la taille de la grille est fixée( 7 colonnes et 6 lignes), l'IA simule le jeu et attribue un score pour chaque situation tout en dessinant l'arbre du jeu selon la profondeur souhaitée (j'ai choisie la profondeur 5 pour que l'exécution ne soit pas trop longue), l'IA remonte à chaque fois le meilleur score( en utilisant la récurrence) et permet ainsi d'indiquer le meilleur coup à jouer.
<br/>
3_IA_Alpha-Beta :
<br/>
la taille de la grille est fixée( 7 colonnes et 6 lignes), L'IA choisie la colonne à jouer presque de la même façon que IA max mais en réduisant le nombre de nœuds évalué, permettant ainsi pouvoir choisir une profondeur plus grande et en conséquent avoir une IA plus forte.
<br/>
<br/>
*Dans les deux modes de jeu, la partie est automatiquement enregistrée, permettant ainsi aux joueurs de continuer la partie après l'avoir quitté s'ils le souhaitent, sinon rejouer une nouvelle partie.*
## Auteur
Koceila Kemiche
