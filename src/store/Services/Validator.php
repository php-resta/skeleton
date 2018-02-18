<?php

namespace Store\Services;

use Zend\Validator\EmailAddress;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

class Validator {

    /**
     * @param $email
     * @return bool
     */
    public static function email($email){

        //is array control for email
        $email=(is_array($email)) ? $email : [$email];

        //validator object for email
        $validator = new EmailAddress();

        foreach ($email as $mail){

            //validator valid
            if (!$validator->isValid($mail)) {
                self::getMessage($validator,$mail);
            }
        }


        return true;
    }

    /**
     * @param $validator
     * @param $name
     */
    private static function getMessage($validator,$name){

        foreach ($validator->getMessages() as $messageId => $message) {
            throw new \InvalidArgumentException($message.' ('.$messageId.' for ['.$name.'])');
        }
    }


}