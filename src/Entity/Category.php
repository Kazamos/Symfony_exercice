<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name_cat = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_cat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCat(): ?string
    {
        return $this->name_cat;
    }

    public function setNameCat(string $name_cat): static
    {
        $this->name_cat = $name_cat;

        return $this;
    }

    public function getDescriptionCat(): ?string
    {
        return $this->description_cat;
    }

    public function setDescriptionCat(string $description_cat): static
    {
        $this->description_cat = $description_cat;

        return $this;
    }
}
