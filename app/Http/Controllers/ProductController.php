<?php

namespace App\Http\Controllers;
use App\Models\ViewProduct;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categorySlug = null, Request $request)
    {
        //
        $conds = [];
        $catId = null;
        $selectedCategoryName = "Tất cả sản phẩm";
        if ($categorySlug) {
            $tmp = explode("-", $categorySlug);
            $catId = array_pop($tmp); 
            $conds[] = ["category_id", "=", $catId];
            $category = Category::find($catId);
            $selectedCategoryName = $category->name;

        }

        if ($request->has("price-range")) {
            // price-range=100000-200000
            $priceRange = $request->input("price-range");
            $temp = explode("-", $priceRange);
            $start = $temp[0];
            $end = $temp[1];
            $conds[] = ["sale_price", ">=", $start];
            //sale_price >= 100000
            // bởi vì: 1000000-greater
            if (is_numeric($end)) {
                $conds[] = ["sale_price", "<=", $end];
            }
            //sale_price <= 200000
        }

        if ($request->has("search")) {
            $search = $request->input("search");
            $conds[] = ["name", "LIKE", "%$search%"];
            
        }

        $col = "name";
        $sortType = "ASC";
        if ($request->has("sort")) {
            // sort=alpha-asc
            $sort = $request->input("sort");
            $colMap = ['alpha' => 'name', 'created' => 'created_date', 'price' => 'sale_price'];
            $temp = explode("-", $sort);
            $col = $colMap[$temp[0]];
            $sortType = $temp[1];
            
        }
        $itemPerPage = env("ITEM_PER_PAGE", 4);
        $products = ViewProduct::where($conds)->orderBy($col, $sortType)->paginate($itemPerPage)->withQueryString();
       
        $categories = Category::all();
        
        $data = [
            "products" => $products,
            "categories" => $categories,
            "catId" => $catId,
            "selectedCategoryName" => $selectedCategoryName,
        ];
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $tmp = explode("-", $slug);
        $id = array_pop($tmp);
        $product = ViewProduct::find($id);
        $categories = Category::all();
        $data = [
            "product" => $product, 
            "categories" => $categories,
            "catId" =>  $product->category_id
        ];
        return view('product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function search(Request $request) {
        $search = $request->input("pattern");
        $conds = [];
        $conds[] = ["name", "LIKE", "%$search%"];
        $products = ViewProduct::where($conds)->get();
        return view('product.search', ["products" => $products]);
    }
}
