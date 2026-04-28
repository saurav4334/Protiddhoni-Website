<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PageBlock;
use Illuminate\Http\JsonResponse;

class PageBlockApiController extends Controller
{
    /**
     * GET /api/blocks/{key}
     *
     * Examples:
     *   GET /api/blocks/homepage              → all blocks for homepage
     *   GET /api/blocks/homepage.hero.headline → single block by exact key
     */
    public function show(string $key): JsonResponse
    {
        // Treat keys without a dot as a "page" — return all blocks for that page.
        if (! str_contains($key, '.')) {
            return response()->json(['data' => PageBlock::forPage($key)]);
        }

        // Otherwise return a single block by key
        $value = PageBlock::value($key);

        if ($value === null) {
            return response()->json(['error' => 'Block not found', 'key' => $key], 404);
        }

        return response()->json(['data' => ['key' => $key, 'value' => $value]]);
    }
}
