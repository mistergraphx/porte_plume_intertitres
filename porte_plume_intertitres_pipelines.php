<?php
/**
 * Utilisations de pipelines par Intertitres hierarchiques
 *
 * @plugin     Intertitres hierarchiques
 * @copyright  2016
 * @author     Mist. GraphX
 * @licence    GNU/GPL
 * @package    SPIP\Porte_plume_intertitres\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
	
// http://www.spip-contrib.net/Porte-Plume-documentation-technique
function porte_plume_intertitres_porte_plume_barre_pre_charger($barres){
    $barre = &$barres['edition'];
	
	$barre->set('header1', array(
		// groupe formatage paragraphe
		"dropMenu"    => array(
			// bouton <cadre>
			array(
				"id"          => 'intertitre',
				"name"        => _T('barre_intertitre'),
				"className"   => 'outil_intertitre1', 
				"openWith" => "\n{{{ ",
				"closeWith" => "}}}\n",
				"display"     => true,
				"selectionType" => "line",
			),
			array(
				"id"          => 'intertitre2',
				"name"        => _T('porte_plume_intertitres:barre_intertitre2'),
				"className"   => 'outil_intertitre2', 
				"openWith" => "\n{{{** ",
				"closeWith" => "}}}\n",
				"display"     => true,
				"selectionType" => "line",
			),
			array(
				"id"          => 'intertitre3',
				"name"        => _T('porte_plume_intertitres:barre_intertitre3'),
				"className"   => 'outil_intertitre3', 
				"openWith" => "\n{{{*** ",
				"closeWith" => "}}}\n",
				"display"     => true,
				"selectionType" => "line",
			),
			array(
				"id"          => 'intertitre4',
				"name"        => _T('porte_plume_intertitres:barre_intertitre4'),
				"className"   => 'outil_intertitre4', 
				"openWith" => "\n{{{**** ",
				"closeWith" => "}}}\n",
				"display"     => true,
				"selectionType" => "line",
			),
			
		)
	));
	
	$barre->ajouterApres('header1', array(
					"id" => "sepgrp1",
					"separator" => "---------------",
					"display"   => true,
		));
	

	return $barres;
}

function porte_plume_intertitres_porte_plume_lien_classe_vers_icone($flux){
	return array_merge($flux, array(
		'outil_header1' => array('intertitre.png','0'), //'intertitre.png'
		'outil_intertitre1' => array('intertitre_2.png','0'), //'intertitre.png'
		'outil_intertitre2' => array('intertitre_3.png','0'),
		'outil_intertitre3' => array('intertitre_4.png','0'),
		'outil_intertitre4' => array('intertitre_5.png','0')
	));
}
// http://contrib.spip.net/Generation-automatique-de
function porte_plume_intertitres_pre_propre($texte) {
  
  // on cherche les noms de section commençant par des #
  // http://lumadis.be/regex/test_regex.php?id=2929
  /*
	[0]=> array
		[0]=>{{{# Reference H4 }}}
		[1]=>{{{## Reference sub }}}
		[2]=>{{{# Reference H4 }}}
		[3]=>{{{## Reference sub }}}
	[1]=> array
		[0]=>{{{
		[1]=>{{{
		[2]=>{{{
		[3]=>{{{
	[2]=> array
		[0]=>#
		[1]=>##
		[2]=>#
		[3]=>##
	[3]=> array
		[0]=> Reference H4
		[1]=> Reference sub
		[2]=> Reference H4
		[3]=> Reference sub
	[4]=> array
		[0]=>}}}
		[1]=>}}}
		[2]=>}}}
		[3]=>}}}
*/
  // retourne le nombre de matches
  $count = preg_match_all("/({{{)(\#{1,4})(.*)(}}})/i", $texte, $matches);
  
  //initialisation du compteur
  $cnt[0] = 0;

  //pour chaque titre trouvé
  for ($j=0; $j < $count; $j++) {
	
	$level = $matches[2][$j];
	$titre = $matches[3][$j];

	//on est au niveau de base {{{# }}}  
	if(strlen($level) == 1) {
        
		//on réinitialise le compteur de ce titre
		for ($i=1; $i < count($cnt); $i++) {
			$cnt[$i] = 0;		
		} 
        //on incrémente cnt[0]
		$numeros = ++$cnt[0];
		
		$titre = $numeros.' - '.$titre;
	} else {
        // on est à un niveau plus profond
        // on construit le numéros
		$numeros = $cnt[0].'.';
		for ($i=1; $i < strlen($level)-1; $i++) {
		  $numeros .= $cnt[$i].".";
		}
		$numeros = $numeros.(++$cnt[$i]);
		//on génère le titre
		$titre = $numeros.' - '.$titre;
	}
		
	$debut_markup = $matches[1][$j].$matches[2][$j];
	$fin_markup =  $matches[4][$j];
	
	$haystack = $texte;
	$needle = $matches[0][$j];
	$replace = $debut_markup.$titre.$fin_markup ;
	// Ne remplacer que la première occurence trouvé, au cas ou des titres soient identique
	// http://stackoverflow.com/questions/1252693/using-str-replace-so-that-it-only-acts-on-the-first-match/1252710#1252710
	$pos = strpos($haystack, $needle);
	if ($pos !== false) {
		$texte = substr_replace($haystack, $replace, $pos, strlen($needle));
	}
	
  }

  return $texte;
}

?>