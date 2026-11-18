<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    public function getAll(): JsonResponse {
        $users = User::all();

        return response()->json($users, Response::HTTP_OK);
    }

    public function get(int $id): JsonResponse {
        $user = User::find($id);

        return response()->json($user, Response::HTTP_OK);
    }

    public function create(UserFormRequest $request): JsonResponse {
        $validated = $request->validated();

        $validated['role'] = 'reader';
    
        $user = User::create($validated);

        return response()->json($user, Response::HTTP_CREATED);
    }

    public function update(UserFormRequest $request, int $id): JsonResponse {
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'messages' => "User with id $id was not found"
            ], Response::HTTP_NOT_FOUND);
        }

        $user->update($request->validated());

        return response()->json($user, Response::HTTP_OK);
    }

    public function delete(int $id): Response {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return response("", Response::HTTP_NO_CONTENT);
    }
}
