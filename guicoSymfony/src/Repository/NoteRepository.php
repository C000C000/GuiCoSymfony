<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Note $entity, bool $flush = true): void
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
    public function remove(Note $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getMoyenne($id){
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'Select p
            FROM App\Entity\Note p
            WHERE p.IdFilm = :idFilm'
        )
            ->setParameter('idFilm', $id);
        $res = $query->getResult();
        $resVal = 0;
        $nbVal = 0;
        foreach($res as $resultat){
            $nbVal++;
            $resVal += $resultat->getNote();
        }
        if($nbVal == 0){
            return $resVal;
        }else{
            return $resVal / $nbVal;
        }
        //return $query->getResult();
//        $rq = $this->createQueryBuilder('p')
//            ->select('p.note')
//            ->where('p.IdFilm = :idFilm')
//            ->setParameter('idFilm', $id);
//        $query = $rq->getQuery();
//        DD($query->execute());
    }
    // /**
    //  * @return Note[] Returns an array of Note objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Note
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
