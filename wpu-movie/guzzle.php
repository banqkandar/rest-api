<?php 

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
    'query' => [
        'apikey' => '7d2ace38',
        's' => 'robin'
    ]
]);

$result = json_decode($response->getBody()->getContents(), true); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>

    <?php foreach ($result['Search'] as $movie) : ?>
        <ul>
            <li>Titile : <?= $movie['Title']; ?></li>
            <li>Years : <?= $movie['Year']; ?></li>
            <li>
                <img src="<?= $movie['Poster']; ?>" width="100">
            </li>
        </ul>
    <?php endforeach; ?>
    
</body>
</html>