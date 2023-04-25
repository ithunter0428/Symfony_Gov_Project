<?php

namespace App\Entity;

use App\Repository\JsnMemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * JsnMember
 *
 * @ORM\Table(name="jsn_member", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class JsnMember
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\OneToOne(targetEntity="JsnMemberMeta", mappedBy="jsn_member", cascade={"persist","remove"})
     */
    private $meta;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false, options={"fixed"=true})
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="password_salt", type="string", length=20, nullable=false, options={"fixed"=true})
     */
    private $passwordSalt;

    /**
     * @var int
     *
     * @ORM\Column(name="secret_question", type="integer", nullable=false)
     */
    private $secretQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="secret_answer", type="string", length=128, nullable=false, options={"fixed"=true})
     */
    private $secretAnswer;

    /**
     * @var string
     *
     * @ORM\Column(name="secret_answer_salt", type="string", length=20, nullable=false, options={"fixed"=true})
     */
    private $secretAnswerSalt;

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
     * Constructor
     */
    public function __construct()
    {
        $this->meta = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->city.' '.$this->year;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password, $hash = true): self
    {
        if ($hash) {
          // ハッシュする時はsaltを新たに生成
          $salt = $this->createSalt();
          $this->setPasswordSalt($salt);
    
          $password = $this->hash($password, $salt);
        }
    
        $this->password = $password;

        return $this;
    }

    public function getPasswordSalt(): ?string
    {
        return $this->passwordSalt;
    }

    public function setPasswordSalt(string $passwordSalt): self
    {
        $this->passwordSalt = $passwordSalt;

        return $this;
    }

    public function getSecretQuestion(): ?int
    {
        return $this->secretQuestion;
    }

    public function setSecretQuestion(bool $secretQuestion): self
    {
        $this->secretQuestion = $secretQuestion;

        return $this;
    }

    public function getSecretAnswer(): ?string
    {
        return $this->secretAnswer;
    }

    public function setSecretAnswer(string $secretAnswer, $hash = true): self
    {
        if ($hash) {
          // ハッシュする時はsaltを新たに生成
          $salt = $this->createSalt();
          $this->setSecretAnswerSalt($salt);

          $secretAnswer = $this->hash($secretAnswer, $salt);
        }

        $this->secretAnswer = $secretAnswer;

        return $this;
    }

    public function getSecretAnswerSalt(): ?string
    {
        return $this->secretAnswerSalt;
    }

    public function setSecretAnswerSalt(string $secretAnswerSalt): self
    {
        $this->secretAnswerSalt = $secretAnswerSalt;

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

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
    * 秘密の答えをチェック
    *
    * @param string $value
    * @return boolean
    */
    public function checkSecretAnswer($value)
    {
        return $this->getSecretAnswer() === $this->hash($value, $this->getSecretAnswerSalt());
    }

    /**
    * ハッシュ
    *
    * @param string $value
    * @param string $salt
    * @return string
    */
    public function hash($value, $salt)
    {
        return hash_hmac('sha512', $value, $salt);
    }

  /**
   * ソルトを生成
   *
   * @param int $length
   * @return string
   */
  public function createSalt($length = 20)
  {
    // 20文字のランダム文字列を生成
    $charList = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $salt = '';

    for ($i = 0; $i < $length; $i++) {
      $n = mt_rand(0, strlen($charList) - 1);
      $salt .= $charList[$n];
    }

    return $salt;
  }
}
