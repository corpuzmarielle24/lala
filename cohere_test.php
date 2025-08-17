<?php

// Replace with your actual Cohere API key
$apiKey = 'OqG146wYVRRizuLZYDknoBUQEiPJivL6QAZTg6DF';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://api.cohere.ai/',
    'headers' => [
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ],
]);

try {
    $response = $client->post('generate', [
        'json' => [
            'model' => 'medium',
            'prompt' => 'Generate questions based on the following text: "Sample text here."',
            'max_tokens' => 150,
        ],
    ]);

    $body = json_decode($response->getBody(), true);

    // Output the response
    echo "Generated Questions:\n";
    echo $body['generations'][0]['text'] ?? 'No questions generated.';
} catch (\Exception $e) {
    echo 'Error generating questions: ' . $e->getMessage();
}
