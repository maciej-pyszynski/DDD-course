<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\DomainValidationViolation\EventListener;

use App\Core\Domain\Exception\ValidationAwareExceptionInterface;
use App\Core\Infrastructure\DomainValidationViolation\Formatter\ErrorResponseFormatterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ValidationAwareExceptionListener
{
    /** @var ErrorResponseFormatterInterface */
    private $responseFormatter;

    public function __construct(ErrorResponseFormatterInterface $responseFormatter)
    {
        $this->responseFormatter = $responseFormatter;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof ValidationAwareExceptionInterface) {
            return;
        }

        $response = new JsonResponse();
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $response->setContent($this->responseFormatter->format($exception->getViolations()));

        $event->setResponse($response);

        $event->stopPropagation();
    }
}
