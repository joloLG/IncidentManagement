<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => Post::latest()->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $post = Post::create($validated);

        return response()->json(['data' => $post], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json(['data' => $post]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([], 204);
    }
}
