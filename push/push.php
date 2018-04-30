<?php
$response = file_get_contents('http://www.getwellbyoga.com/yoga/listtokens.php');
$response = json_decode($response);
$count = count($response);
for ($i = 0; $i < $count; $i++) {
 $deviceToken = $response[$i][0];

// Put your device token here (without spaces):
//$deviceToken = '1bb5da8d5b519be8e7321867d23bc8f78aacd35e600548fd6cf311a21867af59';

// Put your private key's passphrase here:
$passphrase = 'passw0rd';

// Put your alert message here:
$message = 'Welcome to Yoga Cure. This is a test notification';

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'aps.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,
	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
	'alert' => $message,
	'sound' => 'default'
	);

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
	echo 'Message not delivered' . PHP_EOL;
else
	echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
fclose($fp);
}
