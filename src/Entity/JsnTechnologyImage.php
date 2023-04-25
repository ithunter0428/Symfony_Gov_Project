<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnologyImage
 *
 * @ORM\Table(name="jsn_technology_image", indexes={@ORM\Index(name="technology_id_idx", columns={"technology_id"})})
 * @ORM\Entity
 */
class JsnTechnologyImage
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=40, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id = '';

    /**
     * @var int
     *
     * @ORM\Column(name="technology_id", type="bigint", nullable=false)
     */
    private $technologyId;

    /**
     * @var int
     *
     * @ORM\Column(name="attach_item", type="integer", nullable=false)
     */
    private $attachItem;

    /**
     * @var bool
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=70, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="extension", type="string", length=10, nullable=true)
     */
    private $extension;

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
     * @ORM\ManyToOne(targetEntity="JsnTechnology")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     * })
     */
    private $technology;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTechnologyId(): ?int
    {
        return $this->technologyId;
    }

    public function getAttachItem(): ?int
    {
        return $this->attachItem;
    }

    public function setAttachItem(int $attachItem): self
    {
        $this->attachItem = $attachItem;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

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
