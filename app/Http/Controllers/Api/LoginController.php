<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\ResponseStatusCode;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (!Auth::attempt(['email' => $email, 'password' => $password])) return $this->error(
            code: ResponseStatusCode::Unauthorized,
            message: 'Email ou senha incorretos ou o usuário não existe'
        );

        $token = $request->user()->createToken('task-manager')->plainTextToken;

        return $this->success(
            message: 'Login efetuado com sucesso',
            data: ['token' => $token]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(message: 'Logout efetuado com sucesso');
    }
}
