<?php

namespace App\Service\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ControllerExtendsSymfonyRule.
 */
final class ControllerExtendsSymfonyRule extends AbstractControllerRule
{
    /**
     * @param Class_ $node
     * @param Scope  $scope
     *
     * @return array|string[]
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$this->isInControllerNamespace($scope)) {
            return [];
        }

        $className = $node->namespacedName?->toString();
        if (null !== $className && $this->reflectionProvider->hasClass($className)) {
            /** @var ClassReflection $classReflection */
            $classReflection = $this->reflectionProvider->getClass($className);
            if (!$classReflection->isSubclassOf(AbstractController::class)) {
                return [sprintf('Controllers should extend %s.', AbstractController::class)];
            }
        }

        return [];
    }
}
