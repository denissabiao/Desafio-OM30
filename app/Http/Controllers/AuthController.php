<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Http\Requests\CreateUser;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginUser $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Login ou senha inválidas.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();
    
        /** @var \App\Models\User $user **/
        $token = $user->createToken('ApiToken')->plainTextToken;

        $user = new AuthResource(auth()->user());

        return response()->json([
            'message' => 'Login efetuado com sucesso.',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(CreateUser $request)
    {
        $request->validated();

        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $tokenJson = $user->createToken('ApiToken')->plainTextToken;

        //token via cookie caso necessario
        $tokenCookie = $this->userService::getCookie($tokenJson);

        return response()->json([
            'token' => $tokenJson,
            'message' => 'Usuário cadastrado com sucesso.'
        ], 201)
            ->withCookie($tokenCookie);
    }
}
