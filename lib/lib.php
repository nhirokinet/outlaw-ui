<?php

require_once(dirname(__FILE__) . '/../config.php');

$languages_raw  = ['lxc-c11', 'lxc-cpp11', 'lxc-java8', 'lxc-perl5', 'lxc-php7.0', 'lxc-python2', 'lxc-python3', 'lxc-ruby2.3', 'lxc-scala'];
$languages_disp = ['C11', 'C++11', 'Java 8', 'Perl 5', 'PHP 7.0', 'Python 2', 'Python 3', 'Ruby 2.3', 'Scala'];

$languages_dict = array();
for ($i=0; $i<count($languages_raw); ++$i) {
	$languages_dict[$languages_raw[$i]] = $languages_disp[$i];
}

function json_get($path, $params = array()) {
	global $outlaw_url, $outlaw_username, $outlaw_password;
	
	$content = http_build_query($params);
	$headers = array(
		'Authorization: Basic ' . base64_encode($outlaw_username . ':' . $outlaw_password),
		'Content-Length: ' . strlen($content),
		
		);

	$ret = json_decode(file_get_contents($outlaw_url . $path, false, stream_context_create(
			array(
				'http'=>array(
					'method' => 'POST',
					'header' => implode("\r\n",$headers),
					'content' => $content,
				)
			)
		)), true);

	return $ret;
}

function escape($in) {
	return htmlspecialchars($in, ENT_QUOTES, 'UTF-8');
}

function choose_highlighter_class_name ($lang) {
	switch ($lang) {
		case 'lxc-java8':
			return 'java';
		case 'lxc-c11':
		case 'lxc-cpp11':
			return 'cpp';
		case 'lxc-perl5':
			return 'perl';
		case 'lxc-php7.0':
			return 'php';
		case 'lxc-ruby2.3':
			return 'ruby';
		case 'lxc-scala':
			return 'scala';
		case 'lxc-python2':
		case 'lxc-python3':
			return 'python';
		default:
			return '';
	}
}

function disp($in) {
	echo escape($in);
}

function disp_multilines($in) {
	echo nl2br(escape($in));
}

function get_session_id() {
	return $_COOKIE['session_id'];
}

function set_session_id($session_id) {
	global $connection_secure;
	setcookie('session_id', $session_id, 0, null, null, $connection_secure, true);
	return true;
}

function login($screen_name, $password) {
	$ret = json_get('login.php', array('screen_name'=>$screen_name, 'passwd'=>$password));
	if ($ret['status'] === 'success') {
		return $ret;
	} else {
		return NULL;
	}
}

function logout() {
	$ret = json_get('logout.php', array('session_id'=>get_session_id()));
	return true;
}

// return user info if logged in, else NULL
function whoami() {
	return json_get('whoami.php?session_id=' . urlencode(get_session_id()));
}

// submit problem
function submit_code($problem_id, $language, $source_code) {
	return json_get('submit_code.php?session_id=' . urlencode(get_session_id()), array('problem_id'=>$problem_id, 'language'=>$language, 'source_code'=>$source_code));
}

function error_display() {
	echo '<html><body>error</body></html>';
}

// in case of write action, check for XSRF
function write_action() {
	if ($_POST['write_check'] === post_signiture()) {
		return true;
	}
	error_display();
	exit(0);
}

// include this as parameter 'write_check' in POST
function post_signiture() {
	return hash('sha256', get_session_id());
}

function signup($screen_name, $password, $email) {
	if (strlen($_POST['password']) < 6) {
		return array('message' => 'password is too short');
	}

	if ($_POST['password'] !== $_POST['password_confirm']) {
		return array('message' => 'confirmation of two passwords failed');
	}

	return json_get('signup.php', array('screen_name'=>$screen_name, 'passwd'=>$password, 'email'=>$email));
}

function get_submissions() {
	return json_get('get_submissions.php?session_id=' . urlencode(get_session_id()));
}

function get_user_submissions() {
	return json_get('get_user_submissions.php?session_id=' . urlencode(get_session_id()));

}

function get_problem($problem_id) {
	return json_get('get_problem.php?id=' . urlencode($problem_id) . '&session_id=' . urlencode(get_session_id()));
}

function get_problems() {
	return json_get('get_problems.php?session_id=' . urlencode(get_session_id()));
}

function get_standings() {
	return json_get('get_standings.php?session_id=' . urlencode(get_session_id()));
}

$user = whoami();