<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnProblemManagement
 *
 * @ORM\Table(name="jsn_problem_management", uniqueConstraints={@ORM\UniqueConstraint(name="problem_id", columns={"problem_id"})}, indexes={@ORM\Index(name="problem_id_idx", columns={"problem_id"})})
 * @ORM\Entity
 */
class JsnProblemManagement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var \JsnProblem
     *
     * @ORM\ManyToOne(targetEntity="JsnProblem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="problem_id", referencedColumnName="id")
     * })
     */
    private $problem;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getProblem(): ?JsnProblem
    {
        return $this->problem;
    }

    public function setProblem(?JsnProblem $problem): self
    {
        $this->problem = $problem;

        return $this;
    }


}
