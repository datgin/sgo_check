<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\{
    LoginRequest,
    ProfileRequest,
};
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        return transaction(function () use ($request) {
            $credentials = $request->validated();
            $remember = $request->filled('remember');

            if (Auth::attempt($credentials, $remember)) {

                $user = Auth::user();

                $request->session()->regenerate();

                $redirect = route('dashboard', ['phone' => $user->phone]);

                return successResponse(message: 'Đăng nhập thành công', data: $redirect);
            }

            return errorResponse('Mật khẩu không chính xác!', 422);
        });
    }

    public function me()
    {
        $user = Auth::user();

        return view('pages.profile', compact('user'));
    }

    public function updateMe(ProfileRequest $request)
    {
        return transaction(function () use ($request) {
            /** @var User $user */
            $user = Auth::user();


            $user->fill($request->validated());
            $user->save();

            Auth::setUser($user);

            return successResponse(
                message: "Cập nhật thông tin thành công.",
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit',
                data: $user
            );
        });
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
