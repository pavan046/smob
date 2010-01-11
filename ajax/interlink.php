<?php

require_once(dirname(__FILE__).'/../lib/smob/SMOB.php'); 
require_once(dirname(__FILE__)."/../config/config.php");

function get_wrappers($type) {
	if ($handle = opendir(dirname(__FILE__)."/../lib/smob/wrappers/$type")) {
    	while (false !== ($file = readdir($handle))) {
			if (substr($file, 0, 1) != '.') {
				$services[] = substr($file, 0, -4);
				require_once(dirname(__FILE__)."/../lib/smob/wrappers/$type/$file");
			}
		}
		closedir($handle);
	}
	return $services;
}

function find_uris($wrapper, $term, $type) {
	$w = ucfirst($wrapper).ucfirst($type).'Wrapper';
	$x = new $w($term);
	return $x->get_uris();
}

$type = $_GET['type'];
$term = $_GET['term'];


if($type == 'tag' || $type == 'location') {
	print "<fieldset><legend>$term</legend>";
	if($type == 'tag') {
		$term = substr($term, 1);
	} else if($type == 'location') {
		$term = substr($term, 2);
	}
	$wrappers = get_wrappers($type);
	foreach($wrappers as $wrapper) {
		print "<fieldset><legend>Via $wrapper</legend>";
		$uris = find_uris($wrapper, $term, $type);
		if($uris) {
			foreach($uris as $name=>$uri) {
				$val = "$type--$term--$uri";
				print "<input type='checkbox' value='$val'/>$name (<a href='$uri' target='_blank'>$uri</a>)<br/>";
			}
		} else {
			print "Nothing retrieved from this service<br/>";
		}
		print "</fieldset>";
	}
}

// In case we just need to update the mappings
/*if($post) {
	$checked = $_GET['checked'];
	$unchecked = $_GET['unchecked'];
	$ck = explode(' ', $checked);
	foreach($ck as $c) {
		$ckl = explode('--', $c);
		if($ckl[0] == 'users') {
			$user = $ckl[1];
			$uri = $ckl[2];
			// Update with sioc:xxx
			$triples[] = array(uri($post), "sioc:topic", uri($uri));
			$triples[] = array(uri($uri), "sioc:name", literal($user));
			
		}
		elseif($ckl[0] == 'tags') {
			$tag = $ckl[1];
			$uri = $ckl[2];
			// Update with MOAT / commonTag
			$tagging = 'http://example.org/tagging/'.uniqid();
			$triples[] = array(uri($tagging), "a", "tags:RestrictedTagging");
			$triples[] = array(uri($tagging), "tags:taggedResource", uri($post));
			$triples[] = array(uri($tagging), "tags:associatedTag", literal($tag));
			$triples[] = array(uri($tagging), "moat:tagMeaning", uri($uri));
		}
	}
	$triples = render_sparql_triples($triples);
	$query = "INSERT INTO <${post}.rdf> { $triples }";
	do_query($query);
	print "The mappings have been successfully updated !";
}

*/

