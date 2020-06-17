<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\DomainValidationViolation\Formatter;

use App\Core\Domain\Validation\ValidationViolation;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonErrorResponseFormatter implements ErrorResponseFormatterInterface
{
    /** @var TranslatorInterface */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param ValidationViolation[] $violations
     */
    public function format(array $violations): string
    {
        $errors = [];

        foreach ($violations as $violation) {
            $error = [
                'message' => $this->translator->trans($violation->getMessage(), $violation->getParameters(), $violation->getDomain()),
            ];

            if (null !== $violation->getProperty()) {
                $error['property'] = $violation->getProperty();
            }

            $errors[] = $error;
        }

        return json_encode(['errors' => $errors]);
    }
}
