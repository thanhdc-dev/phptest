<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

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
     * Get product list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fromPrice = $request->get('from_price', null);
        $toPrice = $request->get('to_price', null);
        $perPage = $request->get('per_page', $this->model->getPerPage());

        $res = $this->model::withoutTrashed()
            ->where(function($subQuery) use ($fromPrice, $toPrice) {
                if ($fromPrice != null) {
                    $subQuery->where('price', '>=', $fromPrice);
                }
                if ($toPrice != null) {
                    $subQuery->where('price', '<=', $toPrice);
                }
            })
            ->paginate($this->model->getPerPage())
            ->toArray((int)$perPage);
        $res['status'] = true;
        return response()->json($res);
    }
}
