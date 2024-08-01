<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProductsController extends Controller
{
    public function Index()
    {
        $products = Product::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();



        return Inertia::render('Admin/Product/Index', compact('products', 'categories', 'subcategories'));
    }
    public function ProductCreate()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return Inertia::render('Admin/Product/Create', compact('categories', 'subcategories'));
    }

    public function ProductStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required'],
            'product_name' => ['required', 'min:3'],
            'description' => ['nullable', 'min:3'],
            'product_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'price' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move('product_images', $imageName);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'product_image' => 'product_images/' . $imageName,
            'price' => $request-> price,

        ]);


        return Redirect::route('admin.products')->with('success', 'Product Created Succesfully');
    }

    public function ProductEdit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return Inertia::render('Admin/Product/Edit', compact('categories', 'product', 'subcategories'));
    }

    public function ProductUpdate(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'product_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $imagePath = $product->product_image;
        if ($request->hasFile('product_image')) {
            if ($product->product_image && file_exists(public_path($product->product_image))) {
                unlink(public_path($product->product_image));
            }
            $image = $request->file('product_image');
            $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product_images'), $uniqueName);
            $imagePath = 'product_images/' . $uniqueName;
        }



        $product->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'product_image' => $imagePath,
            'price' => $request->price,
        ]);

        return Redirect::route('admin.products')->with('message', 'SubCategory deleted successfully.');
    }

    public function ProductDelete(Product $product)
    {
        $image = $product->image;
        if (File::exists($image)) {
            File::delete($image);
        }
        $product->delete();
        return Redirect::route('admin.products')->with('message', 'Product Deleted Successfully.');
    }
}
