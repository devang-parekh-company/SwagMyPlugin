<?php

declare(strict_types=1);

namespace BlogPlugin\Controller\StoreFront;

use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogStoreFrontController extends StorefrontController
{

    #[Route(
        path: '/blog-info',
        name: 'frontend.blog_info.getBlogInfo',
        methods: ['GET'],
        defaults: ['_routeScope' => ['storefront']]
    )]
    public function getBlogInfo(): Response
    {
        return $this->renderStorefront('@BlogPlugin/storefront/page/blog.html.twig', [
            'example' => 'Hello world devang'
        ]);
    }
}
