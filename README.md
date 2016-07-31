# Intertitres pour le porte plume

Nativement spip ne propose qu'un seul niveau de titre/intertitre. 
Le niveau de départ `h3.spip` est configurable depuis `_options.php`,
en utilisant les [variables de personalisations](http://www.spip.net/fr_article1825.html#debut_intertitre) :

```php

$GLOBALS['debut_intertitre'] = "\n<h3 class=\"spip\">\n";
$GLOBALS['fin_intertitre'] = "</h3>\n";

```

Ce plugin ajoute au porte plume de [spip](http://www.spip.net/)
la gestion de niveaux de titres supplémentaires, en prenant en compte le niveau de départ configuré dans spip ou `mes_options.php`.

Le plugin reprend les syntaxes proposées par typo-enluminée, et intertitres_tdm
Soit les syntaxes `{{{***` pour les titres simples ou `{{{###` pour les titres de type référence (ex:1.1, 1.1.2).

**Différences avec les plugins typo enluminé ou intertitres_hierarchise_et_tdm :**

*	ce plugin utilise [textwheel](http://contrib.spip.net/Presentation-de-TextWheel),
ceci permettant entre autre :

	- de pouvoir surcharger les wheels déclarées pour un besoin spécifique,
	- tester et maintenir plus facilement les expressions/ étudiées/raccourcis traités.
	- utiliser les fonctionnalitées de spip3

*	il ne gère que les titres : ce plugin n'apporte **que** cette fonctionnalité.
*	une syntaxe additionnelle permet d'ajouter des classes css supplémentaires et une id spécifique au titre.

**Plugins complémentaires testés**

*   [Sommaire automatiques](http://contrib.spip.net/Sommaire-automatique).

## Raccourcis

| Raccourci | Description |
|---|---|
| `{{{* … }}}` | Titre standard  équivalent au raccourcis spip intertitre `{{{…}}}` |
| `{{{** Titre standard }}}` ||
| `{{{** Titre standard }}}` ||
| `{{{*** Titre standard }}}` ||
| `{{{**** Titre standard }}}` ||
| `{{{# Titre de type référence }}}` ||
| `{{{## Titre de type référence }}}` ||
| `{{{### Titre de type référence }}}` ||
| `{{{#### Titre de type référence }}}` ||
| **Attributs**| par défaut les classes hx et rx sont ajoutées automatiquement|
| `{{{ Titre }}}{.test-class1 .test--extender}` | Ajouter des attributs css suplémentaires aux titres |
| `{{{ Titre }}}{#id_du_titre}` | Inssérer un identifiant unique |
| `{{{ Titre }}}{attribut="valeur attribut" data-appear="left" itemprop="name"}` | Inssérer des propriétées/attributs libres |



## A savoir

*Si  les icones du porte plume n'apparaissent pas après l'activation du plugin,
supprimez les dossiers /local/cache-css et js.*

*Le plugin étant en developpement , si vous avez installé une version précédente, il peut être nécessaire
de supprimer le dossier /tmp/cache/wheels, pour que les traitements typo soient pris en compte.*

## TODO

- [ ] ajouter la possibilitée de ne pas afficher les titres référence dans la barre d'outil sur globale ou config ?

## CHANGELOGS

-   1.0.7
    correctif sur les intertitres standards qui n'étaient plus gérés correctement

-   1.0.6
    -   prise en charge dans les attributs de propriétées libres `propriete="valeur" `
        ex `{.class .block--modifier #ID data-appear="left" itemprop="name"}

-	1.0.5
	- [x] personnaliser les .class
	Mise en place de la gestion d'attributs additionnels aux titres via le raccourci inspiré de la syntaxe markdown `{.class .block--modifier #ID}`.

-   1.0.4 :
    - [x] limiter le niveau et passer sur un div a h6
    
-   1.0.3 :
    - Report de la gestion du niveau sur les références

-   1.0.2 :
    - suppression du fichier fonction inutile pour le moment et des markers de fin de php `?>`
        
-   1.0.1 :
    ajout d'une fonction de callback sur les wheels des intertitres, gérant
    l'incrémentation du niveau de titre d'après la $GLOBALS['debut_intertitre']
    définissable dans mes_options.php.
    