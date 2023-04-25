<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * JsnMemberMeta
 *
 * @ORM\Table(name="jsn_member_meta")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class JsnMemberMeta
{
    /**
     * @var int
     *
     * @ORM\Column(name="member_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="affiliation_category", type="integer", nullable=true)
     */
    private $affiliationCategory;

    /**
     * @var int|null
     *
     * @ORM\Column(name="business_category", type="integer", nullable=true)
     */
    private $businessCategory;

    /**
     * @var string|null
     *
     * @ORM\Column(name="affiliation", type="string", length=128, nullable=true)
     */
    private $affiliation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="questionnaire_answer", type="text", length=65535, nullable=true)
     */
    private $questionnaireAnswer;

    /**
     * @var int
     *
     * @ORM\Column(name="is_receive_mail", type="integer", nullable=false)
     */
    private $isReceiveMail;

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
     * @var \JsnMember
     *
     * @ORM\OneToOne(targetEntity="JsnMember")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */

    private $member;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAffiliationCategory(): ?int
    {
        return $this->affiliationCategory;
    }

    public function setAffiliationCategory(?int $affiliationCategory): self
    {
        $this->affiliationCategory = $affiliationCategory;

        return $this;
    }

    public function getBusinessCategory(): ?int
    {
        return $this->businessCategory;
    }

    public function setBusinessCategory(?int $businessCategory): self
    {
        $this->businessCategory = $businessCategory;

        return $this;
    }

    public function getAffiliation(): ?string
    {
        return $this->affiliation;
    }

    public function setAffiliation(?string $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }

    public function getQuestionnaireAnswer(): ?string
    {
        return $this->questionnaireAnswer;
    }

    public function setQuestionnaireAnswer(?string $questionnaireAnswer): self
    {
        $this->questionnaireAnswer = $questionnaireAnswer;

        return $this;
    }

    public function getIsReceiveMail(): ?int
    {
        return $this->isReceiveMail;
    }

    public function setIsReceiveMail(int $isReceiveMail): self
    {
        $this->isReceiveMail = $isReceiveMail;

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
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getMember(): ?JsnMember
    {
        return $this->member;
    }

    public function setMember($member)
    {
        $this->member = $member;

        return $this;
    }


}
