<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnImprovement
 *
 * @ORM\Table(name="jsn_improvement")
 * @ORM\Entity
 */
class JsnImprovement
{
    /**
     * @var bool
     *
     * @ORM\Column(name="id", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=true)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="sort", type="boolean", nullable=false)
     */
    private $sort;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnProblem", mappedBy="improvement")
     */
    private $problem = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->problem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function isId(): ?bool
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isSort(): ?bool
    {
        return $this->sort;
    }

    public function setSort(bool $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, JsnProblem>
     */
    public function getProblem(): Collection
    {
        return $this->problem;
    }

    public function addProblem(JsnProblem $problem): self
    {
        if (!$this->problem->contains($problem)) {
            $this->problem->add($problem);
            $problem->addImprovement($this);
        }

        return $this;
    }

    public function removeProblem(JsnProblem $problem): self
    {
        if ($this->problem->removeElement($problem)) {
            $problem->removeImprovement($this);
        }

        return $this;
    }

}
