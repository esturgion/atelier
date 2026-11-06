<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(
    name: 'content_type',
    type: 'string'
)]
#[ORM\DiscriminatorMap([
    'note' => Note::class,
])]
abstract class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'content_title', length: 250)]
    private ?string $title = null;

    #[ORM\Column(name: 'content_created_at')]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: 'content_updated_at', nullable: true)]
    private ?\DateTimeImmutable $udpatedAt = null;

    #[ORM\OneToOne(inversedBy: 'content', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $item = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUdpatedAt(): ?\DateTimeImmutable
    {
        return $this->udpatedAt;
    }

    public function setUdpatedAt(?\DateTimeImmutable $udpatedAt): static
    {
        $this->udpatedAt = $udpatedAt;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(Item $item): static
    {
        $this->item = $item;

        return $this;
    }
}
