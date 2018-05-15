<?php

namespace Store\Services;

use Zend\Validator\EmailAddress;
use Zend\Validator\CreditCard;

class Validator {

    /**
     * @param $email
     * @return bool
     */
    public static function email($email){

        //is array control for email
        $email=self::checkArrayValidator($email);

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
     * @param $creditCardNo
     * @return bool
     */
    public static function creditCard($creditCardNo){

        //is array control for credit card
        $creditCardNo=self::checkArrayValidator($creditCardNo);

        //validator object for credit card
        $validator = new CreditCard();

        foreach ($creditCardNo as $credit){

            //validator valid
            if (!$validator->isValid($credit)) {
                self::getMessage($validator,$credit);
            }
        }


        return true;
    }

    /**
     * @param $validator EmailAddress|CreditCard
     * @param $name
     */
    private static function getMessage($validator,$name){

        foreach ($validator->getMessages() as $messageId => $message) {
            throw new \InvalidArgumentException($message.' ('.$messageId.' for ['.$name.'])');
        }
    }

    /**
     * @param $data
     * @return array
     */
    private static function checkArrayValidator($data){

        return (is_array($data)) ? $data : [$data];
    }


}