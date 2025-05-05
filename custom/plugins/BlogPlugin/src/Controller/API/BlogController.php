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

#[Route(defaults: ['_routeScope' => ['api']])]
class BlogController extends AbstractController
{
    #[Route(path: '/api/_action/blogs', name: 'api.custom.blog.list', methods: ['GET'])]
    public function getBlogList(Context $context): JsonResponse
    {
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
    }

    #[Route(path: '/api/_action/blogs/{id}', name: 'api.custom.blog.detail', methods: ['GET'])]
    public function getBlog(string $id, Context $context): JsonResponse
    {
        $blogRepository = $this->container->get('blog.repository');
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('id', $id));
        $criteria->addAssociation('products');
        $criteria->addAssociation('blogCategories');
        $criteria->addAssociation('translations');
        $criteria->addFilter(new EqualsFilter('active', true));
        $result = $blogRepository->search($criteria, $context);
        $blog = $result->first();

        return new JsonResponse([
            'success' => true,
            'data' => $blog,
        ]);
    }

    #[Route(path: '/api/_action/add-blog', name: 'api.custom.add-blog', methods: ['POST'])]
    public function addBlog(Request $request, Context $context)
    {
        // Example request body:
        $blogRepository = $this->container->get('blog.repository');
        $data = json_decode($request->getContent(), true);

        // Wrap data in array to match expected format
        $data = [$data];
        $blogRepository->create($data, $context);
        return new JsonResponse([
            'success' => true,
            'data' => $data[0],
        ]);
    }

    #[Route(path: '/api/_action/blog-category', name: 'api.custom.blog-category.list', methods: ['GET'])]
    public function getBlogCategoryList(Context $context): JsonResponse
    {
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
    }

    #[Route(path: '/api/_action/blog-category/{id}', name: 'api.custom.blog.detail', methods: ['GET'])]
    public function getBlogCategory(string $id, Context $context): JsonResponse
    {
        $blogCategoryRepository = $this->container->get('blog_category.repository');
        $criteria = new Criteria();
        $criteria->addFilter(new EqualsFilter('id', $id));
        $criteria->addAssociation('blogs');
        $criteria->addAssociation('translations');
        $result = $blogCategoryRepository->search($criteria, $context);
        $blogCategory = $result->first();

        return new JsonResponse([
            'success' => true,
            'data' => $blogCategory,
        ]);
    }


    #[Route(path: '/api/_action/add-blog-category', name: 'api.custom.add-blog-category', methods: ['POST'])]
    public function addBlogCategory(Request $request, Context $context)
    {
        // Example request body:
        $blogCategoryRepository = $this->container->get('blog_category.repository');
        $data = json_decode($request->getContent(), true);

        // Wrap data in array to match expected format
        $data = [$data];

        $blogCategoryRepository->create($data, $context);
        return new JsonResponse([
            'success' => true,
            'message' => 'created successfully',
        ]);
    }
}
