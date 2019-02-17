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
// @see http://lumadis.be/regex/test_regex.php?id=2938
// Extraction de lignes du texte
// La wheel renvoie un tableau à cette callback qui est le résultat d'un preg_match_all.
// Le contenu du tableau est le suivant :
// 0 - la chaine complète
// 1 - le groupe ouvrant
// 2 - le type|level - ou string/contenu si intertitre spip
// 3 - le contenu
// 4 - le groupe fermant
// 5 - attributs class|id
function intertitres($t){
	static $base_level = false;
	if(!$base_level){
		// Récupérer le niveau de base d'après la global
	  preg_match('/[h](\d)/s',$GLOBALS['debut_intertitre'], $matches) ;
	  $base_level = $matches[1];
	}

	// quel type ? h ou r
	// pour les class auto
	$type = get_type($t[2]);

	// Ajuster le level de l'item
	// !! dans le cas du titre spip la regex ne retourne pas
	// le mm nombre de résultats dans le array
	// les titres spip n'ont pas #|*
	if(preg_match('/^[\*\#]/',$t[2])){
		$level = (strlen($t[2]) - 1) + $base_level;
		$titre = $t[3];
		// extenders
		$attributs = classer_attributs($t[5]);
	}else{
		$level = $base_level;
		$titre = $t[2];
		// extenders
		$attributs = classer_attributs($t[4]); // dans le cas des inter spip les extenders son en position 4
	}

	$css = $type.$level;

	if(isset($attributs['css']))
		$css .= $attributs['css'];

	(isset($attributs['id'])) ?	$id = 'id="'.$attributs['id'].'"' : $id='';

	if(isset($attributs['proprietes']))
		$properties .= ' '.$attributs['proprietes'];

	// ne pas depasser h6
	if($level < 7)
		$html = "<h$level $id class=\"$css\"$properties>".$titre."</h$level>";
  else
		$html = "<div $id class=\"$css\"$properties>".$titre."</div>";

	return $html;
}



function get_type($str){
	if(preg_match('/^#/',$str))
		$type = 'r';
	else
		$type = 'h';

	return $type;
}

function classer_attributs($attributs){

	$attributs = preg_split('/[\s]+/', $attributs);

	$sorted = [];

	foreach($attributs as $attribut){
		// css
		if(is_css($attribut)){
			$class = is_css($attribut);
			$sorted['css'] .= ' '.$class[1];
		}
		// id == 1
		elseif(is_id($attribut)) {
			$id = is_id($attribut);
			$sorted['id'] = $id[1];
		}
		// properties
		elseif(is_propertie($attribut)){
			$propertie = is_propertie($attribut);
			$sorted['proprietes'] .= $propertie[1];
		}
	}

	return $sorted;
}

// http://lumadis.be/regex/test_regex.php?id=2936
function is_css($str){
	$regex = '/\.([_a-zA-Z0-9-]+)/s';
	if(preg_match($regex,$str,$class_name))
		return $class_name;
	else
		return false;
}

function is_id($str){
	$regex = '/#([_a-zA-Z0-9-]+)/s';
	if(preg_match($regex,$str,$id))
		return $id;
	else
		return false;
}

// http://lumadis.be/regex/test_regex.php?id=2937
function is_propertie($str){
	$regex = '/([_a-z-]+=[\"|\'].*?[\"|\'])/s';
	if(preg_match($regex,$str,$propertie))
		return $propertie;
	else
		return false;
}
