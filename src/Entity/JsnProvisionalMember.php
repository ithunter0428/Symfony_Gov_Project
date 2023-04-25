<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnProvisionalMember
 *
 * @ORM\Table(name="jsn_provisional_member", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class JsnProvisionalMember
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=32, nullable=false, options={"fixed"=true})
     * @ORM\Id
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
     * @ORM\Column(name="time_limit", type="datetime", nullable=false)
     */
    private $timeLimit;

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

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getAffiliationCategory(): ?int
    {
        return $this->affiliationCategory;
    }

    public function setAffiliationCategory(int $affiliationCategory): self
    {
        $this->affiliationCategory = (int) $affiliationCategory;

        return $this;
    }

    public function getBusinessCategory(): ?int
    {
        return $this->businessCategory;
    }

    public function setBusinessCategory(int $businessCategory): self
    {
        $this->businessCategory = (int) $businessCategory;

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

    public function setSecretQuestion(?int $secretQuestion): self
    {
        $this->secretQuestion = (int) $secretQuestion;

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

    public function getQuestionnaireAnswer(): string
    {
        return $this->questionnaireAnswer;
    }

    public function setQuestionnaireAnswer(string $questionnaireAnswer): self
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

    public function getTimeLimit(): ?\DateTimeInterface
    {
        return $this->timeLimit;
    }

    public function setTimeLimit(\DateTimeInterface $timeLimit): self
    {

        $date = date('Y-m-d H:i:s', strtotime(sprintf('+%s hour', 2)));
        $date = date_create($date);

        $this->timeLimit = $date;

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
    public function setIdValue()
    {
        $this->id = $this->createId();
    }

    /**
     * @ORM\PrePersist
     */
    public function setTimeLimitValue()
    {
        $date = date('Y-m-d H:i:s', strtotime(sprintf('+%s hour', 2)));
        $date = date_create($date);
        $this->timeLimit = $date;
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
   * IDを生成
   *
   * @return string
   */
  private function createId()
  {
    return md5(uniqid(mt_rand(10, 99), true));
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
