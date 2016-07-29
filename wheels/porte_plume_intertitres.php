<?php
/**
 * Callbacks Intertitres hierarchiques
 *
 * @plugin     Intertitres hierarchiques
 * @copyright  2016
 * @author     Mist. GraphX
 * @licence    GNU/GPL
 * @package    SPIP\Porte_plume_intertitres\wheels
 */


if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// @see http://zone.spip.org/trac/spip-zone/browser/_plugins_/todo/trunk/wheels/todo.php
// @see http://lumadis.be/regex/test_regex.php?id=2933
// Extraction de lignes du texte
// La wheel renvoie un tableau à cette callback qui est le résultat d'un preg_match_all.
// Le contenu du tableau est le suivant :
// 0 - la chaine complète
// 1 - le groupe ouvrant
// 2 - le level
// 3 - le contenu
// 4 - le groupe fermant
function intertitres($t){
    preg_match('/[h](\d)/s',$GLOBALS['debut_intertitre'], $matches) ;
    $base_level = $matches[1];
    $level = (strlen($t[2]) - 1) + $base_level;
    $html = "<h$level>".$t[3]."</h$level>";
    return $html;
}

