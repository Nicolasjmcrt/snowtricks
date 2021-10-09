<?php

namespace App\Service;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;

class DisplayOrder {
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getLastDisplay($trickId)
    {
        $repository = $this->em->getRepository(Media::class);

        
        $count = $repository->createQueryBuilder('m')
            ->select("max(m.displayOrder) as displayOrderMax")
            ->where('m.trick = :trickId')
            ->setParameters([
                'trickId' => $trickId
            ])
            ->getQuery();

        $lastDisplay = $count->getSingleResult();

        return $lastDisplay['displayOrderMax'] + 1;
    }
}