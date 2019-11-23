<?php

namespace App\Controller;

use Gumlet\ImageResize;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class ImageProcessingController extends AbstractController
{
    /**
     * @Route("/scale", name="api_scale_image")
     */
    public function resize(Request $request): Response
    {
        $scale = $request->query->get('scale') ?:100;

        $image = ImageResize::createFromString($request->getContent());
        $image->scale($scale);

        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'name');
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'image/png');
        $response->setContent($image);

        return $response;
    }


}