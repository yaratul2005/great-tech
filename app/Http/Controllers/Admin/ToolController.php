<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with('category')->paginate(10);
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'file' => 'required|file|mimes:zip,rar|max:102400', // Max 100MB
            'status' => 'required|in:draft,published,archived',
            'version' => 'required|string|max:20',
        ]);

        // Store the file
        $file = $request->file('file');
        $filePath = $file->store('tools', 'public');

        Tool::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'file_path' => $filePath,
            'status' => $request->status,
            'slug' => Str::slug($request->name),
            'version' => $request->version,
        ]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function show(Tool $tool)
    {
        return view('admin.tools.show', compact('tool'));
    }

    public function edit(Tool $tool)
    {
        $categories = Category::all();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, Tool $tool)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'file' => 'nullable|file|mimes:zip,rar|max:102400', // Max 100MB
            'status' => 'required|in:draft,published,archived',
            'version' => 'required|string|max:20',
        ]);

        $tool->name = $request->name;
        $tool->category_id = $request->category_id;
        $tool->description = $request->description;
        $tool->price = $request->price;
        $tool->status = $request->status;
        $tool->version = $request->version;
        $tool->slug = Str::slug($request->name);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($tool->file_path) {
                Storage::disk('public')->delete($tool->file_path);
            }
            
            // Store new file
            $file = $request->file('file');
            $tool->file_path = $file->store('tools', 'public');
        }

        $tool->save();

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        // Delete associated file
        if ($tool->file_path) {
            Storage::disk('public')->delete($tool->file_path);
        }

        $tool->delete();

        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully.');
    }
}