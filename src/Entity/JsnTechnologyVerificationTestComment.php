<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnologyVerificationTestComment
 *
 * @ORM\Table(name="jsn_technology_verification_test_comment", indexes={@ORM\Index(name="IDX_406283044235D463", columns={"technology_id"})})
 * @ORM\Entity
 */
class JsnTechnologyVerificationTestComment
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
     * @ORM\Column(name="to_duration", type="text", length=65535, nullable=true)
     */
    private $toDuration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_location", type="text", length=65535, nullable=true)
     */
    private $toLocation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_content", type="text", length=65535, nullable=true)
     */
    private $toContent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_effect", type="text", length=65535, nullable=true)
     */
    private $toEffect;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_byproduct", type="text", length=65535, nullable=true)
     */
    private $toByproduct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_exposure", type="text", length=65535, nullable=true)
     */
    private $toExposure;

    /**
     * @var string|null
     *
     * @ORM\Column(name="to_cost", type="text", length=65535, nullable=true)
     */
    private $toCost;

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

    public function getToDuration(): ?string
    {
        return $this->toDuration;
    }

    public function setToDuration(?string $toDuration): self
    {
        $this->toDuration = $toDuration;

        return $this;
    }

    public function getToLocation(): ?string
    {
        return $this->toLocation;
    }

    public function setToLocation(?string $toLocation): self
    {
        $this->toLocation = $toLocation;

        return $this;
    }

    public function getToContent(): ?string
    {
        return $this->toContent;
    }

    public function setToContent(?string $toContent): self
    {
        $this->toContent = $toContent;

        return $this;
    }

    public function getToEffect(): ?string
    {
        return $this->toEffect;
    }

    public function setToEffect(?string $toEffect): self
    {
        $this->toEffect = $toEffect;

        return $this;
    }

    public function getToByproduct(): ?string
    {
        return $this->toByproduct;
    }

    public function setToByproduct(?string $toByproduct): self
    {
        $this->toByproduct = $toByproduct;

        return $this;
    }

    public function getToExposure(): ?string
    {
        return $this->toExposure;
    }

    public function setToExposure(?string $toExposure): self
    {
        $this->toExposure = $toExposure;

        return $this;
    }

    public function getToCost(): ?string
    {
        return $this->toCost;
    }

    public function setToCost(?string $toCost): self
    {
        $this->toCost = $toCost;

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
