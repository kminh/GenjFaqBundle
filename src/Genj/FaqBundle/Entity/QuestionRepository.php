<?php

namespace Genj\FaqBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use Gedmo\Translatable\Query\TreeWalker\TranslationWalker;

/**
 * Class QuestionRepository
 *
 * @package Genj\FaqBundle\Entity
 */
class QuestionRepository extends EntityRepository
{
    /**
     * @param string $categorySlug
     *
     * @return Question|null
     */
    public function retrieveFirstByCategorySlug($categorySlug)
    {
        $qb = $this->getQueryBuilder()
            ->where('c.slug = :categorySlug')
            ->setMaxResults(1)
        ;

        $qb->setParameter('categorySlug', $categorySlug);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    public function retrieveActiveByCategorySlug($categorySlug)
    {
        $qb = $this->getQueryBuilder()
            ->where('c.slug = :categorySlug')
            ->andWhere('c.isActive = :isActive')
        ;

        $qb->setParameter('categorySlug', $categorySlug);
        $qb->setParameter('isActive', true);

        $query = $qb->getQuery();
        /* $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, TranslationWalker::class); */

        return $query->getResult();
    }

    public function retrieveActive()
    {
        $qb = $this->getQueryBuilder()
            ->andWhere('c.isActive = :isActive')
        ;

        $qb->setParameter('isActive', true);

        $query = $qb->getQuery();
        /* $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, TranslationWalker::class); */

        return $query->getResult();
    }

    protected function getQueryBuilder()
    {
        $qb = $this->createQueryBuilder('q')
            ->addSelect('c')
            ->join('q.category', 'c')
            ->orderBy('c.rank', 'ASC')
            ->addOrderBy('q.rank', 'ASC')
        ;

        return $qb;
    }
}
