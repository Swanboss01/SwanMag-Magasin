<?php
$token = $_POST['cf-turnstile-response'];
$secret = '0x4AAAAAABrnX5uWT768q2TcRfnnxpC09-0'; // Remplace par ta vraie clé secrète

$response = file_get_contents("https://challenges.cloudflare.com/turnstile/v0/siteverify", false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "Content-type: application/x-www-form-urlencoded",
        'content' => http_build_query([
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ])
    ]
]));

$result = json_decode($response);
if ($result->success) {
    // Traitement du message ici (ex: envoi email, stockage, etc.)
    echo "Message envoyé avec succès !";
} else {
    echo "Échec de vérification Turnstile.";
}
?>
