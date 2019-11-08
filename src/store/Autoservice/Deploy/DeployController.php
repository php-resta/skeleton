<?php

namespace Store\Autoservice\Deploy;

use Resta\Foundation\ApplicationProvider;

class DeployController extends ApplicationProvider
{
    /**
     * run deployment for application
     *
     * @return mixed
     */
    public function getIndexAction()
    {
        if($this->isAccessable()){

            $project = get('project');

            shell_exec("cd /var/www/html/app/munch/src/app && sudo chmod -R 777 ".$project." 2>&1");
            $result = shell_exec("cd /var/www/html/app/munch/src/app/".$project." && git pull origin master --force  2>&1");

            $author =  shell_exec("cd /var/www/html/api/src/app/Munch && /usr/bin/git log -1 --pretty=format:'%an' 2>&1");
            $commitMessage =  shell_exec("cd /var/www/html/api/src/app/Munch && /usr/bin/git log -1 --pretty=%B 2>&1");

            $output =  'Commit Author : '.ucfirst($author).' '.PHP_EOL.'
                        Commit Message : '.$commitMessage.' '.PHP_EOL.'
                        Stream : '.PHP_EOL.'
                        '.$result.'';


            return $output;
        }

        return false;
    }

    /**
     * get accessible for deployment
     *
     * @return bool
     */
    private function isAccessable()
    {
        $token = get('token',null);

        if($token !== config('app.deployment')){
            return false;
        }

        return true;
    }

}