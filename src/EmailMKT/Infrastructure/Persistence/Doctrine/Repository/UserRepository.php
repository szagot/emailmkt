<?php
// Indica ao PHP para trabalhar no modo tipado.
// Isto é, quando indicado um tipo de variável primitivo, ele deve ser obedecido.
declare(strict_types = 1);

namespace EmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;
use EmailMKT\Domain\Entity\User;
use EmailMKT\Domain\Persistence\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function create($entity) : User
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function update($entity) : User
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

    public function remove($entity) : bool
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return true;
    }

    public function find($id) : User
    {
        return parent::find($id);
    }

    public function findAll($orderField = null, $orderType = null) : array
    {
        // Garante que o campo de ordenação esteja em minusculo
        if (! empty($orderField)) {
            $orderField = strtolower($orderField);
        }
        // Garante que o tipo da ordenação esteja tudo em maiúsculo
        if (! empty($orderType)) {
            $orderType = strtoupper($orderType);
        }

        switch ($orderField) {
            // Ordenado por nome?
            case 'name':
                return parent::findBy([], ['name' => ($orderType == 'DESC') ? 'DESC' : 'ASC']);
            // Ordenado por email?
            case 'email':
                return parent::findBy([], ['email' => ($orderType == 'DESC') ? 'DESC' : 'ASC']);
            default:
                // Ordenado por id, porém em ordem inversa?
                if ($orderType == 'DESC') {
                    return parent::findBy([], ['id' => 'DESC']);
                }
        }

        // Ordem de cadastro (id em ordem normal)
        return parent::findAll();
    }

}