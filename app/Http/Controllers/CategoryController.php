<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{

    public $myFile;

    public function create(CreateCategoryRequest $request)
    {
        if ($request->file('image') === null) {
            $this->myFile = 'null';
        } else {
            $this->myFile = $request->file('image')->store('public/images');
        }

        try {
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $this->myFile,
            ]);
            return response()->json([
                'message' => "Category created",
                'data' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
