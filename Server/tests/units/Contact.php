<?php

namespace SimpleWebServer\Resources\tests\units;

require_once __DIR__.'/../lib/mageekguy.atoum.phar';

include __DIR__.'/../../src/SimpleWebServer/Resources/Contact.php';

use \mageekguy\atoum;
use \SimpleWebServer\Resources;

class Contact extends atoum\test
{
    public function testToArray()
    {
        $contact = new Resources\Contact('Wayne', 'Bruce', 'batman@superheroes.com');

        $this->array($contact->toArray())
            ->isEqualTo(array('Wayne', 'Bruce', 'batman@superheroes.com'))
        ;
    }
}