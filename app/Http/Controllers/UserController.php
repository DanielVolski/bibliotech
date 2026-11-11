<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    public function getAll(): JsonResponse {
        $users = User::all();

        return response()->json($users);
    }

    public function get(int $id): JsonResponse {
        $user = User::find($id);

        return response()->json($user);
    }

    public function create(Request $request): void {

    }

    public function update(Request $request, int $id): void {}

    public function delete(int $id): Response {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return response("", 204);
    }
}
