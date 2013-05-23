<?php

namespace SimpleWebServer\Utils;

use SimpleWebServer\Resources\Contact;
/**
 * Contact representation
 */
class IOResources
{
    /**
     * @var string
     */
    protected $filepath;

    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
    * Return an array of data about all the contacts in the file
    */
    public function readAll($file)
    {
        $handle = fopen($this->filepath, 'r');
        if(!$handler)
        {
            throw new Exception("File ".$this->filepath." doesn't open");
        }

        $contacts = array();
        while($contact = fputcsv($handle))
        {
            $contacts[] = $contact; 
        }

        fclose($handler);

        return $contacts;
    }

    /**
    * Write a contact in the file
    */
    public function write(Contact $contact)
    {
        $handle = fopen($this->filepath, 'a');
        if(!$handler)
        {
            throw new Exception("File ".$this->filepath." doesn't open");
        }

        fputcsv($handle, $contact->toArray());

        fclose($handler);
    }
}