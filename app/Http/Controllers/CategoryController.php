<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use Exception;

class CategoryController extends Controller
{

    public function create(CreateCategoryRequest $request)
    {
        try {
            return response()->json([
                'message' => "I got here after request"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
