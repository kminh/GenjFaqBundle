<?php

namespace Genj\FaqBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use Gedmo\Translatable\Query\TreeWalker\TranslationWalker;

/**
 * Class CategoryRepository
 *
 * @package Genj\FaqBundle\Entity
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function retrieveActive()
    {
        $query = $this->createQueryBuilder('c')
            ->addSelect('q')
            ->innerJoin('c.questions', 'q')
            ->where('c.isActive = :isActive')
            ->orderBy('c.rank', 'ASC')
            ->getQuery();

        $query->setParameter('isActive', true);
        /* $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, TranslationWalker::class); */

        return $query->execute();
    }

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function retrieveActiveBySlug($slug)
    {
        $query = $this->createQueryBuilder('c')
            ->innerJoin('c.questions', 'q')
            ->where('c.isActive = :isActive')
            ->andWhere('c.slug = :slug')
            ->orderBy('c.rank', 'ASC')
            ->getQuery();

        $query->setParameter('isActive', true);
        $query->setParameter('slug', $slug);
        /* $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, TranslationWalker::class); */

        return $query->execute();
    }

    /**
     * @return Category|null
     */
    public function retrieveFirst()
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.isActive = :isActive')
            ->orderBy('c.rank', 'ASC')
            ->setMaxResults(1)
            ->getQuery();

        $query->setParameter('isActive', true);
        /* $query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, TranslationWalker::class); */

        return $query->getOneOrNullResult();
    }
}
