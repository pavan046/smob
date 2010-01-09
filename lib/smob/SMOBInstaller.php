<?

/* 
	The installer class
*/

class SMOBInstaller {
	
	// Construct
	public function __construct() {
	}
	
	// Main method - analyse the query type, get the content and render it
	public function go() {
		SMOBTemplate::header('');
		print $this->core();
		SMOBTemplate::footer();
	}
	
	private function core() {
		$root = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return <<<_END_
	<div id="head">
		<h2>1. Server setup</h2>
		<p>
			Welcome to the installer of your SMOB Hub. 
			Before starting, you must ensure that you have met the following requirements:
		</p>
		<ul>
			<li>Download <a href="arc.semsol.org/download">ARC2</a> and unzip it in the <code>lib</code> folder;</li>
			<li>Make the <code>config</code> directory writable by your web server;
			<li>If your SMOB hub is not in the <code>/smob</code> directory of your website, please edit the <code>.htaccess</code> file 	orrespondingly;</li>
			<li>If you want to use FOAF-SSL, please also edit the <code>.htaccess</code> file correspondingly;</li>
		</ul>
	</div>
	<div id="create-db-pane">
		<h2>2. Database setup of SMOB</h2>
		<div id="create-db-pane-in">
			<form>
				<fieldset>
					<legend>MySQL database settings</legend>
					<label for="db-host">database host:</label> <input type="text" id="db-host" name="db-host" value="localhost" size="50"><br />
					<label for="db-name">database name:</label> <input type="text" id="db-name" name="db-name" value="smob" size="20"><br />
					<label for="db-user">user name:</label> <input type="text" id="db-user" name="db-user" value="root" size="10"><br />
					<label for="db-pwd">password:</label> <input type="password" id="db-pwd" name="db-pwd" value="root" size="10"><br />
				</fieldset>
			</form>
			<p class="note">
			If the database does not exist yet, it will be created it for you.
			</p>
		</div>
		<div id="create-db-pane-out">
			<em>Request sent...</em>
		</div>
	</div>
	<div id="smob-config-pane">
		<h2>3. SMOB config</h2>
		<div id="smob-config-pane-in">
			<form>
				<fieldset>
					<legend>SMOB settings</legend>
					<label for="smob-root">SMOR Hub address:</label> <input type="text" id="smob-root" name="smob-root" value="$root" size="50"><br />
					<label for="smob-gmap">GoogleMap API key (optional):</label> <input type="text" id="smob-gmap" name="smob-gmap" value="" size="50"><br />
					<label for="smob-uri">FOAF URI:</label> <input type="text" id="smob-uri" name="smob-uri" value="" size="50"><br />
					<label for="smob-twitter-login">Twitter login:</label> <input type="text" id="smob-twitter-login" name="smob-twitter-login" value="" size="50"><br />
					<label for="smob-twitter-pass">Twitter pass:</label> <input type="password" id="smob-twitter-pass" name="smob-twitter-pass" value="" size="50"><br />
				</fieldset>	
			</form>
			<p class="note">
			Your FOAF URI is required, and will be used as well to authenticate via FOAF-SSL. Twitter login / password is optional.
			</p>
		</div>
		<div id="smob-config-pane-out">
			<em>Request sent...</em>
		</div>
	</div> 
	<div id="done-pane">
	</div>
	<button id="step">Ready ? Go !</button>
_END_;
	}

/*				
	// Browsing a single post
	private function post() {
		$post = new SMOBPost(SMOBTools::get_post_uri($this->uri, 'post'));
		return $post->render();
	}
	
	// RDF data for a single post
	private function data() {
		$post = new SMOBPost(SMOBTools::get_post_uri($this->uri, 'post'));
		return $post->raw();
	}

	// Browsing a list of posts
	private function posts() {
		$class = 'SMOBPostList'.ucfirst($this->type);
		$list = new $class($this->uri, $this->page);
		return $list->render();		
	}
	*/

}
