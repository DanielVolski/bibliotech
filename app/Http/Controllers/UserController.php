<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserController extends Controller
{
    public function getAll(): JsonResponse {
        $users = User::all();

        return response()->json($users);
    }

    public function get(int $id): HttpFoundationResponse {
        $user = User::find($id);

        if (! $user) {
            return response('', 404);
        }

        return response()->json($user);
    }

    public function create(UserRequest $request): JsonResponse {
        $validated = $request->validated();

        $validated['role'] = 'reader';

        $user = User::create($validated);

        return response()->json($user);
    }

    public function update(UserRequest $request, int $id): JsonResponse {
        $user = User::find($id);

        if ($user) {
            $user->update($request->validated());
            return response()->json($user);
        }

        return response()->json(
            ["message" => "User with $id was not found"],
            Response::HTTP_NOT_FOUND
        );
    }

    public function delete(int $id): Response {
        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return response("", Response::HTTP_NO_CONTENT);
    }
}
