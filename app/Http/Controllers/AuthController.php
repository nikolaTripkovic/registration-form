<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Services\AuthService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\User;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegistrationForm(): View
    {
        return view('auth.registration');
    }

    /**
     * @throws \Exception
     */
    public function registerUser(UserRegistrationRequest $request): RedirectResponse
    {
        $request->validated();

        $user = $this->authService->registerUser(
            $request->getUsername(),
            $request->getEmail(),
            $request->getPassword()
        );

        if($user) {
            return $this->handleSuccessRegistration($user);
        } else {
            return $this->handleFailedRegistration();
        }
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function loginUser(UserLoginRequest $request): RedirectResponse
    {
        $request->validated();
        $user = $this->authService->loginUser($request->getUsername(), $request->getPassword());

        if($user) {
            return $this->handleSuccessLogin($user);
        } else {
            return $this->handleFailedLogin();
        }
    }

    public function logoutUser(): RedirectResponse
    {
        $this->authService->logoutUser();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }

    private function handleSuccessRegistration(Authenticatable $user): RedirectResponse
    {
        request()->session()->regenerate();
        // it could be redirection on profile page, but let's assume user needs to confirm email
        return redirect()->intended('login')->with('success', 'Welcome, ' . $user->getUsername());
    }

    private function handleFailedRegistration(): RedirectResponse
    {
        return redirect()->back()->withInput()->with(['error' => 'Something went wrong. Please try again.']);
    }

    private function handleSuccessLogin(User $user): RedirectResponse
    {
        request()->session()->regenerate();
        return redirect()->route('profile')->with(['user' => $user]);
    }

    private function handleFailedLogin(): RedirectResponse
    {
        return redirect()->back()->with(['error' => 'Wrong credentials']);
    }

}
