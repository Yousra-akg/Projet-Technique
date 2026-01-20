---
marp: true
title: Introduction à Alpine.js
author: Votre Nom
paginate: true
---

# 🏔️ Alpine.js  
### Un framework JavaScript léger

---

## 📌 Objectifs du LAB

- Comprendre ce qu’est Alpine.js  
- Découvrir ses concepts de base  
- Comparer Alpine.js avec d’autres frameworks  
- Manipuler le DOM avec Alpine.js  
- Réaliser de petits exemples pratiques



## ❓ Qu’est-ce que Alpine.js ?

- Alpine.js est un **framework JavaScript minimaliste**
- Il permet d’ajouter de l’interactivité directement dans le HTML
- Inspiré de **Vue.js**, mais beaucoup plus léger
- Idéal pour :
  - Petits projets
  - Dashboards
  - Formulaires dynamiques
  - Projets Laravel / Blade


## ⚙️ Pourquoi utiliser Alpine.js ?

### ✅ Avantages
- Très léger (~10KB)
- Facile à apprendre
- Pas de compilation
- Fonctionne directement dans le navigateur
- Parfait avec Laravel

### ❌ Inconvénients
- Pas adapté aux grandes applications complexes
- Moins structuré que React ou Vue



## 📦 Installation

### Via CDN (le plus simple)

```html
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

```

## 🧠 Concept clé : x-data

x-data permet de définir un état local

C’est le cœur d’Alpine.js

```html
<div x-data="{ message: 'Hello Alpine!' }">
  <p x-text="message"></p>
</div>

```
### 🖊️ x-text et x-html
```html
<div x-data="{ text: 'Bonjour' }">
  <p x-text="text"></p>
</div>
```
```html
<div x-data="{ html: '<strong>Important</strong>' }">
  <p x-html="html"></p>
</div>

```
### 🎯 x-on (événements)
Équivalent de addEventListener

Version courte : @click
```html
<div x-data="{ count: 0 }">
  <button @click="count++">+</button>
  <span x-text="count"></span>
</div>

```
### 👁️ x-show (affichage conditionnel)
```html
<div x-data="{ open: false }">
  <button @click="open = !open">Toggle</button>

  <p x-show="open">Contenu visible</p>
</div>

```
### ✍️ x-model (liaison input)
```html

<div x-data="{ name: '' }">
  <input type="text" x-model="name">
  <p>Nom : <span x-text="name"></span></p>
</div>
```

### 🔁 x-for (boucles)
```html
<div x-data="{ fruits: ['Pomme', 'Banane', 'Orange'] }">
  <ul>
    <template x-for="fruit in fruits">
      <li x-text="fruit"></li>
    </template>
  </ul>
</div>


```

## 🧪 LAB PRATIQUE : Compteur
Objectif :

Créer un compteur avec + et -
```html
<div x-data="{ count: 0 }">
  <button @click="count--">-</button>
  <span x-text="count"></span>
  <button @click="count++">+</button>
</div>
```
## 🧪 LAB PRATIQUE : Toggle menu
```html
<div x-data="{ open: false }">
  <button @click="open = !open">Menu</button>

  <ul x-show="open">
    <li>Accueil</li>
    <li>Produits</li>
    <li>Contact</li>
  </ul>
</div>
```
## 🆚 Alpine.js vs React / Vue
| Alpine.js      | React / Vue            |
| -------------- | ---------------------- |
| Très léger     | Plus lourd             |
| Facile         | Courbe d’apprentissage |
| HTML centré    | JS centré              |
| Petits projets | Grandes apps           |

## 🧩 Cas d’utilisation
- Projets Laravel (Blade)
- Formulaires dynamiques
- Modales
- Dropdowns
- Tabs
- Dashboards simples

## ✅ Conclusion

- Alpine.js est simple, rapide et efficace
- Idéal pour ajouter de l’interactivité sans complexité
- Excellent choix pour les petits et moyens projets