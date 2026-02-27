<?php

declare(strict_types=1);

namespace Application\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    /**
     * @param array<mixed> $parameters
     */
    protected function renderHxTarget(
        string $view,
        array $parameters = [],
        ?Response $response = null
    ): Response {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $hxTarget = $request?->headers?->get('HX-Target');

        return match ($hxTarget) {
            '', null => parent::render($view, $parameters, $response),
            default => parent::renderBlock(
                view: $view,
                block: 'htmx_' . $hxTarget,
                parameters: $parameters,
                response: $response
            )
        };
    }
}
