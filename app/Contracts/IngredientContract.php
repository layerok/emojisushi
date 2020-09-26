<?php
namespace App\Contracts;

/**
 * Interface IngredientContract
 * @package App\Contracts
 */
interface IngredientContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listIngredients(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findIngredientById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createIngredient(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIngredient(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteIngredient($id);

    /**
     * @return mixed
     */
    public function treeList();

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);
}
