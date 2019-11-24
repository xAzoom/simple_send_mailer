<?php

namespace App\Controller;

use Gumlet\ImageResize;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class ImageProcessingController extends AbstractController
{
    const PNG = 'PNG';
    const JPEG = 'JPEG';

    const MAP = [
        IMAGETYPE_PNG => self::PNG,
        IMAGETYPE_JPEG => self::JPEG,
    ];

    /**
     * @Route("/scale", name="api_scale_image")
     */
    public function resize(Request $request, LoggerInterface $imagesLogger, array $availableImages): Response
    {
        $scale = $request->query->get('scale') ?:100;
        $image = ImageResize::createFromString($request->getContent());

        if (!isset(self::MAP[$image->source_type]) || !in_array(self::MAP[$image->source_type], $availableImages)) {
            throw new HttpException(400, 'Unsupported image type');
        }

        $image->scale($scale);

        $response = new Response();
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_INLINE, 'name');
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'image/png');
        $response->setContent($image);

        return $response;
    }
}