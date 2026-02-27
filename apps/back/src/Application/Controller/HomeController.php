<?php

declare(strict_types=1);

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends BaseController
{
    #[Route('/', name: 'home')]
    public function __invoke(): Response
    {
        return $this->renderHxTarget('home/index.html.twig');
    }
}
