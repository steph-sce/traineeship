# Projet final Ecole multimédia

Plateforme de formation



### Technos utilisées :

![laravel](https://cdn4.iconfinder.com/data/icons/logos-3/256/laravel-128.png)

## Diagramme de la base de données


<img src="https://trello-attachments.s3.amazonaws.com/5b7b381dd66faa8edd7b5337/5b7b381e20ab3b86a30d8d0f/1fa57bf968ab4dff57abb8d829b9830e/diag.png"/>


#### Explications

1. Les nombres sont tous unsigned, car il n'y a pas besoin de stocker des nombres négatifs
2. Dans la table posts:  
   * les champs title et description sont requis
   * le champ post_type est un enum de 'formation' et 'stage'
   * le status sera 'draft' par défaut
   * les autres champs sont nullable (pour pouvoir sauvegarder l'item en 'draft')
   
  3. La table category_post est crée afin d'anticiper une potentielle relation N:N si une évolution permettait qu'un post soit relié à plusieurs catégories plutôt qu'une au plus





__[Lien vers trello](https://trello.com/b/Y3skTOlH/scrumboard-projet-final-lem)__



<h3>Idées</h3>

_cliquez sur les labels pour développer les sous-parties_


---

<details> 
  <summary>Possibilités d'inscription aux événements</summary>
  <h2>Diagramme de la base de données</h2>
  <img src="https://trello-attachments.s3.amazonaws.com/5b7b381dd66faa8edd7b5337/5b7bdced3816d5309b5d5b05/8abc95d4d3c8e619691256c7c93b2846/diag_fork.png" />
  <h4>Explications</h4>
  <ol>
    <li>Création de la table subscriptions pour stocker les emails de façon unique</li>
    <li>Création de la table de liaison post_subscription pour stocker les inscriptions aux événements le couple post_id subscription_id étant unique</li>
    <li>Ajout du champ subscriptions dans la table posts pour compter le nombre d'inscrits
  </ol>
</details>