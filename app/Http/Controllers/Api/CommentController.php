<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request, Product $product)
    {
        $comment = new Comment();
        $comment->body = $request->body;

        $product->comments()->save($comment);

        return redirect()->back();
    }

    public function create (Request $request){
        $validatedData = $request->validate([
            'commentable' => 'required|string',
        ]);

        $comment = Comment::create($validatedData);

        return response()->json(['message' => 'Comment added successfully!', 'product' => $comment], 201);

    }
}
