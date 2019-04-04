<?php

namespace Store\Services;

use Spatie\ArrayToXml\ArrayToXml;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Response
{
    /**
     * json response formatter
     *
     * @param $outputter
     * @return mixed
     */
    public function json($outputter)
    {
        //header set and symfony response call
        header('Content-type:application/json;charset=utf-8');
        $response = new HttpResponse();

        //json data set and get content from symfony response
        $response->setContent(json_encode($outputter));
        return $response->getContent();
    }

    /**
     * xml response formatter
     *
     * @param $outputter
     * @return string
     */
    public function xml($outputter)
    {
        header('Content-type:application/xml;charset=utf-8');
        return ArrayToXml::convert($outputter);
    }
}