<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Poster;
use Illuminate\Http\Request;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreProductFormRequest;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;

class ProductController extends BaseController
{


    protected $categoryRepository;

    protected $productRepository;

    public function __construct(
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = Product::with('categories')->get();
        $this->setPageTitle('Продукты', 'Список продуктов');
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Продукты', 'Создать продукт');
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        $categories = $this->categoryRepository->listCategories('name', 'asc');


        $this->setPageTitle('Продукты', 'Редактировать продукт');
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }

        if($params['action'] == "save" ){
            return $this->responseRedirectBack('Продукт успешно обновлен', 'success', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $product = $this->productRepository->deleteProduct($id);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while deleting product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product deleted successfully' ,'success',false, false);
    }

    public function syncPhotos(){
        $poster = new Poster(env('POSTER_TOKEN'));
        $data = json_decode($poster->query('menu.getProducts'), true);


        foreach($data['response'] as $product){
            if(isset($product['product_id'])){

                if(!empty($product['photo'])) {
                    Product::where('poster_id', '=', $product['product_id'])->update([
                        "image" => env('POSTER_LINK') . $product["photo"]
                    ]);
                }else{
                    Product::where('poster_id', '=', $product['product_id'])->update([
                        "image" => null
                    ]);
                }

            }

        }

        return $this->responseRedirect('admin.products.index', 'Фотографии синхронизированы успешно' ,'success',false, false);
    }

    public function syncPrices(){
        function delEndind($str){
            if(!empty($str)){
                $sub_str = substr($str, 0, strlen($str)-2);
                return $sub_str;
            }

            return 0;
        }

        $poster = new Poster(env('POSTER_TOKEN'));
        $data = json_decode($poster->query('menu.getProducts'), true);

        //dd($data);
        $arr_product_ids = [];
        foreach($data['response'] as $product){


            $arr_product_ids[] = $product['product_id'];
            if (isset($product['modifications'])) {

                foreach ($product['modifications'] as $value1) {

                    $product_id = Product::where("poster_id", "=", $product['product_id'])->value('id');

                    AttributeValue::where("poster_id", "=", $value1['modificator_id'])
                        ->first()
                        ->productAttributes()
                        ->where("product_attributes.id", "=", $product_id)
                        ->update([
                            'price'         => delEndind($value1['spots'][0]['price']),
                        ]);
                }
            }
            else {
                $record['price'] = delEndind($product['price'][1]);
                Product::where("poster_id", "=", $product['product_id'])->update([
                    'price' => $record['price'],
                    'weight' => $product['out'],
//                    'hidden' => $product['spots'][0]['visible'] == 1 ? 0 : 1
                ]);

            }
        }
        //dd($arr_product_ids);
        Product::whereNotIn('poster_id', $arr_product_ids)->delete();

        return $this->responseRedirect('admin.products.index', 'Цены синхронизированы успешно' ,'success',false, false);
    }

    public function syncProducts(){
        function delEndind($str){
            if(!empty($str)){
                $sub_str = substr($str, 0, strlen($str)-2);
                return $sub_str;
            }

            return 0;
        }

        $poster = new Poster(env('POSTER_TOKEN'));
        $data = json_decode($poster->query('menu.getProducts'), true);


        foreach($data['response'] as $value) {

            if(Product::where('poster_id', '=', $value['product_id'])->exists()) continue;

            AttributeValue::updateOrInsert([
                'poster_id'     => $value['product_id'],
                'attribute_id'  => 3,
                'value'         => $value['product_name'],
            ]);

            $record = [
                'name'          => $value['product_name'],
                'poster_id'     => $value['product_id'],
                'weight'        => $value['out'],
                'image'         => $value['photo'] ? env('POSTER_LINK') . $value['photo'] : null,
                'unit'          => 'г',
                'sort_order'    => $value['sort_order']
            ];



            if (isset($value['modifications'])) {
                $attribute = Attribute::updateOrInsert([
                    'code'          => str_slug($value['product_name'] . "_modificator" ),
                    'name'          => $value['product_name'] . "_modificator",
                    'frontend_type' => 'radio',
                    'is_filterable' => 1
                ]);

                $attribute_id = $attribute->id;


                $product = Product::create($record);

                $category = Category::wherePosterId($value['menu_category_id'])->first();

                if(!empty($category)){
                    $product->categories()->attach($category['id']);
                }



                foreach ($value['modifications'] as $value1) {

                    $attribute_value = AttributeValue::updateOrInsert([
                        'poster_id'    => $value1['modificator_id'],
                        'attribute_id' => $attribute_id,
                        'value'        => $value1['modificator_name'],
                        'price'        => delEndind($value1['spots'][0]['price'])
                    ]);
                    $attribute_value_id = $attribute_value->id;

                    $product_attribute = ProductAttribute::create([
                        'price'         => delEndind($value1['spots'][0]['price']),
                        'product_id'    => $product->id
                    ]);

                    $product_attribute->attributeValues()->attach($attribute_value_id);
                }

            } else {
                $record['price'] = delEndind($value['price'][1]);
                $product = Product::create($record);
                $category = Category::wherePosterId($value['menu_category_id'])->first();
                if(!empty($category)){
                    $product->categories()->sync([$category['id']]);
                }

                if(isset($value['ingredients'])){

                    // Перебираю массив ингредиентов
                    foreach($value['ingredients'] as $ingredient){
                        $arr_ingredients_ids[] = $ingredient['ingredient_id'];

                        // Создаю ингридиент и привязываю его к аттрибуты "Ингридиент"
                        if(AttributeValue::where('poster_id', '=', $ingredient['ingredient_id'])->exists()){
                            $attribute_value_id = AttributeValue::where('poster_id', '=', $ingredient['ingredient_id'])->first();
                        }else{
                            $attribute_value_id = AttributeValue::insertGetId([
                                'attribute_id' => 3,// 3 - id аттрибута "Ингридиент"
                                'value'        => $ingredient['ingredient_name'],
                                'poster_id'    => $ingredient['ingredient_id']
                            ]);
                        }



                        // Создаю аттрибут для продукта
                        $product_attribute = ProductAttribute::create([
                            'product_id' =>  $product->id
                        ]);

                        // Привязываю созданные выше аттрибут и ингридиет,
                        $product_attribute->attributeValues()->attach($attribute_value_id);


                    }


                }



            }

        }

        return $this->responseRedirect('admin.products.index', 'Товары синхронизированы успешно' ,'success',false, false);
    }

    public function syncIngredients(){
        $arr_ingredients_ids = [];

        $poster = new Poster(env('POSTER_TOKEN'));
        $data = json_decode($poster->query('menu.getProducts'), true);

        $arr_ingredients_ids = [];
        foreach($data['response'] as $value) {

            if (isset($value['modifications'])) {


            } else {



                if(isset($value['ingredients'])){

                    // Перебираю массив ингредиентов
                    foreach($value['ingredients'] as $ingredient){

                        $arr_ingredients_ids[] = $ingredient['ingredient_id'];
                        // Создаю ингридиент и привязываю его к аттрибуты "Ингридиент"
                        if(AttributeValue::where('poster_id', '=', $ingredient['ingredient_id'])->exists()){
                            $attribute_value = AttributeValue::where('poster_id', '=', $ingredient['ingredient_id'])->first();
                            $attribute_value_id = $attribute_value->id;
                        }else{
                            $attribute_value = AttributeValue::updateOrInsert([
                                'poster_id'    => $ingredient['ingredient_id'],
                                'attribute_id' => 3,// 3 - id аттрибута "Ингридиент"
                                'value'        => $ingredient['ingredient_name'],

                            ]);
                            $attribute_value_id = $attribute_value->first()->value('id');

                        }



                        // Создаю аттрибут для продукта
                        $product_attribute = ProductAttribute::updateOrInsert([
                            'product_id' =>  Product::where('poster_id', '=', $value['product_id'])->value('id')
                        ])->first();



                        $product_attribute->attributeValues()->attach($attribute_value_id);
                        //exit();

                    }
                    // Привязываю созданные выше аттрибут и ингридиет,



                }




            }

        }


        AttributeValue::whereNotIn('poster_id', $arr_ingredients_ids)->delete();
        return $this->responseRedirect('admin.products.index', 'Товары синхронизированы успешно' ,'success',false, false);
    }



}
