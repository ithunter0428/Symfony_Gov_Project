<?php
namespace App\Repository;

use App\Entity\JsnTechnology;
use App\Entity\JsnTechnologyDetail;
use App\Entity\JsnTechnologyDocument;
use App\Entity\JsnTechnologyImage;
use App\Entity\JsnTechnologyManagement;
use App\Entity\JsnTechnologyVerificationTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

class JsnTechnologyRepository extends ServiceEntityRepository
{
    const
    KEYWORD_DELIMITER = ',',
    STATUS_PENDING        = '0', // 申請中
    STATUS_APPROVAL       = '1', // 承認（公開）
    STATUS_DENIAL         = '2', // 否認（非公開）
    STATUS_UPDATING       = '3', // 更新中
    STATUS_UPDATE_PENDING = '4', // 更新申請中
    MAX_RESULT = 20;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JsnTechnology::class);
    }

    /**
     * @return Technology[]
     */
    public function findActiveTechnology($page, $alias = null): Paginator
    {
        if (is_null($alias)) {
            // $alias = $query->getRootAlias();
        }

        $status = [self::STATUS_APPROVAL, self::STATUS_UPDATING, self::STATUS_UPDATE_PENDING];

        $qb = $this->createQueryBuilder('t');
        $qb
            ->innerJoin(JsnTechnologyManagement::class, 'tm')
            ->andWhere($qb->expr()->in('t.status', $status))
            ->orderBy("t.updatedAt", "DESC")
            ->setFirstResult(self::MAX_RESULT * ($page - 1))
            ->setMaxResults(self::MAX_RESULT);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);

        return $paginator;
    }

    /**
     * @return Technology[]
     */
    public function findTechnology($id)
    {
        $status = [self::STATUS_APPROVAL, self::STATUS_UPDATING, self::STATUS_UPDATE_PENDING];
        $qb = $this->createQueryBuilder('t');
        $qb
            ->select('t,tm')
            ->innerJoin(JsnTechnologyManagement::class, 'tm')
            ->andWhere($qb->expr()->in('t.status', $status))
            ->andWhere('tm.id = :id')
            ->setParameter('id', $id);
            // ->leftJoin(JsnTechnologyImage::class, 'img', 'WITH', 't.id = img.technologyId')
            // ->leftJoin(JsnTechnologyDocument::class, 'doc', 'WITH', 't.id = doc.technologyId');

        $query = $qb->getQuery();
        dump($query);
        $technology = $query->getResult();

        return $technology;
    }

    /**
     * @return Technology[]
     */
    public function findTechnologyDetail($id)
    {
        $status = [self::STATUS_APPROVAL, self::STATUS_UPDATING, self::STATUS_UPDATE_PENDING];
        $qb = $this->createQueryBuilder('t');
        $qb
            ->select('td')
            ->andWhere($qb->expr()->in('t.status', $status))
            ->andWhere('t.receiptId = :receiptId')
            ->setParameter('receiptId', $id)
            ->innerJoin(JsnTechnologyDetail::class, 'td')
            ->andWhere('td.technologyId = t.id');

        $query = $qb->getQuery();
 
        $technologyDetail = $query->getResult();

        return $technologyDetail;
    }

    /**
     * @return Technology[]
     */
    public function findTechnologyVerificationTest($id)
    {
        $status = [self::STATUS_APPROVAL, self::STATUS_UPDATING, self::STATUS_UPDATE_PENDING];
        $qb = $this->createQueryBuilder('t');
        $qb
            ->select('tvt')
            ->andWhere($qb->expr()->in('t.status', $status))
            ->andWhere('t.receiptId = :receiptId')
            ->setParameter('receiptId', $id)
            ->innerJoin(JsnTechnologyVerificationTest::class, 'tvt')
            ->andWhere('tvt.technologyId = t.id');

        $query = $qb->getQuery();
 
        $technologyVerificationTest = $query->getResult();

        return $technologyVerificationTest;
    }
}