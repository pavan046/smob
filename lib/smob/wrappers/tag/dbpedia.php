<?php

class DBPediaTagWrapper extends SMOBURIWrapper {
		
	function get_uris() {
		$uri = "http://lookup.dbpedia.org/api/search.asmx/KeywordSearch?QueryString=".urlencode($this->item)."&QueryClass=&MaxHits=10";
		$res = $this->do_curl($uri);
		$xml = simplexml_load_string($res[0]);
		foreach($xml->Result as $x) {
			// That shall work with an XML method 
			$vars = get_object_vars($x);
			$r[$vars['Label']] = $vars['URI'];
		}
		return $r;
	}
	
	function do_curl($uri){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$contents = curl_exec ($ch);
		if ($error = curl_error($ch)) {
			return array("$error.", "", 0);
		}
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$status_line = substr($response, 0, strcspn($response, "\n\r"));
		curl_close ($ch);
		return array($contents, $status_code, $status_line);
	}
}

?>