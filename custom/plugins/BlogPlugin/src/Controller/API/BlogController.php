<?php

declare(strict_types=1);

namespace BlogPlugin\Controller\API;

use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Symfony\Component\HttpFoundation\Response;

// Add API versioning prefix to routes
#[Route(defaults: ['_routeScope' => ['api']], path: "/api")]
class BlogController extends AbstractController
{
    // Add return type declaration
    #[Route(path: '/blogs', name: 'api.custom.blog.list', methods: ['GET'])]
    public function getBlogList(Context $context): JsonResponse
    {
        try {
            $blogRepository = $this->container->get('blog.repository');
            $criteria = new Criteria();
            $criteria->setLimit(50);
            $criteria->addAssociation('products');
            $criteria->addAssociation('blogCategories');
            $criteria->addAssociation('translations');
            $criteria->addFilter(new EqualsFilter('active', true));
            $result = $blogRepository->search($criteria, $context);
            $blogs = $result->getEntities();
            return new JsonResponse([
                'success' => true,
                'data' => $blogs,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route(path: '/blogs/{id}', name: 'api.custom.blog.detail', methods: ['GET'])]
    public function getBlog(string $id, Context $context): JsonResponse
    {
        try {
            $blogRepository = $this->container->get('blog.repository');
            $criteria = new Criteria();
            $criteria->addFilter(new EqualsFilter('id', $id));
            $criteria->addAssociation('products');
            $criteria->addAssociation('blogCategories');
            $criteria->addAssociation('translations');
            $criteria->addFilter(new EqualsFilter('active', true));
            $result = $blogRepository->search($criteria, $context);
            $blog = $result->first();

            if (!$blog) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Blog not found'
                ], Response::HTTP_NOT_FOUND);
            }

            return new JsonResponse([
                'success' => true,
                'data' => $blog,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Add return type and use RequestDataBag for validation
    #[Route(path: '/blogs', name: 'api.custom.add-blog', methods: ['POST'])]
    public function addBlog(Request $request, RequestDataBag $data, Context $context): JsonResponse
    {
        try {
            $blogRepository = $this->container->get('blog.repository');
            $requestData = json_decode($request->getContent(), true);

            // Add basic validation
            if (empty($requestData)) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Invalid request data'
                ], Response::HTTP_BAD_REQUEST);
            }

            $blogRepository->create([$requestData], $context);

            return new JsonResponse([
                'success' => true,
                'data' => $requestData,
                'message' => 'Blog created successfully'
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route(path: '/blog-categories', name: 'api.custom.blog-category.list', methods: ['GET'])]
    public function getBlogCategoryList(Context $context): JsonResponse
    {
        try {
            $blogCategoryRepository = $this->container->get('blog_category.repository');
            $criteria = new Criteria();
            $criteria->addAssociation('blogs');
            $criteria->addAssociation('translations');
            $criteria->setLimit(50);
            $result = $blogCategoryRepository->search($criteria, $context);
            $blogCategory = $result->getEntities();
            return new JsonResponse([
                'success' => true,
                'data' => $blogCategory,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route(path: '/blog-categories/{id}', name: 'api.custom.blog-category.detail', methods: ['GET'])]
    public function getBlogCategory(string $id, Context $context): JsonResponse
    {
        try {
            $blogCategoryRepository = $this->container->get('blog_category.repository');
            $criteria = new Criteria();
            $criteria->addFilter(new EqualsFilter('id', $id));
            $criteria->addAssociation('blogs');
            $criteria->addAssociation('translations');
            $result = $blogCategoryRepository->search($criteria, $context);
            $blogCategory = $result->first();

            if (!$blogCategory) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Blog category not found'
                ], Response::HTTP_NOT_FOUND);
            }

            return new JsonResponse([
                'success' => true,
                'data' => $blogCategory,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route(path: '/blog-categories', name: 'api.custom.add-blog-category', methods: ['POST'])]
    public function addBlogCategory(Request $request, RequestDataBag $data, Context $context): JsonResponse
    {
        try {
            $blogCategoryRepository = $this->container->get('blog_category.repository');
            $requestData = json_decode($request->getContent(), true);

            if (empty($requestData)) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Invalid request data'
                ], Response::HTTP_BAD_REQUEST);
            }

            $blogCategoryRepository->create([$requestData], $context);

            return new JsonResponse([
                'success' => true,
                'data' => $requestData,
                'message' => 'Blog category created successfully'
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
