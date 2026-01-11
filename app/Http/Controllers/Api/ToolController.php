<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Category;

class ToolController extends Controller
{
    public function index(Request $request)
    {
        $query = Tool::with('category')->where('status', 'published');
        
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        $tools = $query->paginate(15);
        
        return response()->json([
            'success' => true,
            'data' => $tools->items(),
            'pagination' => [
                'current_page' => $tools->currentPage(),
                'last_page' => $tools->lastPage(),
                'per_page' => $tools->perPage(),
                'total' => $tools->total(),
            ]
        ]);
    }

    public function show($slug)
    {
        $tool = Tool::with('category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        return response()->json([
            'success' => true,
            'data' => $tool
        ]);
    }
}