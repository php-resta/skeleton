<?php

namespace Store\Packages\PushNotification\Slack;

class SlackConnection
{
    /**
     * @var $hook
     */
    protected $hook;

    /**
     * SlackConnection constructor.
     * @param $hook
     */
    public function __construct($hook)
    {
        $this->hook=$hook;
    }

    /**
     * @param $channel
     * @param $message
     * @return bool
     */
    public function handle($channel,$message)
    {
        // for push notification
        // we have to specify the payload value.
        $data = "payload=" . json_encode(array(
                "channel"       =>  "#".$channel,
                "text"          =>  $message,
            ));

        // We are starting curl for the hook value.
        $ch = curl_init($this->hook);

        // We are entering our curl option values ​​for push notification.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        //finally,return result
        return ($result=="ok") ? true : false;
    }
}