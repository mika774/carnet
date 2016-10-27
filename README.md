# Carnet
Code source d'un carnet d'entretien de véhicules qui vous permet de créer vos véhicules et d'y ajouter toutes les réparations que vous avez faite dessus.

<h1>Installation</h1>

<h2>1. Récupérer le code</h2>

Vous avez 2 solutions : 
<ul>
  <li>Via Git, en clonant le dépôt ;</li>
  <li>Via le téléchargement du code source à cette adresse : <a href="https://github.com/mika774/carnet/archive/master.zip">https://github.com/mika774/carnet/archive/master.zip</a></li>
</ul>

<h2>2. Définir vos paramètres d'application</h2>
<p>Pour ne pas qu'on se partage tous nos mots de passe, le fichier <strong>app/config/parameters.yml</strong> est ignoré dans ce dépôt. A la place, vous avez le fichier <strong>parameters.yml.dist</strong> que vous devez renommer (enlevez le .dist) et modifier.</p>

<h2>3. Télécharger les vendors</h2>
<p>Avec la commande suivante : <strong>php composer.phar install</strong></p>

<h2>4. Créer la base de données</h2>
Cela se fait en 3 étapes.<br />
<ul>
  <li>1. Créer la base de données : <strong>php bin/console doctrine:database:create</strong></li>
  <li>2. Créer les tables correspondantes au schéma Doctrine : <strong>php bin/console doctrine:schema:update --force</strong></li>
  <li>3. Ajouter les fixtures de l'entité Reparation : <strong>php bin/console doctrine:fixtures:load</strong></li>
</ul>
