<?php

namespace App\Infrastructure\Service;

use App\Models\Flusher;
use Doctrine\ORM\EntityManager;

class DoctrineFlusher implements Flusher
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function flush(): void
    {
        $this->em->flush();
    }
}