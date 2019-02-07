<?php
/**
 * Options du plugin Intertitres hierarchiques au chargement
 *
 * @plugin     Intertitres hierarchiques
 * @copyright  2016
 * @author     Mist. GraphX
 * @licence    GNU/GPL
 * @package    SPIP\Porte_plume_intertitres\Options
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

// Ajout des raccourcis dans la liste des wheels
$GLOBALS['spip_wheels']['raccourcis'][] = 'porte_plume_intertitres.yaml';

if ( !isset ( $GLOBALS['debut_intertitre'] ) ) {
    $GLOBALS['debut_intertitre'] = '<h3 class="spip">';
    $GLOBALS['fin_intertitre'] = '</h3>';
}



function get_heading_base_level(){
    // Récupérer le niveau de base d'après la global
    preg_match('/[h](\d)/s',$GLOBALS['debut_intertitre'], $matches) ;
    return $matches[1];
}