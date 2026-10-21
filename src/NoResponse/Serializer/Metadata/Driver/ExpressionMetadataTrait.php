<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Metadata\Driver;

use NoResponse\Serializer\Exception\InvalidMetadataException;
use NoResponse\Serializer\Expression\CompilableExpressionEvaluatorInterface;
use NoResponse\Serializer\Expression\Expression;

trait ExpressionMetadataTrait
{
    /**
     * @var CompilableExpressionEvaluatorInterface
     */
    private $expressionEvaluator;

    /**
     * @return Expression|string
     *
     * @throws InvalidMetadataException
     */
    private function parseExpression(string $expression, array $names = [])
    {
        if (null === $this->expressionEvaluator) {
            return $expression;
        }

        try {
            return $this->expressionEvaluator->parse($expression, array_merge(['context', 'property_metadata', 'object'], $names));
        } catch (\LogicException $e) {
            throw new InvalidMetadataException(sprintf('Can not parse the expression "%s"', $expression), 0, $e);
        }
    }
}
