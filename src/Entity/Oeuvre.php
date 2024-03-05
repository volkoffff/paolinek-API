<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
#[ApiResource(
    normalizationContext: [
        'groups' => ['oeuvres:read'],
    ]
)]
#[ApiResource()]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['oeuvres:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['oeuvres:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['oeuvres:read'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['oeuvres:read'])]
    private ?string $size = null;

    #[ORM\Column(length: 255)]
    #[Groups(['oeuvres:read'])]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'oeuvres')]
    #[Groups(['oeuvres:read'])]
    private Collection $Tag;

    #[ORM\ManyToOne(inversedBy: 'oeuvres')]
    #[Groups(['oeuvres:read'])]
    private ?Serie $serie = null;

    #[ORM\Column(length: 1500, nullable: true)]
    #[Groups(['oeuvres:read'])]
    private ?string $description = null;

    public function __construct()
    {
        $this->Tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->Tag;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->Tag->contains($tag)) {
            $this->Tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->Tag->removeElement($tag);

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
