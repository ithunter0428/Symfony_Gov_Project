<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnSceneSubClass
 *
 * @ORM\Table(name="jsn_scene_sub_class", indexes={@ORM\Index(name="scene_id_idx", columns={"scene_id"})})
 * @ORM\Entity
 */
class JsnSceneSubClass
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
     * @var string|null
     *
     * @ORM\Column(name="name_en", type="string", length=100, nullable=true)
     */
    private $nameEn;

    /**
     * @var bool
     *
     * @ORM\Column(name="sort", type="boolean", nullable=false)
     */
    private $sort;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_parent", type="boolean", nullable=false)
     */
    private $isParent = '0';

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
     * @var \JsnScene
     *
     * @ORM\ManyToOne(targetEntity="JsnScene")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="scene_id", referencedColumnName="id")
     * })
     */
    private $scene;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnProblem", mappedBy="sceneSubClass")
     */
    private $problem = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnTechnology", mappedBy="sceneSubClass")
     */
    private $technology = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->problem = new \Doctrine\Common\Collections\ArrayCollection();
        $this->technology = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEn(?string $nameEn): self
    {
        $this->nameEn = $nameEn;

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

    public function isIsParent(): ?bool
    {
        return $this->isParent;
    }

    public function setIsParent(bool $isParent): self
    {
        $this->isParent = $isParent;

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

    public function getScene(): ?JsnScene
    {
        return $this->scene;
    }

    public function setScene(?JsnScene $scene): self
    {
        $this->scene = $scene;

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
            $problem->addSceneSubClass($this);
        }

        return $this;
    }

    public function removeProblem(JsnProblem $problem): self
    {
        if ($this->problem->removeElement($problem)) {
            $problem->removeSceneSubClass($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, JsnTechnology>
     */
    public function getTechnology(): Collection
    {
        return $this->technology;
    }

    public function addTechnology(JsnTechnology $technology): self
    {
        if (!$this->technology->contains($technology)) {
            $this->technology->add($technology);
            $technology->addSceneSubClass($this);
        }

        return $this;
    }

    public function removeTechnology(JsnTechnology $technology): self
    {
        if ($this->technology->removeElement($technology)) {
            $technology->removeSceneSubClass($this);
        }

        return $this;
    }

}
