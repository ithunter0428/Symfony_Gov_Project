<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnologyDetailComment
 *
 * @ORM\Table(name="jsn_technology_detail_comment", indexes={@ORM\Index(name="IDX_C04B5A774235D463", columns={"technology_id"})})
 * @ORM\Entity
 */
class JsnTechnologyDetailComment
{
    /**
     * @var bool
     *
     * @ORM\Column(name="author", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $author = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_advantage", type="text", length=65535, nullable=true)
     */
    private $toAdvantage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_notice", type="text", length=65535, nullable=true)
     */
    private $toNotice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_restriction", type="text", length=65535, nullable=true)
     */
    private $toRestriction;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_development_plan", type="text", length=65535, nullable=true)
     */
    private $toDevelopmentPlan;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_patent", type="text", length=65535, nullable=true)
     */
    private $toPatent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_remark", type="text", length=65535, nullable=true)
     */
    private $toRemark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_achievement", type="text", length=65535, nullable=true)
     */
    private $toAchievement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_expert_evaluation", type="text", length=65535, nullable=true)
     */
    private $toExpertEvaluation;

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

    public function isAuthor(): ?bool
    {
        return $this->author;
    }

    public function getToAdvantage(): ?string
    {
        return $this->toAdvantage;
    }

    public function setToAdvantage(?string $toAdvantage): self
    {
        $this->toAdvantage = $toAdvantage;

        return $this;
    }

    public function getToNotice(): ?string
    {
        return $this->toNotice;
    }

    public function setToNotice(?string $toNotice): self
    {
        $this->toNotice = $toNotice;

        return $this;
    }

    public function getToRestriction(): ?string
    {
        return $this->toRestriction;
    }

    public function setToRestriction(?string $toRestriction): self
    {
        $this->toRestriction = $toRestriction;

        return $this;
    }

    public function getToDevelopmentPlan(): ?string
    {
        return $this->toDevelopmentPlan;
    }

    public function setToDevelopmentPlan(?string $toDevelopmentPlan): self
    {
        $this->toDevelopmentPlan = $toDevelopmentPlan;

        return $this;
    }

    public function getToPatent(): ?string
    {
        return $this->toPatent;
    }

    public function setToPatent(?string $toPatent): self
    {
        $this->toPatent = $toPatent;

        return $this;
    }

    public function getToRemark(): ?string
    {
        return $this->toRemark;
    }

    public function setToRemark(?string $toRemark): self
    {
        $this->toRemark = $toRemark;

        return $this;
    }

    public function getToAchievement(): ?string
    {
        return $this->toAchievement;
    }

    public function setToAchievement(?string $toAchievement): self
    {
        $this->toAchievement = $toAchievement;

        return $this;
    }

    public function getToExpertEvaluation(): ?string
    {
        return $this->toExpertEvaluation;
    }

    public function setToExpertEvaluation(?string $toExpertEvaluation): self
    {
        $this->toExpertEvaluation = $toExpertEvaluation;

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
