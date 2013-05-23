<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SimpleWebServer\Resources\Contact,
    SimpleWebServer\Utils\IOResources
;

// Error
$app->error(function (\Exception $exception, $code) {
    return new Response("ERROR", $code);
});

/*
    ROUTING  
*/
// Homepage
// Call BASE_URL/api.php
$app->get('/', function () {
    return new Response('Hello Sir', 200);
})
;

/*
    API ROUTING  
*/

// Get all contacts
// Call BASE_URL/api.php/contact
$app->get('/contact', function () {
    $contactWriter = new IOResources("../data/contacts.csv");
    $contacts = $contactWriter->readAll($contact);
    var_dump($contacts);
    return new Response('Tous les contacts', 200);
})
;

//Add one contact
$app->post('/contact', function (Request $request) {
    $contact = new Contact($request->get('lastname'), $request->get('firstname'), $request->get('mail'));
    $contactWriter = new IOResources("../data/contacts.csv");

    $contactWriter->write($contact);

    return new Response('Thank you for your contact data!', 201);
});