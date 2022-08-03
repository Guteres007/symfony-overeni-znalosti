<?php

namespace App\Repository;


use App\Entity\Contact;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;

interface ContactRepositoryInterface
{

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Contact $entity, bool $flush = true): void;

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Contact $entity, bool $flush = true): void;

    public function getPaginate(): QueryBuilder;

    public function edit(Contact $entity, bool $flush = true): void;
}
