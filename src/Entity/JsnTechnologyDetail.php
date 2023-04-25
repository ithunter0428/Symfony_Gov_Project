<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnologyDetail
 *
 * @ORM\Table(name="jsn_technology_detail")
 * @ORM\Entity
 */
class JsnTechnologyDetail
{
    /**
     * @var int
     *
     * @ORM\Column(name="technology_id", type="bigint", nullable=false)
     */
    private $technologyId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="advantage", type="text", length=65535, nullable=true)
     */
    private $advantage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="notice", type="text", length=65535, nullable=true)
     */
    private $notice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="restriction", type="text", length=65535, nullable=true)
     */
    private $restriction;

    /**
     * @var string|null
     *
     * @ORM\Column(name="development_plan", type="text", length=65535, nullable=true)
     */
    private $developmentPlan;

    /**
     * @var string|null
     *
     * @ORM\Column(name="patent", type="text", length=65535, nullable=true)
     */
    private $patent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remark", type="text", length=65535, nullable=true)
     */
    private $remark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="achievement", type="text", length=65535, nullable=true)
     */
    private $achievement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expert_evaluation", type="text", length=65535, nullable=true)
     */
    private $expertEvaluation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="update_history", type="text", length=65535, nullable=true)
     */
    private $updateHistory;

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
     * @var \JsnTechnology
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="JsnTechnology")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     * })
     */
    private $technology;

    public function getTechnologyId(): ?int
    {
        return $this->technologyId;
    }

    public function getAdvantage(): ?string
    {
        return $this->advantage;
    }

    public function setAdvantage(?string $advantage): self
    {
        $this->advantage = $advantage;

        return $this;
    }

    public function getNotice(): ?string
    {
        return $this->notice;
    }

    public function setNotice(?string $notice): self
    {
        $this->notice = $notice;

        return $this;
    }

    public function getRestriction(): ?string
    {
        return $this->restriction;
    }

    public function setRestriction(?string $restriction): self
    {
        $this->restriction = $restriction;

        return $this;
    }

    public function getDevelopmentPlan(): ?string
    {
        return $this->developmentPlan;
    }

    public function setDevelopmentPlan(?string $developmentPlan): self
    {
        $this->developmentPlan = $developmentPlan;

        return $this;
    }

    public function getPatent(): ?string
    {
        return $this->patent;
    }

    public function setPatent(?string $patent): self
    {
        $this->patent = $patent;

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

    public function getAchievement(): ?string
    {
        return $this->achievement;
    }

    public function setAchievement(?string $achievement): self
    {
        $this->achievement = $achievement;

        return $this;
    }

    public function getExpertEvaluation(): ?string
    {
        return $this->expertEvaluation;
    }

    public function setExpertEvaluation(?string $expertEvaluation): self
    {
        $this->expertEvaluation = $expertEvaluation;

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

    public function getTechnology(): ?JsnTechnology
    {
        return $this->technology;
    }

    public function setTechnology(?JsnTechnology $technology): self
    {
        $this->technology = $technology;

        return $this;
    }


}
