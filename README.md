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

##  Stack Technique
- **Framework** : Laravel  
- **Langage** : PHP  
- **Base de données** : MySQL  
- **Architecture** : MVC  
- **ORM** : Eloquent  
- **Moteur de vues** : Blade  
- **AJAX** : Actions dynamiques (filtrage, mise à jour du statut)  
- **Upload d’images** : Images associées aux tâches  
- **Framework UI Web** : Preline  

- **Services Laravel** : Logique métier séparée des contrôleurs  
- **Multilingue (i18n)** : Support de plusieurs langues  

- **Mobile** : Application Android  
- **Langage Mobile** : Kotlin  
- **Communication** : API REST Laravel (JSON)

---

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
- status (en attente / en cours / terminé)  
- project_id (clé étrangère)  
- timestamps  

---

## 🔗 Relation
- Un **projet** possède plusieurs **tâches**  
- Une **tâche** appartient à un **projet**

---

## Fonctionnalités Clés
- CRUD **Projets**
- CRUD **Tâches**
- Assigner une tâche à un projet
- Filtrer les tâches par **projet**
- Changer le statut d’une tâche

---

## 🔐 Validation & Sécurité
- Validation des champs obligatoires
- Protection CSRF
- Messages de succès / erreur


