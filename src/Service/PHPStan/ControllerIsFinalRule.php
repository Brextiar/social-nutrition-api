<?php

namespace App\Service\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Analyser\Scope;

/**
 * Class ControllerIsFinalRule.
 */
final class ControllerIsFinalRule extends AbstractControllerRule
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

        // Skip abstract controllers
        if ($node->isAbstract()) {
            return [];
        }

        if (!$node->isFinal()) {
            return ['ADR n°1: A Symfony controller should be final.'];
        }

        return [];
    }
}
