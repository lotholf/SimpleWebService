<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SimpleWebServer\Resources\Contact,
    SimpleWebServer\Utils\IOResources
;

// Error
$app->error(function (\Exception $exception, $code) use ($app) {
    // Prepare JSON return
    $error = array('message' => $exception->getMessage());
    return $app->json($error, $code);
});
/*
    ROUTING  
*/
// Homepage
// Call BASE_URL/api.php
$app->get('/', function () use ($app) {
    // Prepare JSON return
    $message = array('message' => "Hello Sir !");
    return $app->json($message, 200);
})
;

/*
    API ROUTING  
*/

// Get all contacts
// Call BASE_URL/api.php/contact
$app->get('/contact', function () use ($app) {
    $contactWriter = new IOResources("../data/contacts.csv");

    $contacts = $contactWriter->readAll();

    // Prepare JSON return
    $message = array('contacts' => $contacts);
    return $app->json($message, 200);
})
;

// Add one contact
$app->post('/contact', function (Request $request) use ($app) {
    // Create an array with JSON data
    $data = json_decode($request->getContent(), true);

    $message = array('message' => "Missing informations");
    $code    = 400;

    if($data['lastname'] && $data['firstname'] && $data['mail']) 
    {
        $contact = new Contact($data['lastname'], $data['firstname'], $data['mail']);
        $contactWriter = new IOResources("../data/contacts.csv");

        $contactWriter->write($contact);

        // Prepare JSON return
        $message = array('message' => "Thank you for your data");
        $code = 201;
    }

    return $app->json($message, $code);
});
