<?php

namespace App\Service;
use Doctrine\ORM\EntityManager;
use App\Entity\Trick;
use App\Entity\Media;

class TrickMedia 
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getTricks()
    {
        $tricks = $this->em->getRepository(Trick::class)->findAll();
        return $tricks;
    }

}