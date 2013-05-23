<?php

namespace SimpleWebServer\Resources;

/**
 * Contact representation
 */
class Contact
{
    /**
     * @var string
     */
    protected $lastname = "";

    /**
     * @var string
     */
    protected $firstname = "";

    /**
     * @var string
     */
    protected $mail = "";

    public function __construct($lastname, $firstname, $mail)
    {
        $this->lastname  = $lastname;
        $this->firstname = $firstname;
        $this->mail      = $mail;
    }

    public function toArray()
    {
        return array(
            $this->lastname,
            $this->firstname,
            $this->mail
        );
    }
}