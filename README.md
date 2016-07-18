# Intertitres pour le porte plume

Nativement spip ne propose qu'un seul niveau de titre/intertitre. 
Le niveau de départ `h3.spip` est configurable depuis `_options.php`, en utilisant les [variables de personalisations](http://www.spip.net/fr_article1825.html#debut_intertitre) :

```php

$GLOBALS['debut_intertitre'] = "\n<h3 class=\"spip\">\n";
$GLOBALS['fin_intertitre'] = "</h3>\n";

```

Ce plugin ajoute au porte plume de [spip](http://www.spip.net/) la gestion de niveaux de titres supplémentaires.

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