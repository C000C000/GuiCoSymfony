<?php

namespace App\Repository;

use App\Entity\ListeFilms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeFilms|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeFilms|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeFilms[]    findAll()
 * @method ListeFilms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeFilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeFilms::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ListeFilms $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ListeFilms $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getFilms($idUser): array{
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\ListeFilms p
            WHERE p.IdUser = :user_id'
        )->setParameter('user_id', $idUser);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function delFilm(int $idUser, int $filmID){
        $entityManager = $this->getEntityManager();

//        $query = $entityManager->createQuery(
//            'DELETE p
//            FROM App\Entity\ListeFilms p
//            WHERE p.IdUser = :user_id AND p.IdFilm = :film_id'
//        )
//            ->setParameter('user_id', $idUser)
//            ->setParameter('film_id',$filmID);
        return $entityManager->createQueryBuilder()
            ->delete(ListeFilms::class,'s')
            ->andWhere('s.IdUser= :user_id')
            ->andWhere('s.IdFilm = :film_id')
            ->setParameter('user_id', $idUser)
            ->setParameter('film_id',$filmID)
            ->getQuery()
            ->getResult();


    }

    // /**
    //  * @return ListeFilms[] Returns an array of ListeFilms objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListeFilms
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
