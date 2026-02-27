<?php

declare(strict_types=1);

namespace Application\Controller\CRUD;

use Application\Controller\BaseController;
use Application\MessageBus\QueryBus;
use Domain\UseCase\Query\Product\GetAll\Query;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends BaseController
{
    public function __construct(
        private readonly QueryBus $queryBus,
    ) {
    }

    #[Route('/products', name: 'crud.product.list')]
    public function __invoke(): Response
    {
        $products = $this->queryBus->dispatch(new Query());

        return $this->renderHxTarget('product/list.html.twig', [
            'products' => $products,
        ]);
    }
}