<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

final class VideoController extends FOSRestController
{
    public function postVideoAction(Request $request)
    {
        $sql  = "INSERT INTO video (title, url, course_id) 
                VALUES (\"{$request->get('title')}\",
                        \"{$request->get('url')}\",
                        {$request->get('course_id')}
                )";
        $stmt = $this->getDoctrine()->getConnection()->prepare($sql);
        $stmt->execute();

        $videoId = $stmt->lastInsertId();

        return [
            'id'        => $videoId,
            'title'     => $request->get('title'),
            'url'       => $request->get('url'),
            'course_id' => $request->get('course_id'),
        ];
    }
}
