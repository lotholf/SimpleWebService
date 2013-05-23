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
    * Return an empty array if the file doesn't exist
    */
    public function readAll()
    {
        $contacts = array();

        if(file_exists($this->filepath))
        {
            $handle = fopen($this->filepath, 'r');
            if(!$handle)
            {
                throw new \Exception("File ".$this->filepath." doesn't open");
            }

            while($contact = fgetcsv($handle))
            {
                $contacts[] = $contact; 
            }

            fclose($handle);
        }

        return $contacts;
    }

    /**
    * Write a contact in the file
    */
    public function write(Contact $contact)
    {

        $handle = fopen($this->filepath, 'a');
        if(!$handle)
        {
            throw new \Exception("File ".$this->filepath." doesn't open");
        }

        fputcsv($handle, $contact->toArray());

        fclose($handle);
    }
}