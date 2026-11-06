<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note extends Content
{
    #[ORM\Column(name: 'note_document', type: Types::JSONB)]
    private array $document = [];

    public function getDocument(): array
    {
        return $this->document;
    }

    public function setDocument(array $document): static
    {
        $this->document = $document;

        return $this;
    }
}
