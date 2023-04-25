<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * JsnTechnology
 *
 * @ORM\Table(name="jsn_technology", uniqueConstraints={@ORM\UniqueConstraint(name="receipt_id", columns={"receipt_id"})}, indexes={@ORM\Index(name="jsn_technology_english_version_id_jsn_technology_id", columns={"english_version_id"})})
 * @ORM\Entity
 */
class JsnTechnology
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=32, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_english", type="integer", nullable=false)
     */
    private $isEnglish;

    /**
     * @var int
     *
     * @ORM\Column(name="receipt_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $receiptId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="applicant_user_email", type="string", length=128, nullable=true)
     */
    private $applicantUserEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="applicant_organ_name", type="string", length=150, nullable=true)
     */
    private $applicantOrganName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="applicant_organ_name_kana", type="string", length=128, nullable=true)
     */
    private $applicantOrganNameKana;

    /**
     * @var string|null
     *
     * @ORM\Column(name="applicant_organ_web_url", type="text", length=65535, nullable=true)
     */
    private $applicantOrganWebUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="summary", type="text", length=65535, nullable=true)
     */
    private $summary;

    /**
     * @var bool
     *
     * @ORM\Column(name="exist_restriction", type="integer", nullable=false)
     */
    private $existRestriction;

    /**
     * @var int
     *
     * @ORM\Column(name="phase", type="integer", nullable=false)
     */
    private $phase;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reference_web_url", type="text", length=65535, nullable=true)
     */
    private $referenceWebUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reference_web_name", type="string", length=150, nullable=true)
     */
    private $referenceWebName;

    /**
     * @var bool
     *
     * @ORM\Column(name="exist_verification_test", type="integer", nullable=false)
     */
    private $existVerificationTest;

    /**
     * @var bool
     *
     * @ORM\Column(name="exist_achievement", type="integer", nullable=false)
     */
    private $existAchievement;

    /**
     * @var bool
     *
     * @ORM\Column(name="exist_expert_evaluation", type="integer", nullable=false)
     */
    private $existExpertEvaluation;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="wish_expert_evaluation", type="boolean", nullable=true)
     */
    private $wishExpertEvaluation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_affiliation", type="string", length=150, nullable=true)
     */
    private $contactAffiliation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_post", type="text", length=65535, nullable=true)
     */
    private $contactPost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_tel", type="string", length=16, nullable=true)
     */
    private $contactTel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_zip_code", type="string", length=16, nullable=true)
     */
    private $contactZipCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact_address", type="text", length=65535, nullable=true)
     */
    private $contactAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="keyword", type="string", length=204, nullable=true)
     */
    private $keyword;

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
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="content_updated_at", type="datetime", nullable=false)
     */
    private $contentUpdatedAt;

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
     *   @ORM\JoinColumn(name="english_version_id", referencedColumnName="id")
     * })
     */
    private $englishVersion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnMeansSubClass", inversedBy="technology")
     * @ORM\JoinTable(name="jsn_technology_means",
     *   joinColumns={
     *     @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="means_sub_class_id", referencedColumnName="id")
     *   }
     * )
     */
    private $meansSubClass = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnObjectSubClass", inversedBy="technology")
     * @ORM\JoinTable(name="jsn_technology_object",
     *   joinColumns={
     *     @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="object_sub_class_id", referencedColumnName="id")
     *   }
     * )
     */
    private $objectSubClass = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="JsnSceneSubClass", inversedBy="technology")
     * @ORM\JoinTable(name="jsn_technology_scene",
     *   joinColumns={
     *     @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="scene_sub_class_id", referencedColumnName="id")
     *   }
     * )
     */
    private $sceneSubClass = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meansSubClass = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objectSubClass = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sceneSubClass = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIsEnglish(): ?int
    {
        return $this->isEnglish;
    }

    public function setIsEnglish(bool $isEnglish): self
    {
        $this->isEnglish = $isEnglish;

        return $this;
    }

    public function getReceiptId(): ?int
    {
        return $this->receiptId;
    }

    public function setReceiptId(int $receiptId): self
    {
        $this->receiptId = $receiptId;

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

    public function getApplicantUserEmail(): ?string
    {
        return $this->applicantUserEmail;
    }

    public function setApplicantUserEmail(?string $applicantUserEmail): self
    {
        $this->applicantUserEmail = $applicantUserEmail;

        return $this;
    }

    public function getApplicantOrganName(): ?string
    {
        return $this->applicantOrganName;
    }

    public function setApplicantOrganName(?string $applicantOrganName): self
    {
        $this->applicantOrganName = $applicantOrganName;

        return $this;
    }

    public function getApplicantOrganNameKana(): ?string
    {
        return $this->applicantOrganNameKana;
    }

    public function setApplicantOrganNameKana(?string $applicantOrganNameKana): self
    {
        $this->applicantOrganNameKana = $applicantOrganNameKana;

        return $this;
    }

    public function getApplicantOrganWebUrl(): ?string
    {
        return $this->applicantOrganWebUrl;
    }

    public function setApplicantOrganWebUrl(?string $applicantOrganWebUrl): self
    {
        $this->applicantOrganWebUrl = $applicantOrganWebUrl;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getExistRestriction(): ?int
    {
        return $this->existRestriction;
    }

    public function setExistRestriction(bool $existRestriction): self
    {
        $this->existRestriction = $existRestriction;

        return $this;
    }

    public function getPhase(): ?int
    {
        return $this->phase;
    }

    public function setPhase(bool $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function getReferenceWebUrl(): ?string
    {
        return $this->referenceWebUrl;
    }

    public function setReferenceWebUrl(?string $referenceWebUrl): self
    {
        $this->referenceWebUrl = $referenceWebUrl;

        return $this;
    }

    public function getReferenceWebName(): ?string
    {
        return $this->referenceWebName;
    }

    public function setReferenceWebName(?string $referenceWebName): self
    {
        $this->referenceWebName = $referenceWebName;

        return $this;
    }

    public function getExistVerificationTest(): ?int
    {
        return $this->existVerificationTest;
    }

    public function setExistVerificationTest(bool $existVerificationTest): self
    {
        $this->existVerificationTest = $existVerificationTest;

        return $this;
    }

    public function getExistAchievement(): ?int
    {
        return $this->existAchievement;
    }

    public function setExistAchievement(bool $existAchievement): self
    {
        $this->existAchievement = $existAchievement;

        return $this;
    }

    public function getExistExpertEvaluation(): ?int
    {
        return $this->existExpertEvaluation;
    }

    public function setExistExpertEvaluation(bool $existExpertEvaluation): self
    {
        $this->existExpertEvaluation = $existExpertEvaluation;

        return $this;
    }

    public function isWishExpertEvaluation(): ?bool
    {
        return $this->wishExpertEvaluation;
    }

    public function setWishExpertEvaluation(?bool $wishExpertEvaluation): self
    {
        $this->wishExpertEvaluation = $wishExpertEvaluation;

        return $this;
    }

    public function getContactAffiliation(): ?string
    {
        return $this->contactAffiliation;
    }

    public function setContactAffiliation(?string $contactAffiliation): self
    {
        $this->contactAffiliation = $contactAffiliation;

        return $this;
    }

    public function getContactPost(): ?string
    {
        return $this->contactPost;
    }

    public function setContactPost(?string $contactPost): self
    {
        $this->contactPost = $contactPost;

        return $this;
    }

    public function getContactTel(): ?string
    {
        return $this->contactTel;
    }

    public function setContactTel(?string $contactTel): self
    {
        $this->contactTel = $contactTel;

        return $this;
    }

    public function getContactZipCode(): ?string
    {
        return $this->contactZipCode;
    }

    public function setContactZipCode(?string $contactZipCode): self
    {
        $this->contactZipCode = $contactZipCode;

        return $this;
    }

    public function getContactAddress(): ?string
    {
        return $this->contactAddress;
    }

    public function setContactAddress(?string $contactAddress): self
    {
        $this->contactAddress = $contactAddress;

        return $this;
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyword(?string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getContentUpdatedAt(): ?\DateTimeInterface
    {
        return $this->contentUpdatedAt;
    }

    public function setContentUpdatedAt(\DateTimeInterface $contentUpdatedAt): self
    {
        $this->contentUpdatedAt = $contentUpdatedAt;

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

    public function getEnglishVersion(): ?self
    {
        return $this->englishVersion;
    }

    public function setEnglishVersion(?self $englishVersion): self
    {
        $this->englishVersion = $englishVersion;

        return $this;
    }

    /**
     * @return Collection<int, JsnMeansSubClass>
     */
    public function getMeansSubClass(): Collection
    {
        return $this->meansSubClass;
    }

    public function addMeansSubClass(JsnMeansSubClass $meansSubClass): self
    {
        if (!$this->meansSubClass->contains($meansSubClass)) {
            $this->meansSubClass->add($meansSubClass);
        }

        return $this;
    }

    public function removeMeansSubClass(JsnMeansSubClass $meansSubClass): self
    {
        $this->meansSubClass->removeElement($meansSubClass);

        return $this;
    }

    /**
     * @return Collection<int, JsnObjectSubClass>
     */
    public function getObjectSubClass(): Collection
    {
        return $this->objectSubClass;
    }

    public function addObjectSubClass(JsnObjectSubClass $objectSubClass): self
    {
        if (!$this->objectSubClass->contains($objectSubClass)) {
            $this->objectSubClass->add($objectSubClass);
        }

        return $this;
    }

    public function removeObjectSubClass(JsnObjectSubClass $objectSubClass): self
    {
        $this->objectSubClass->removeElement($objectSubClass);

        return $this;
    }

    /**
     * @return Collection<int, JsnSceneSubClass>
     */
    public function getSceneSubClass(): Collection
    {
        return $this->sceneSubClass;
    }

    public function addSceneSubClass(JsnSceneSubClass $sceneSubClass): self
    {
        if (!$this->sceneSubClass->contains($sceneSubClass)) {
            $this->sceneSubClass->add($sceneSubClass);
        }

        return $this;
    }

    public function removeSceneSubClass(JsnSceneSubClass $sceneSubClass): self
    {
        $this->sceneSubClass->removeElement($sceneSubClass);

        return $this;
    }

}
