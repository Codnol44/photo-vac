<?php

namespace App\Repository;

use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Photo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Photo[]    findAll()
 */
class PhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photo::class);
    }

    /**
     * @param int $page
     * @param int $nbElementsByPage
     * @return Photo[]
     */
    public function getPhotosByDQL(int $page = 1, int $nbElementsByPage = 10): array {

        $query = $this->getEntityManager()->createQuery(
            'SELECT photo FROM App\Entity\Photo photo'
        );

        // Pagination
        $query->setFirstResult((($page < 1 ? 1 : $page) -1)  * $nbElementsByPage);
        $query->setMaxResults($nbElementsByPage);

        return $query->getResult();
    }

}