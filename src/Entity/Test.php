<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Test
 */
#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $test = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTest(): ?string
    {
        return $this->test;
    }

    /**
     * @param string $test
     *
     * @return $this
     */
    public function setTest(string $test): static
    {
        $this->test = $test;

        return $this;
    }
}
