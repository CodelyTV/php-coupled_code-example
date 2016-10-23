<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

final class CourseController extends FOSRestController
{
    public function getCourseAction(Request $request)
    {
        return $this->getDoctrine()
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('c', 'v')
            ->from('AppBundle\Model\Course', 'c')
            ->where('c.level', '>', $request->get('from_level', 0))
            ->getQuery()
            ->execute();
    }

    public function getCourseVideosAction($courseId)
    {
        return $this->getDoctrine()
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('c', 'v')
            ->from('AppBundle\Model\Course', 'c')
            ->leftJoin('a.Video', 'v')
            ->where('c.id', '=', $courseId)
            ->getQuery()
            ->execute();
    }
}
