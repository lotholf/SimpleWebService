<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Error
$app->error(function (\Exception $exception, $code) {
    return new Response('Error', $code);
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
    return new Response('Tous les contacts', 200);
})
;

//Add one contact
$app->post('/contact', function (Request $request) {
    return new Response('Thank you for your contact data!', 201);
});