<?php
/*
 * Adding just SMOB.php
 */
require_once(dirname(__FILE__).'/SMOB.php');

$query = "Insert INTO <http://localhost/smob/ppo> {
<http://dbpedia.org/resource/India> <hasaccessspace> 'select ?callback where {?callback <callback-of> ?user . ?user <isfriendof> <http://localhost/smob> .}' .
<http://dbpedia.org/resource/Galway> <hasaccessspace> 'select ?callback where {?callback <callback-of> ?user . ?user <samelocation> <http://localhost/smob> .}' .
<http://smob/default> <hasaccessspace> 'select ?callback where {?callback <callback-of> ?user . ?user <issubscribedto> <http://localhost/smob> .}' .
<http://dbpedia.org/resource/Semantic_Web> <hasaccessspace> 'SELECT ?callback WHERE { ?topic  push:has_subscriber ?account . ?user foaf:holdsAccount ?account . ?user push:has_callback ?callback . ?user foaf:interest_topic <http://dbpedia.org/resource/Semantic_Web> .}' 
}";

$query2 = "SELECT ?query
WHERE { 
	GRAPH <http://localhost/smob/ppo> {
		?s ?p ?query
	}
}";

$query3 = "DELETE FROM <http://localhost/smob/ppo> {<http://dbpedia.org/resource/Semantic_Web> <hasaccessspace> ?s . }";
$access_space = array();
$qs = SMOBStore::query($query2);
foreach($qs as $q){
			array_push($access_space, $q["query"]);
		}
var_dump($access_space);

?>
