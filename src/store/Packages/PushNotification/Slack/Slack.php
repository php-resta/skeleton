<?php

namespace Store\Packages\PushNotification\Slack;

class Slack
{
    /**
     * @var $hook
     */
    protected static $hook;

    /**
     * @var $channel
     */
    protected static $channel;

    /**
     * @param string $channel
     * @return Slack
     */
    public static function channel($channel='default')
    {
        //we get configuration settings for slack.
        $config=config('slack.'.$channel);

        //channel and hook information.
        self::$channel=$config['channel'];
        self::$hook=$config['hook'];

        //return static object
        return new static();
    }

    /**
     * @param $message
     * @return mixed
     */
    public static function push($message)
    {
        // if the hook object has a null value,
        // we will set the default value to channel.
        if(self::$hook===null){
            self::channel('default');
        }

        //as a result we send push notifications for slack.
        return (new SlackConnection(self::$hook))->handle(self::$channel,$message);
    }
}