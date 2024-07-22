<?php

namespace App\Service\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;

use function Symfony\Component\String\u;

/**
 * @implements Rule<Class_>
 */
abstract class AbstractControllerRule implements Rule
{
    protected ReflectionProvider $reflectionProvider;

    /**
     * @param ReflectionProvider $reflectionProvider
     */
    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    /**
     * Restricts on class nodes only. One rule, one node and check.
     *
     * @return string
     */
    public function getNodeType(): string
    {
        return Class_::class;
    }

    /**
     * @param Node  $node
     * @param Scope $scope
     *
     * @return array|RuleError[]|string[]
     */
    abstract public function processNode(Node $node, Scope $scope): array;

    /**
     * @param Scope $scope
     *
     * @return bool
     */
    protected function isInControllerNamespace(Scope $scope): bool
    {
        return u($scope->getNamespace())->startsWith('App\Controller');
    }
}
