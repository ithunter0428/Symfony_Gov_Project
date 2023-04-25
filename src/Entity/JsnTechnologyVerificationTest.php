<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnologyVerificationTest
 *
 * @ORM\Table(name="jsn_technology_verification_test")
 * @ORM\Entity
 */
class JsnTechnologyVerificationTest
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
     * @ORM\Column(name="duration", type="text", length=65535, nullable=true)
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="location", type="text", length=65535, nullable=true)
     */
    private $location;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="effect", type="text", length=65535, nullable=true)
     */
    private $effect;

    /**
     * @var string|null
     *
     * @ORM\Column(name="byproduct", type="text", length=65535, nullable=true)
     */
    private $byproduct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="exposure", type="text", length=65535, nullable=true)
     */
    private $exposure;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cost", type="text", length=65535, nullable=true)
     */
    private $cost;

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

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(?string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    public function getByproduct(): ?string
    {
        return $this->byproduct;
    }

    public function setByproduct(?string $byproduct): self
    {
        $this->byproduct = $byproduct;

        return $this;
    }

    public function getExposure(): ?string
    {
        return $this->exposure;
    }

    public function setExposure(?string $exposure): self
    {
        $this->exposure = $exposure;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(?string $cost): self
    {
        $this->cost = $cost;

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
