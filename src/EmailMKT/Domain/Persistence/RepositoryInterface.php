<?php

namespace EmailMKT\Domain\Persistence;

interface RepositoryInterface
{
    public function create($entity);

    public function update($entity);

    public function remove($entity);

    /**
     * Localiza pelo ID
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Traz todos os itens em ordem de cadastro (id)
     *
     * @param string $orderField Indica qual o campo da ordenação
     * @param string $orderType  Indica qual o tipo da ordenação (asc|desc)
     *
     * @return array
     */
    public function findAll($orderField = null, $orderType = null);
}