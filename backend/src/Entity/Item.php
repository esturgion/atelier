<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'item_position')]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Project $project = null;

    #[ORM\OneToOne(mappedBy: 'item')]
    private ?Folder $folder = null;

    #[ORM\ManyToOne(inversedBy: 'children')]
    private ?Folder $parentFolder = null;

    #[ORM\OneToOne(mappedBy: 'item')]
    private ?Content $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): static
    {
        $this->project = $project;

        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(Folder $folder): static
    {
        // set the owning side of the relation if necessary
        if ($folder->getItem() !== $this) {
            $folder->setItem($this);
        }

        $this->folder = $folder;

        return $this;
    }

    public function getParentFolder(): ?Folder
    {
        return $this->parentFolder;
    }

    public function setParentFolder(?Folder $parentFolder): static
    {
        $this->parentFolder = $parentFolder;

        return $this;
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function setContent(Content $content): static
    {
        // set the owning side of the relation if necessary
        if ($content->getItem() !== $this) {
            $content->setItem($this);
        }

        $this->content = $content;

        return $this;
    }
}
