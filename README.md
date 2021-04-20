# Blog Symfony


 <h2>Pré-requis</h2>
 
  <ul>
      <li>Installer le framework Symfony</li>
      <li>Installer PHP v2.3</li>
      <li>Installer un serveur local Xampp, Wamp etc..</li>
      <li>Installer composer</li> 
  </ul>
  
  Récupérer tout les composants : 
  > composer require install
   
  Récupérer la BDD (faire ça pour chacune des migrations):
  > php bin/console doctrine:migrations:migrate 'DoctrineMigrations\Version20180605025653'
  
  Récupérer les données utilisateurs :
  > php bin/console doctrine:fixtures:load

Accès à la partie admin :
 
 | Admin        |
| ------------- |
| Email : admin@admin.com |
| Mot de Passe : adminadmin |

 <h2>Comment utiliser le site</h2>
          <p>Ce site est un blog composé de différentes fonctionnalitées.</p>
          <ul>
            <li>Affichage des différents articles dans la page 'blog' en cliquant sur Articles dans la navbar.</li>
            <li>Possibilitée de créer un compte et de se connecter via le formulaire d'authentification grâce au bouton login et register dans la navbar.</li>
            <li>Gestion des articles via la page "admin", création d'article, modification et suppression.</li>
            <li>Grâce à la page admin nous pouvons aussi gérer les utilisateurs (leur rôle) et les catégories des articles.</li>
          </ul>
