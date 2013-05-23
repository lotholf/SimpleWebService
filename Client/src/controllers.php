<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints as Assert;

use SimpleWebClient\RESTConnection;

$app->match('/', function (Request $request) use ($app) {
    $data = array(
        'lastname' => 'Your lastname',
        'firstname' => 'Your firstname',
        'mail' => 'Your@mail.com',
    );

    $form = $app['form.factory']->createBuilder('form', $data)
        ->add('lastname', 'text', array(
            'constraints' => array(new Assert\NotBlank())
        ))
        ->add('firstname', 'text', array(
            'constraints' => array(new Assert\NotBlank())
        ))
        ->add('mail', 'text', array(
            'constraints' => array(new Assert\Email(), new Assert\NotBlank())
        ))
        ->getForm();

    $message = array();

    if ('POST' == $request->getMethod()) {
        $form->bind($request);

        if ($form->isValid()) {
            $data = $form->getData();

            // Call JSON API of web service server
            // Initialize the header of our future requests, specifying the format we want to use in request and response (json)
            $requestHeader = array('Accept: application/json', 'Content-Type: application/json');
            // Create the RESTConnection object
            $contactAPI = new RESTConnection('http://localhost/api-server/', $requestHeader);

            // Issue a POST request on 'http://localhost/api.php/contact'
            if($contactAPI->request('api.php/contact', json_encode($data), RESTConnection::POST))
            {
                // lastStatusCode should be 201
                if($contactAPI->getLastStatusCode() == 201)
                {
                    $responseAPI = json_decode($contactAPI->getResponseBody(), true);
                    $message['phrase'] = $responseAPI['message'];
                    $message['state']  = "ok";
                }
                else
                {
                    $message['phrase'] = "Something was strange with this service !";
                    $message['state']  = "error";
                }
            }
            else
            {
                $message['phrase'] = "Something went wrong with this service !";
                $message['state']  = "error";
            }
        }
    }

    // display the form
    return $app['twig']->render('index.html', array('form' => $form->createView(), 'returnMessage' => $message));
})
->bind('homepage')
;

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
