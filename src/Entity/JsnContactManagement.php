<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnContactManagement
 *
 * @ORM\Table(name="jsn_contact_management")
 * @ORM\Entity
 */
class JsnContactManagement
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
     * @ORM\Column(name="name", type="text", length=65535, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="last_number", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $lastNumber = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="number_prefix", type="string", length=2, nullable=false, options={"fixed"=true})
     */
    private $numberPrefix;

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

    public function getLastNumber(): ?int
    {
        return $this->lastNumber;
    }

    public function setLastNumber(int $lastNumber): self
    {
        $this->lastNumber = $lastNumber;

        return $this;
    }

    public function getNumberPrefix(): ?string
    {
        return $this->numberPrefix;
    }

    public function setNumberPrefix(string $numberPrefix): self
    {
        $this->numberPrefix = $numberPrefix;

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


}
