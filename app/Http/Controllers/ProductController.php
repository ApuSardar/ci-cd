<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Pipes\ProductUpdatePipeline;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Validation\ValidationException;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepo;
    protected $pipeline;

    public function __construct(ProductRepositoryInterface $productRepo, ProductUpdatePipeline $pipeline)
    {
        $this->productRepo = $productRepo;
        $this->pipeline = $pipeline;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::select(['id', 'name', 'price', 'stock']);

            return DataTables::of($products)
                ->addColumn('action', function ($product) {
                    $editUrl = route('products.edit', $product->id);
                    $deleteUrl = route('products.destroy', $product->id);

                    return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        // dd($request);
        try {
            $data = $this->handleFileUploads($request);
            $this->productRepo->create($data);
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $product = $this->productRepo->find($id);
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $data = $this->handleFileUploads($request);

            // Update the product
            $product = $this->productRepo->find($id);
            $product->update($data);

            // Update multiple_images JSON field
            if ($request->has('multiple_images')) {
                $images = json_encode($request->file('multiple_images')->map(function ($file) {
                    return $file->store('images', 'public'); // Store file and return path
                }));
                $product->update(['multiple_images' => $images]);
            }

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }


    public function show($id)
    {
        Log::info("Showing product with ID: $id");
        $product = Product::findOrFail($id);
        // return view('products.show', compact('product'));
    }


    public function updateAllProducts()
{
    $products = Product::all();

    // Apply discount using the pipeline
    $this->pipeline->handle($products, function ($products) {
        return $products;
    });

    return redirect()->route('products.index')->with('success', 'Discount applied to all products.');
}









    private function handleFileUploads(Request $request)
    {
        $data = $request->except(['main_image', 'multiple_images']);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        if ($request->hasFile('multiple_images')) {
            $data['multiple_images'] = json_encode(array_map(function ($image) {
                return $image->store('products', 'public');
            }, $request->file('multiple_images')));
        }

        return $data;
    }
}
