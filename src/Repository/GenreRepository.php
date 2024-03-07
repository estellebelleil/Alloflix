<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genre>
 *
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }
    /**
     * Récupère tous les films dans l'ordre alphabétique via DQL
     *
     * @return void
     */
    public function findMoviesByGenre($id)
    {
        // Étape 1 : nous appelons le manager d'entités
        $manager = $this->getEntityManager();
        // Etape 2 : on construit la requete DQL
        $query = $manager->createQuery('
            SELECT m
            FROM App\Entity\Movie m
            JOIN m.genres g
            WHERE g.id = :id'
        )

        ->setParameter(':id', $id);
        // Etape 3 : j'execute la requête DQL et je retourne le resultat
        return $query->getResult();
    }
    /**
     * Récupère tous les genres dans l'ordre alphabétique via DQL
     *
     * @return void
     */
    public function findAllOrderByTitleAscDql()
    {
        // Étape 1 : nous appelons le manager d'entités
        $manager = $this->getEntityManager();
        // Etape 2 : on construit la requete DQL
        $query = $manager->createQuery(
            'SELECT g
            FROM App\Entity\Genre g
            ORDER BY g.name ASC'
        );

        // Etape 3 : j'execute la requête DQL et je retourne le resultat
        return $query->getResult();
    }

//    /**
//     * @return Genre[] Returns an array of Genre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Genre
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
