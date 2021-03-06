<?php

return [
    'commands' => [
        'status'    => 'sudo service supervisor status',
        'up'        => 'sudo service supervisor start',
        'reread'    => 'sudo supervisorctl reread',
        'update'    => 'sudo supervisorctl update',
        'start'     => 'sudo supervisorctl start',
        'stop'      => 'sudo supervisorctl stop',
        'workers'   => 'sudo supervisorctl status',
        'remove'    => 'sudo supervisorctl remove',
    ],
    'path' => '/etc/supervisor/conf.d',
    'log'   => '/var/www/html/app/resta/src/app/Munch/Storage/Resource',

];
