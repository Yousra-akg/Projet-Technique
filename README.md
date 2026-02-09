---
marp: true
theme: default
_class: lead
paginate: true
backgroundColor: #ffffff
color: #5B2C6F
style: |
  img {
    max-width: 80%;
    max-height: 65vh;
    display: block;
    margin: 1em auto;
    object-fit: contain;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
---

# Présentation Projet technique
### Application de gestion et filtrage des tâches
**Présentée par : Yousra Akajou**  
**Encadré par : M. Fouad Essarraj**  
**Date : 05/01/2026**

---

# Choix du sujet
**gestion des tâches**

# Contexte
![Scrum](images/2_tup.png)

# Analyse technique 
## Fonctionnalités Clés
- CRUD **Tâches**
- Details Tache
- Filtrer les tâches par **projet**
- Rechercher les taches

##  Stack Technique
- 1- **Base de données** : MySQL  
- 2- **Framework** : Laravel  
- 3- **Architecture N-tier** : Services
- 4- **Architecture** : MVC  
- 5- **Moteur de vues** : Blade  
- 6- **AJAX** : Actions dynamiques (filtrage, mise à jour du statut)  
- 7- **Upload d’images** : Images associées aux tâches  
- 8- **Laravel multilingue** : Support de plusieurs langues  
- 9- **Vite**
- 10- **Preline UI library**
- 11- **Lucide Library**

##  Base de Données

### Table `projects`
- id  
- title  
- description  
- timestamps  

### Table `tasks`
- id  
- title  
- description  
- image
- project_id (clé étrangère)  
- timestamps  

## 🔗 Relation
- Un **projet** possède plusieurs **tâches**  
- Une **tâche** appartient à un **projet**

# Fonctionnalitées 
![alt text](images/image.png)

# Conception

![alt text](images/img2.png)

---

## Versions

### Version 1

- Public Side
- Branch : public

### Version 2

- Admin Side
- Branch : admin

### Version 3

- Authontification / Authorization (Gates)
- Branch : gates

---

### Version 4

- SPA (Single Page Application) / AJAX - Alpine.js
- Branch : spa

### Version 5

- Spatie / Authorization
- Branch : spatie

### Version 6

- API
- Branch : api

### Version 7

- Mobile App
- Branch : mobile

---


# Sujet de Live coding
- Un bouton “Ajouter” qui ouvre une modale pour créer un nouvel élément.
- Une barre de recherche filtrant des éléments par titre.




