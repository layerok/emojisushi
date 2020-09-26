<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\IngredientContract;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

/**
 * Class IngredientController
 * @package App\Http\Controllers\Admin
 */
class IngredientController extends BaseController
{
    /**
     * @var IngredientContract
     */
    protected $ingredientRepository;

    /**
     * CategoryController constructor.
     * @param IngredientContract $ingredientRepository
     */
    public function __construct(IngredientContract $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ingredients = $this->ingredientRepository->listIngredients();

        $this->setPageTitle('Ингредиенты', 'Перечислить все ингредиенты');
        return view('admin.ingredients.index', compact('ingredients'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //$categories = $this->ingredientRepository->treeList();
        $spots = DB::table('spots')->get();

        $this->setPageTitle('Ингриедиенты', 'Создать Ингредиенті');
        return view('admin.ingredients.create', compact('spots'));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'spot_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $ingredient = $this->ingredientRepository->createIngredient($params);

        if (!$ingredient) {
            return $this->responseRedirectBack('Error occurred while creating ingredient.', 'error', true, true);
        }
        return $this->responseRedirect('admin.ingredients.index', 'Ingredient added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetIngredient = $this->ingredientRepository->findIngredientById($id);
        $ingredients = $this->ingredientRepository->treeList();

        $this->setPageTitle('Игредиенты', 'Редактировать ингредиент : '.$targetIngredient->name);
        return view('admin.ingredients.edit', compact('ingredients', 'targetIngredient'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $ingredient = $this->ingredientRepository->updateIngredient($params);

        if (!$ingredient) {
            return $this->responseRedirectBack('Error occurred while updating ingredient.', 'error', true, true);
        }
        return $this->responseRedirectBack('Ingredient updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->ingredientRepository->deleteIngredient($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting ingredient.', 'error', true, true);
        }
        return $this->responseRedirect('admin.ingredients.index', 'Ingredient deleted successfully' ,'success',false, false);
    }
}
