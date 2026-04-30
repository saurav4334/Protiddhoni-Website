<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
    /**
     * GET /api/posts
     * Query params: ?category=slug&tag=slug&search=keyword&featured=1&per_page=12&page=1
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min((int) $request->get('per_page', 12), 50);

        $query = BlogPost::published()
            ->with(['category', 'author:id,name,avatar_url', 'tags:id,name,slug'])
            ->orderByDesc('published_at');

        if ($cat = $request->get('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $cat));
        }

        if ($tag = $request->get('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('slug', $tag));
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        $posts = $query->paginate($perPage);

        return response()->json([
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'per_page'     => $posts->perPage(),
                'total'        => $posts->total(),
            ],
        ]);
    }

    /** GET /api/posts/{slug} */
    public function show(string $slug): JsonResponse
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->with(['category', 'author:id,name,avatar_url', 'tags:id,name,slug'])
            ->firstOrFail();

        $post->incrementViews();

        return response()->json(['data' => $post]);
    }

    /** GET /api/categories */
    public function categories(): JsonResponse
    {
        $cats = BlogCategory::where('is_active', true)
            ->withCount('publishedPosts')
            ->orderBy('sort_order')
            ->get();

        return response()->json(['data' => $cats]);
    }

    /** GET /api/tags */
    public function tags(): JsonResponse
    {
        $tags = BlogTag::orderBy('name')->get();
        return response()->json(['data' => $tags]);
    }
}
