<?php

namespace App\Controller;

use App\Entity\JsnTechnology;
use App\Entity\JsnTechnologyManagement;
use App\Repository\JsnTechnologyRepository;
use App\Service\TechnologyPhase;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class TechnologyController extends AbstractController
{
    public function __construct(TechnologyPhase $technologyPhase, JsnTechnologyRepository $jsnTechnologyRepository)
    {
        $this->technologyPhase = $technologyPhase;
        $this->jsnTechnologyRepository = $jsnTechnologyRepository;
    }

    #[Route('/member/tech/{id}', name: 'app_technology')]
    public function index(Request $request): Response
    {

        $referenceId = $request->attributes->get('id');
        $id = $this->referenceIdToId($referenceId);
        dump($id);
        $technology = $this->jsnTechnologyRepository->findTechnology($id);
        $technologyDetail = $this->jsnTechnologyRepository->findTechnologyDetail($id);
        $technologyVerificationTest = $this->jsnTechnologyRepository->findTechnologyVerificationTest($id);

        dump($technology);
        dump($technologyVerificationTest);
        
        return $this->render('technology/index.html.twig', [
            'controller_name' => 'TechnologyController',
            'referenceId' => $referenceId,
            'technology'=> $technology,
            'technologyDetail'=> $technologyDetail,
            'technologyVerificationTest'=> $technologyVerificationTest,
        ]);
    }

    #[Route('/member/tech/search', name: 'app_technology_search')]
    public function search(): Response
    {
        return $this->render('technology/index.html.twig', [
            'controller_name' => 'TechnologyController',
        ]);
    }

    #[Route('/member/tech/list/{page}', name: 'app_technology_list')]
    public function list(ManagerRegistry $doctrine, Request $request, int $page = 1): Response
    {
        $params = $request->query->all();
        dump($params);
        
        // $sort = $this->addSortColumnQuery($technology);
        $session = $request->getSession();
        $session->set('technology.search_query', $page);
        $session->set('technology.list_page', $page);

        $entityManager = $doctrine->getManager();
        $technology = $this->jsnTechnologyRepository->findActiveTechnology($page);
        $count = count($technology);

        $updating = $this->isUpdating($technology);
        $phaseText = $this->getPhaseText($technology);
        $restrictionText = $this->restrictionText($technology);
        $verificationTestText = $this->verificationTestText($technology);
        $achievementText = $this->achievementText($technology);
        $expertEvaluationText = $this->expertEvaluationText($technology);
        $summary = $this->getSummary($technology);
        $technologyManagement = $entityManager->getRepository(JsnTechnologyManagement::class)->findAll();
        $referenceId = $this->getReferenceId($technologyManagement);
        $pager = $this->getPager($page, $count);

        return $this->render('technology/list.html.twig', [
            'controller_name' => 'TechnologyController',
            'technology' => $technology,
            'restrictionText' => $restrictionText,
            'verificationTestText' => $verificationTestText,
            'achievementText' => $achievementText,
            'expertEvaluationText' => $expertEvaluationText,
            'technologyManagement' => $technologyManagement,
            'summary' => $summary,
            'referenceId' => $referenceId,
            'updating' => $updating,
            'phaseText' => $phaseText,
            'pager' => $pager,
        ]);
    }

    #[Route('/member/tech/about/', name: 'app_technology_about')]
    public function about(): Response
    {
        $lang = "jp";

        return $this->render('technology/about.html.twig', [
            'controller_name' => 'ContactController',
            'lang' => $lang,
        ]);
    }

    #[Route('/member/tech/about/en', name: 'app_technology_about_en')]
    public function aboutEn(): Response
    {
        $lang = "en";

        return $this->render('technology/about.html.twig', [
            'controller_name' => 'ContactController',
            'lang' => $lang,
        ]);
    }

    #[Route('/member/technology/post', name: 'app_technology_post')]
    public function post(): Response
    {
        return $this->render('technology/index.html.twig', [
            'controller_name' => 'TechnologyController',
        ]);
    }

  private
    /**
     * priority： nullはソートに含めない。0はフォームで選択された項目に設定。
     */
    $sort = array(
      'updated_at,desc'               => array('label' => '最終更新日が新しい順', 'priority' => 1),
      'reference_id,asc'              => array('label' => '整理番号が小さい順', 'priority' => 7),
      'reference_id,desc'             => array('label' => '整理番号が大きい順', 'priority' => null),
      'applicant_organ_name_kana,asc' => array('label' => '申請機関名の五十音順', 'priority' => 8),
      'phase,desc'                    => array('label' => '研究・実用化段階の順', 'priority' => 3),
      'exist_restriction,asc'         => array('label' => '適用の制約条件のないものを優先', 'priority' => 6),
      'exist_verification_test,desc'  => array('label' => '実証試験のあるものを優先', 'priority' => 2),
      'exist_achievement,desc'        => array('label' => '適用実績のあるものを優先', 'priority' => 4),
      'exist_expert_evaluation,desc'  => array('label' => '専門家評価のあるものを優先', 'priority' => 5),
    ),
    $isSearchEnglish = false;

    /**
    * 整理IDを取得
    *
    * @return string
    */
    public function getReferenceId($technologyManagement)
    {
        $referenceId = [];

        foreach ($technologyManagement as $value) {
            $technology = $value->getTechnology();
            $referenceId = array_merge($referenceId, [$technology->getid() => (null != $value->getId()) ? self::idToReferenceId($value->getId()) : null]);
        }
        return $referenceId;
    }
 
    /**
    * IDを整理IDへ変換
    *
    * @param int $id
    * @return string
    */
    public static function idToReferenceId($id)
    {
        return sprintf('T-%05d', $id);
    }

    /**
     * 整理IDをIDへ変換
     *
     * @param string $referenceId
     * @return int | false 整理IDのパターンにマッチしない場合はfalse
     */
    public static function referenceIdToId($referenceId)
    {
      $result = preg_match('/T-(\d{5})/', $referenceId, $match);
  
      if (0 === $result || false === $result) {
        return false;
      }
  
      return intval($match[1]);
    }
  
    /**
    * 更新中判別
    *
    * @return boolean
    */
    public function isUpdating($technology)
    {
        $updating = [];

        foreach ($technology as $value) {
            $updating = array_merge($updating, [$value->getid() => in_array($value->getStatus(), [JsnTechnologyRepository::STATUS_UPDATING, JsnTechnologyRepository::STATUS_UPDATE_PENDING])]);
        }
        return $updating;
    }

    /**
    * 研究・実用化段階を取得
    *
    * @return string
    */
    public function getPhaseText($technology)
    {
        $option = $this->technologyPhase->getOption();
        $phaseText = [];

        foreach ($technology as $value) {
            $nameKey = $value->getIsEnglish() ? 'name_en' : 'name';
            $phase = $value->getPhase();
            $phaseText = array_merge($phaseText, [$value->getid() => $option[$phase][$nameKey]]);
        }
        return $phaseText;
    }

    /**
    * 制約条件の有無を取得
    *
    * @return string
    */
    public function restrictionText($technology)
    {
        $restrictionText = [];

        foreach ($technology as $value) {
            $isEnglish = $value->getIsEnglish();
            $exist = $isEnglish ? 'Exist' : 'あり';
            $noExist = $isEnglish ? 'Not-exist' : 'なし';
            $restrictionText = array_merge($restrictionText, [$value->getid() => $value->getExistRestriction() ? $exist : $noExist]);
        }

        return $restrictionText;
    }

    /**
    * 実証の有無を取得
    *
    * @return string
    */
    public function verificationTestText($technology)
    {
        $verificationTestText = [];

        foreach ($technology as $value) {
            $isEnglish = $value->getIsEnglish();
            $exist = $isEnglish ? 'Exist' : 'あり';
            $noExist = $isEnglish ? 'Not-exist' : 'なし';
            $verificationTestText = array_merge($verificationTestText, [$value->getid() => $value->getExistVerificationTest() ? $exist : $noExist]);
        }

        return $verificationTestText;
    }

    /**
    * 実績の有無を取得
    *
    * @return string
    */
    public function achievementText($technology)
    {
        $achievementText = [];

        foreach ($technology as $value) {
            $isEnglish = $value->getIsEnglish();
            $exist = $isEnglish ? 'Exist' : 'あり';
            $noExist = $isEnglish ? 'Not-exist' : 'なし';
            $achievementText = array_merge($achievementText, [$value->getid() => $value->getExistAchievement() ? $exist : $noExist]);
        }

        return $achievementText;
    }

    /**
    * 専門家評価の有無を取得
    *
    * @return string
    */
    public function expertEvaluationText($technology)
    {
        $expertEvaluationText = [];

        foreach ($technology as $value) {
            $isEnglish = $value->getIsEnglish();
            $exist = $isEnglish ? 'Exist' : 'あり';
            $noExist = $isEnglish ? 'Not-exist' : 'なし';
            $expertEvaluationText = array_merge($expertEvaluationText, [$value->getid() => $value->getExistExpertEvaluation() ? $exist : $noExist]);
        }

        return $expertEvaluationText;
    }

    public function getSummary($technology)
    {
        $summary = [];

        foreach ($technology as $value) {
            $summary = array_merge($summary, [$value->getid() => u(strip_tags($value->getSummary()))->truncate(98, '…')]);
        }

        return $summary;
    }

    public function getPager($page, $count)
    {
        $pager = [];
        $pager['currentPage'] = $page;
        $pager['totalPage'] = (int)ceil($count / JsnTechnologyRepository::MAX_RESULT);
        $pager['previousPage'] = $page - 1;
        $pager['nextPage'] = $page + 1;
        if($page == 1) {
            $pager['isFirstPage'] = true;
        } else {
            $pager['isFirstPage'] = false;
        }
        if($page == $pager['totalPage']) {
            $pager['isLastPage'] = true;
        } else {
            $pager['isLastPage'] = false;
        }
        $pager['firstIndice'] = JsnTechnologyRepository::MAX_RESULT * ($page - 1) + 1;
        if($pager['isLastPage']) {
            $pager['lastIndice'] = $count;
        } else {
            $pager['lastIndice'] = $pager['firstIndice'] + JsnTechnologyRepository::MAX_RESULT - 1;
        }

        $showNum = 5;
        $showNumHalf = floor($showNum / 2);
        $loopStart = $pager['currentPage'] - $showNumHalf;
        $loopEnd = $pager['currentPage'] + $showNumHalf;
        if ($loopStart <= 0) {
            $loopStart = 1;
            $loopEnd = $showNum;
        }
        if ($loopEnd > $pager['totalPage']) {
            $loopStart  = $pager['totalPage'] - $showNum + 1;
            $loopEnd =  $pager['totalPage'];
        }
        $pager['loopBetween'] = [];
        for ($i = $loopStart; $i <= $loopEnd; $i++) {
            $pager['loopBetween'][] = $i;
        }

        return $pager;
    }

  public function configure()
  {
  }

  /**
   * ソートのクエリ追加
   */
  protected function addSortColumnQuery()
  {
    // $priority = $this->getSortPriority();
    // $priority[$values] = 0; // フォームで選択した項目を最優先
    // asort($priority);

//     foreach (array_keys($priority) as $key) {
//       list($column, $order) = explode(',', $key);
// 
//       $order = ('desc' === $order) ? 'DESC' : 'ASC';
// 
//       if ('reference_id' === $column) {
//         $query->addOrderBy('tm.id '.$order);
// 
//       } else {
//         $query->addOrderBy(sprintf('%s.%s %s', $query->getRootAlias(), $column, $order));
// 
//       }
//     }

  }

  /**
   * ソートの選択項目を取得
   *
   * @return array
   */
  private function getSortChoices()
  {
    $choices = array();

    foreach ($this->sort as $key => $column) {
      $choices[$key] = $column['label'];
    }

    return $choices;
  }
 
  /**
   * ソートの優先度を取得
   *
   * @return array
   */
  private function getSortPriority()
  {
    $priority = array();

    foreach ($this->sort as $key => $column) {
      if (null !== $column['priority']) {
        $priority[$key] = $column['priority'];
      }
    }

    return $priority;
  }
}
