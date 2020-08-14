<?php
/**
 * Provides public interface for initializing a repository update from version controll.
 *
 * @author Benno Bielmeier
 * @copyright 2020 Benno Bielmeier
 */

/**
 * Returns whether current request uses SSL.
 *
 * @return bool
 */
function isSSL() {
	return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
		|| $_SERVER['SERVER_PORT'] == 443;
}
?>

<?php
$DEBUG = TRUE;
if (isSSL() && isset($_POST)) {
	if ($DEBUG) {
		echo shell_exec('echo Hello World');
	}
	http_response_code(200);
} else {
	http_response_code(400);
}
?>
