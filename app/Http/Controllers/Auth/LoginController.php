<?php

namespace App\Http\Controllers\Auth;

use App\Domains\User\UserRepository;
use App\Domains\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/posts';

    private $userRepository;
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        UserService $userService
    ) {
        $this->middleware('guest')->except('logout');

        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('google')->user();

        if (! $userSocial) {
            throw new \Exception('Erro na autenticação do Google!');
        }

        if (! $this->isEduzzEmail($userSocial->email)) {
            throw new \Exception('Conta inválida!');
        }

        $user = $this->userRepository->findUserByEmail(
            $userSocial->email
        );

        if (! $user) {
            $user = $this->userService->createUserWithSocial(
                $userSocial
            );
        }

        $this->userService->updateUserAvatar($user, $userSocial->avatar);

        auth()->login($user, true);

        return redirect(route('posts'));
    }

    private function isEduzzEmail(string $email) : bool
    {
        $domain = substr(strrchr($email, '@'), 1);

        if ($domain != 'eduzz.com') {
            return false;
        }

        return true;
    }
}
