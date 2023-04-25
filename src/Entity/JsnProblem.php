<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnProblem
 *
 * @ORM\Table(name="jsn_problem")
 * @ORM\Entity
 */
class JsnProblem
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=32, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="improvement_text", type="text", length=65535, nullable=true)
     */
    private $improvementText;

    /**
     * @var string|null
     *
     * @ORM\Column(name="summary", type="text", length=65535, nullable=true)
     */
    private $summary;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remark", type="text", length=65535, nullable=true)
     */
    private $remark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="keyword", type="string", length=84, nullable=true)
     */
    private $keyword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="update_history", type="text", length=65535, nullable=true)
     */
    private $updateHistory;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '0';

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
     * @ORM\ManyToMany(targetEntity="JsnImprovement", inversedBy="problem")
     * @ORM\JoinTable(name="jsn_problem_improvement",
     *   joinColumns={
     *     @ORM\JoinColumn(name="problem_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="improvement_id", referencedColumnName="id")
     *   }
     * )
     */
    private $improvement = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnMeansSubClass", inversedBy="problem")
     * @ORM\JoinTable(name="jsn_problem_means",
     *   joinColumns={
     *     @ORM\JoinColumn(name="problem_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="means_sub_class_id", referencedColumnName="id")
     *   }
     * )
     */
    private $meansSubClass = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnObjectSubClass", inversedBy="problem")
     * @ORM\JoinTable(name="jsn_problem_object",
     *   joinColumns={
     *     @ORM\JoinColumn(name="problem_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="object_sub_class_id", referencedColumnName="id")
     *   }
     * )
     */
    private $objectSubClass = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnSceneSubClass", inversedBy="problem")
     * @ORM\JoinTable(name="jsn_problem_scene",
     *   joinColumns={
     *     @ORM\JoinColumn(name="problem_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="scene_sub_class_id", referencedColumnName="id")
     *   }
     * )
     */
    private $sceneSubClass = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->improvement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->meansSubClass = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objectSubClass = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sceneSubClass = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?string
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

    public function getImprovementText(): ?string
    {
        return $this->improvementText;
    }

    public function setImprovementText(?string $improvementText): self
    {
        $this->improvementText = $improvementText;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getRemark(): ?string
    {
        return $this->remark;
    }

    public function setRemark(?string $remark): self
    {
        $this->remark = $remark;

        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(?string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getUpdateHistory(): ?string
    {
        return $this->updateHistory;
    }

    public function setUpdateHistory(?string $updateHistory): self
    {
        $this->updateHistory = $updateHistory;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
     * @return Collection<int, JsnImprovement>
     */
    public function getImprovement(): Collection
    {
        return $this->improvement;
    }

    public function addImprovement(JsnImprovement $improvement): self
    {
        if (!$this->improvement->contains($improvement)) {
            $this->improvement->add($improvement);
        }

        return $this;
    }

    public function removeImprovement(JsnImprovement $improvement): self
    {
        $this->improvement->removeElement($improvement);

        return $this;
    }

    /**
     * @return Collection<int, JsnMeansSubClass>
     */
    public function getMeansSubClass(): Collection
    {
        return $this->meansSubClass;
    }

    public function addMeansSubClass(JsnMeansSubClass $meansSubClass): self
    {
        if (!$this->meansSubClass->contains($meansSubClass)) {
            $this->meansSubClass->add($meansSubClass);
        }

        return $this;
    }

    public function removeMeansSubClass(JsnMeansSubClass $meansSubClass): self
    {
        $this->meansSubClass->removeElement($meansSubClass);

        return $this;
    }

    /**
     * @return Collection<int, JsnObjectSubClass>
     */
    public function getObjectSubClass(): Collection
    {
        return $this->objectSubClass;
    }

    public function addObjectSubClass(JsnObjectSubClass $objectSubClass): self
    {
        if (!$this->objectSubClass->contains($objectSubClass)) {
            $this->objectSubClass->add($objectSubClass);
        }

        return $this;
    }

    public function removeObjectSubClass(JsnObjectSubClass $objectSubClass): self
    {
        $this->objectSubClass->removeElement($objectSubClass);

        return $this;
    }

    /**
     * @return Collection<int, JsnSceneSubClass>
     */
    public function getSceneSubClass(): Collection
    {
        return $this->sceneSubClass;
    }

    public function addSceneSubClass(JsnSceneSubClass $sceneSubClass): self
    {
        if (!$this->sceneSubClass->contains($sceneSubClass)) {
            $this->sceneSubClass->add($sceneSubClass);
        }

        return $this;
    }

    public function removeSceneSubClass(JsnSceneSubClass $sceneSubClass): self
    {
        $this->sceneSubClass->removeElement($sceneSubClass);

        return $this;
    }

}
