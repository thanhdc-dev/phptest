<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;

class ProductController extends Controller
{
    private $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Show the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->model::withoutTrashed()
            ->orderByDesc('id')
            ->paginate($this->model->getPerPage());
        return view('products.index', compact('products'));
    }

    /**
     * Show form create product
     *
     * @return void
     */
    function create() {
        $product = $this->model;
        return view('products.form', compact('product'));
    }

    /**
     * Create new product
     *
     * @param ProductRequest $productRequest
     * @return void
     */
    function store(ProductRequest $productRequest) {

        $productParams = $productRequest->post();
        if ($productRequest->hasFile('image')){
            $file = $productRequest->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-product.' . $extension;
            $productParams['image_path'] = $file->storeAs('products', $filename, 'public');
        }
        $this->model::create($productParams);
        return redirect()->route('products.index')->with('success','Create success');
    }

    /**
     * Show form edit product
     *
     * @param Product $product
     * @return void
     */
    function edit($id) {
        $product = $this->model::findOrFail($id);
        return view('products.form', compact('product'));
    }

    /**
     * Update product
     *
     * @param ProductRequest $productRequest
     * @param Product $product
     * @return void
     */
    public function update(ProductRequest $productRequest, Product $product)
    {
        $productParams = $productRequest->post();
        if ($productRequest->hasFile('image')){
            $file = $productRequest->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '-product.' . $extension;
            $productParams['image_path'] = $file->storeAs('products', $filename, 'public');
        }
        $product->fill($productParams);
        $product->save();

        return redirect()->route('products.index')->with('success','Update success');
    }

    /**
     * Show product detail
     *
     * @param Product $product
     * @return void
     */
    function show(Product $product) {
        return view('products.show', compact('product'));
    }

    /**
     * Delete product
     *
     * @param Product $product
     * @return void
     */
    function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success','Delete success');
    }
}
