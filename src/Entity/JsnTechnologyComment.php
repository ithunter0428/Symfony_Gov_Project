<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnologyComment
 *
 * @ORM\Table(name="jsn_technology_comment", indexes={@ORM\Index(name="IDX_B73035434235D463", columns={"technology_id"})})
 * @ORM\Entity
 */
class JsnTechnologyComment
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
     * @ORM\Column(name="to_basic_information", type="text", length=65535, nullable=true)
     */
    private $toBasicInformation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_summary", type="text", length=65535, nullable=true)
     */
    private $toSummary;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_reference_web", type="text", length=65535, nullable=true)
     */
    private $toReferenceWeb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_contact_information", type="text", length=65535, nullable=true)
     */
    private $toContactInformation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_keyword", type="text", length=65535, nullable=true)
     */
    private $toKeyword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_scene", type="text", length=65535, nullable=true)
     */
    private $toScene;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_object", type="text", length=65535, nullable=true)
     */
    private $toObject;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_means", type="text", length=65535, nullable=true)
     */
    private $toMeans;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_document", type="text", length=65535, nullable=true)
     */
    private $toDocument;

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

    public function getToBasicInformation(): ?string
    {
        return $this->toBasicInformation;
    }

    public function setToBasicInformation(?string $toBasicInformation): self
    {
        $this->toBasicInformation = $toBasicInformation;

        return $this;
    }

    public function getToSummary(): ?string
    {
        return $this->toSummary;
    }

    public function setToSummary(?string $toSummary): self
    {
        $this->toSummary = $toSummary;

        return $this;
    }

    public function getToReferenceWeb(): ?string
    {
        return $this->toReferenceWeb;
    }

    public function setToReferenceWeb(?string $toReferenceWeb): self
    {
        $this->toReferenceWeb = $toReferenceWeb;

        return $this;
    }

    public function getToContactInformation(): ?string
    {
        return $this->toContactInformation;
    }

    public function setToContactInformation(?string $toContactInformation): self
    {
        $this->toContactInformation = $toContactInformation;

        return $this;
    }

    public function getToKeyword(): ?string
    {
        return $this->toKeyword;
    }

    public function setToKeyword(?string $toKeyword): self
    {
        $this->toKeyword = $toKeyword;

        return $this;
    }

    public function getToScene(): ?string
    {
        return $this->toScene;
    }

    public function setToScene(?string $toScene): self
    {
        $this->toScene = $toScene;

        return $this;
    }

    public function getToObject(): ?string
    {
        return $this->toObject;
    }

    public function setToObject(?string $toObject): self
    {
        $this->toObject = $toObject;

        return $this;
    }

    public function getToMeans(): ?string
    {
        return $this->toMeans;
    }

    public function setToMeans(?string $toMeans): self
    {
        $this->toMeans = $toMeans;

        return $this;
    }

    public function getToDocument(): ?string
    {
        return $this->toDocument;
    }

    public function setToDocument(?string $toDocument): self
    {
        $this->toDocument = $toDocument;

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
