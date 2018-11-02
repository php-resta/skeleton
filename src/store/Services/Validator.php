<?php

namespace Store\Services;

use Zend\Validator\Date;
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
     * @param $date
     * @param array $format
     * @return bool
     */
    public static function date($date,$format=['format'=>'Y-m-d']){

        //is array control for credit card
        $date=self::checkArrayValidator($date);

        //validator object for credit card
        $validator = new Date($format);

        foreach ($date as $dateValue){

            //validator valid
            if (!$validator->isValid($dateValue)) {
                self::getMessage($validator=null,$dateValue);
            }
        }


        return true;
    }

    /**
     * @param $validator EmailAddress|CreditCard
     * @param $name
     */
    private static function getMessage($validator,$name){

        if($validator===null){
            throw new \UnexpectedValueException('it is not invalid as the date format for ['.$name.'])');
        }
        foreach ($validator->getMessages() as $messageId => $message) {
            throw new \UnexpectedValueException($message.' ('.$messageId.' for ['.$name.'])');
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