<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\IngredientContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class IngredientRepository extends BaseRepository implements IngredientContract
{
    use UploadAble;

    /**
     * IngredientRepository constructor.
     * @param Ingredient $model
     */
    public function __construct(Ingredient $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listIngredients(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findIngredientById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Ingredient|mixed
     */
    public function createIngredient(array $params)
    {
        try {
            $collection = collect($params);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'ingredients');
            }

            $status = $collection->has('status') ? 1 : 0;

            $poster_id = 9999;

            $merge = $collection->merge(compact(['status', 'image', 'poster_id']));

            $ingredient = new Ingredient($merge->all());

            $ingredient->save();

            return $ingredient;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIngredient(array $params)
    {
        $ingredient = $this->findIngredientById($params['id']);

        $collection = collect($params)->except('_token');
        $image = $ingredient->image;

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($ingredient->image != null) {
                $this->deleteOne($ingredient->image);
            }

            $image = $this->uploadOne($params['image'], 'ingredients');
        }

        $status = $collection->has('status') ? 1 : 0;

        $merge = $collection->merge(compact('status', 'image'));

        $ingredient->update($merge->all());

        return $ingredient;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteIngredient($id)
    {
        $ingredient = $this->findIngredientById($id);

        if ($ingredient->image != null) {
            $this->deleteOne($ingredient->image);
        }

        $ingredient->delete();

        return $ingredient;
    }

    /**
     * @return mixed
     */
    public function treeList()
    {
        return Ingredient::orderByRaw('-name ASC')
            ->get()
            ->nest()
            ->listsFlattened('name');
    }

    public function findBySlug($slug)
    {
        return Ingredient::with('products')
            ->where('slug', $slug)
            ->first();
    }

}
