<?php

namespace EmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{
    public function create($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function update($entity)
    {
        // Verifica se a unidade de trabalho está gerenciada
        if ($this->getEntityManager()->getUnitOfWork()->getEntityState($entity) != UnitOfWork::STATE_MANAGED) {
            // Se não estiver gerenciável, torna gerenciavel
            // Semelhante ao persist, mas é mais apropriado para atualização.
            // Dessa forma ele pega apenas o que mudou na persistencia já feita.
            $this->getEntityManager()->merge($entity);
        }

        // Aplica as alterações feitas
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function remove($entity)
    {
        // TODO: Implement remove() method.
    }

    public function find($id)
    {
        return parent::find($id);
    }

    public function findAll()
    {
        return parent::findAll();
    }

}