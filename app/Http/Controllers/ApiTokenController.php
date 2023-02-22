<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Post;
use App\Models\Community;
use App\Models\Comment;


class ApiTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function assignToken(Request $request, User $user)
    {
        $token = $user->createToken($request->input('name'))->plainTextToken;

        return response()->json([
            'access_token' => $token
        ]);
    }

}
