# Intertitres pour le porte plume

Nativement spip ne propose qu'un seul niveau de titre/intertitre.
Le niveau de départ `h3.spip` est configurable depuis `_options.php`,
en utilisant les [variables de personalisations](http://www.spip.net/fr_article1825.html#debut_intertitre) :

Ce plugin ajoute au porte plume de [spip](http://www.spip.net/)
la gestion de niveaux de titres supplémentaires, en prenant en compte le niveau de départ configuré dans spip
ou `mes_options.php`.

```php

$GLOBALS['debut_intertitre'] = "\n<h3 class=\"spip\">\n";
$GLOBALS['fin_intertitre'] = "</h3>\n";

```

Le plugin reprend les syntaxes proposées par typo-enluminée, et intertitres_tdm,
soit `{{{***` pour les titres simples ou `{{{###` pour les titres de type référence (ex:1.1, 1.1.2).

Les icones affichées dans le porte plume (barre typographique),
reflète le niveau sémantique au sens html pour sensibiliser le rédacteur à son plan de page.
Le niveau se base sur la globale spip debut_intertitre.



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
| `{{{***** Titre standard }}}` ||
| `{{{# Titre de type référence }}}` ||
| `{{{## Titre de type référence }}}` ||
| `{{{### Titre de type référence }}}` ||
| `{{{#### Titre de type référence }}}` ||
| **Attributs**| par défaut les classes hx et rx sont ajoutées automatiquement |
| `{{{ Titre }}}{.test-class1 .test--extender}` | Ajouter des attributs css suplémentaires aux titres |
| `{{{ Titre }}}{#id_du_titre}` | Inssérer un identifiant unique |
| `{{{ Titre }}}{attribut="valeur attribut" data-appear="left" itemprop="name"}` | Inssérer des propriétées/attributs libres |



## A savoir

*Si  les icones du porte plume n'apparaissent pas après l'activation du plugin,
supprimez les dossiers /local/cache-css et js.*

*Le plugin étant en developpement , si vous avez installé une version précédente, il peut être nécessaire
de supprimer le dossier /tmp/cache/wheels, pour que les traitements typo soient pris en compte.*

## Participer

Tout retour est apprécié : suggestions, tests, bugs, idées d'amélioration, pull request.


## TODO

- [X] 	ajouter la possibilitée de ne pas afficher les titres référence dans la barre d'outil sur globale ou config ?
- [ ] 	ajout d'ancre avec url pour permettre d'inclure des liens facilement vers une partie du texte :  
		https://assortment.io/posts/simple-automated-jumplinks-with-jquery  
		ou anchor.js

- [ ] 	Afficher dans la page config le niveau de la globale
		```php
		    $GLOBALS['debut_intertitre'] = '<h3 class="spip">';
			$GLOBALS['fin_intertitre'] = '</h3>';
		```
- [X] 	Afficher l'icone correspondant au niveau de titre réelle en fonction de la globale debut_intertitre

## CHANGELOGS


- 	1.1.1

mise en place des niveau suppérieurs a 5 et aller jusqu'au niveau 6
ou 7 suivant le niveau défini comme départ des intertitres spip (h3 par defaut).
aussi pour compatibilité avec typo_enluminee
Dans le cas de spip par defaut le dernier niveau généré est donc non-sémantique `div.h7`.

Pour mieux sensibiliser le rédacteur en fonction de son plan de page :
on affiche les icones de la barre outil en fonction du niveau defini par la globale spip_debut_intertitre
(h2,h3,h4,h5,h6) dans le cas de spip par defaut démarrant a h3 on signale par un h7 en rouge converti en `div.h7`

Modif chaines de langue : on raccourci le label du bouton icone affiche lui le raccourci spip


- 	1.1.0

	Masquer les titres de type référence de la barre édition depuis le panneaux de configuration

- 	1.0.9
	spip 3.2

-   1.0.8
    strpos au lieu de strstr, moins couteux en ressource
    strpos au lieu de preg_match pour la function get_type

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
