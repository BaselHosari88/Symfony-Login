<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $Name = null;

    #[ORM\Column(length: 255)]
    public ?string $description = null;

    #[ORM\Column(length: 255)]
    public ?string $duration = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'training', targetEntity: Lesson::class)]
    public Collection $lesson;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $extra_cost = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deleted = null;

    public function __construct()
    {
        $this->lesson = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLesson(): Collection
    {
        return $this->lesson;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lesson->contains($lesson)) {
            $this->lesson->add($lesson);
            $lesson->setTraining($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lesson->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getTraining() === $this) {
                $lesson->setTraining(null);
            }
        }

        return $this;
    }

    public function getExtraCost(): ?string
    {
        return $this->extra_cost;
    }

    public function setExtraCost(?string $extra_cost): self
    {
        $this->extra_cost = $extra_cost;

        return $this;
    }

    public function getDeleted(): ?string
    {
        return $this->deleted;
    }

    public function setDeleted(?string $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
