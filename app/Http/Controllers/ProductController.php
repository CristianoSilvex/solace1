<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // Apply style filter
        if ($request->style && $request->style !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('style', $request->style);
            });
        }

        // Apply type filter
        if ($request->type && $request->type !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('clothing', compact('products'));
    }
} 