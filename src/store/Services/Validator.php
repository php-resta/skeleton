<?php

namespace Store\Services;

use Resta\Contracts\ClientContract;
use Zend\Validator\Date;
use Zend\Validator\CreditCard;
use Zend\Validator\EmailAddress;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;

class Validator
{
    /**
     * @param $email
     * @param ClientContract $client
     * @param null|string $input
     * @return bool
     */
    public static function email($email,ClientContract $client,$input=null)
    {
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
     * @param ClientContract $client
     * @param null|string $input
     * @return bool
     */
    public static function creditCard($creditCardNo,ClientContract $client,$input=null)
    {
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
     * @param ClientContract $client
     * @param null|string $input
     * @return bool
     */
    public static function date($date,ClientContract $client,$input=null)
    {
        $format=['format'=>'Y-m-d'];

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
     * check phone number from request input
     *
     * @param null|string $phone
     * @param ClientContract $client
     * @param null|string $input
     * @return mixed|void
     */
    public static function phoneNumber($phone,ClientContract $client=null,$input=null)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        if($client->has('phone_code')){
            $countryCode = $phoneUtil->getRegionCodeForCountryCode(
                str_replace('+','',$client->input('phone_code'))
            );
        }
        else{
            $geo = self::geoPluginInstance();
            $countryCode = $geo['geoplugin_countryCode'];
        }

        try {
            $swissNumberProto = $phoneUtil->parse($phone, $countryCode);

            $valid = $phoneUtil->isValidNumber($swissNumberProto);

            if(false === $valid){
                exception('phoneNumber',['key'=>$input.':'.$phone])->invalidArgument('phone number is not valid');
            }

            if(app()->has('phoneUtil')){
                app()->terminate('phoneUtil');
            }

            app()->register('phoneUtil',$swissNumberProto);

        } catch (NumberParseException $e) {
            if(!is_numeric($countryCode)){
                exception('phoneNumber',['key'=>'phone_code'.':'.$client->input('phone_code')])->invalidArgument($e->getMessage());
            }
            exception('phoneNumber',['key'=>$input.':'.$phone])->invalidArgument($e->getMessage());
        }
    }

    /**
     * @param $validator EmailAddress|CreditCard
     * @param $name
     */
    private static function getMessage($validator,$name)
    {
        if($validator===null){
            exception('invalidValidator',['key'=>$name])->invalidArgument('it is not invalid as the date format for ['.$name.'])');
        }
        foreach ($validator->getMessages() as $messageId => $message) {
            exception($messageId,['key'=>$name])->invalidArgument($message.' ('.$messageId.' for ['.$name.'])');
        }
    }

    /**
     * @param $data
     * @return array
     */
    private static function checkArrayValidator($data)
    {
        return (is_array($data)) ? $data : [$data];
    }

    /**
     * get geo plugin instance
     *
     * @return mixed
     */
    private static function geoPluginInstance()
    {
        if(false === app()->has('geoPluginInstance')){
            app()->register('geoPluginInstance',json_decode(file_get_contents('http://www.geoplugin.net/json.gp'),1));
        }

        return app()->get('geoPluginInstance');
    }
}