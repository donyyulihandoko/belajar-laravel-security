<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    public function create(Request $request, Todo $todo): JsonResponse
    {
        $this->authorize("create", Todo::class);

        return response()->json([
            "message" => "success"
        ]);
    }
}
