<?php
/**
 * Provides public interface for initializing a repository update from version controll.
 *
 * @author Benno Bielmeier
 * @copyright 2020 Benno Bielmeier
 */

define('HTTP_SUCCESS', 200);
define('HTTP_ERROR', 400);


/**
 * Return whether current request uses SSL.
 *
 * @return bool
 */
function isSSL() {
	# 'HTTPS' set to a non-empty value if the script was queried through the HTTPS protocol.
	return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
	        || $_SERVER['SERVER_PORT'] == 443;
}

$config = parse_ini_file('config.ini');

/**
 * Log incoming Request
 *
 * @return bool
 */
function log_access($path) {
	if (empty($path))
		return FALSE;

	$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']).PHP_EOL.
	        "User Agent: ".$_SERVER['HTTP_USER_AGENT'].PHP_EOL.
	        "-------------------------".PHP_EOL;

	return file_put_contents($path.'/log_'.date("Y-m-d").'.log', $log, FILE_APPEND);
}
?>

<?php
$DEBUG = TRUE;
$log_suc = log_access($config['log_dir']);

if ($DEBUG && !$log_suc){
	echo "<p>Faild writing to log.<br>Path: {$config['log_dir']}</p>";
}

if (isSSL() && isset($_POST)) {
	if ($DEBUG) {
		echo shell_exec('echo Hello World');
	}
	http_response_code(HTTP_SUCCESS);
} else {
	http_response_code(HTTP_ERROR);
}
?>
