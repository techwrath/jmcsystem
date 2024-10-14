<?php

namespace App\Providers;

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use BotDetect\Captcha\Captcha;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            return view('auth.login');
        });
        Fortify::authenticateUsing(function (Request $request) {

            
            $user = User::where('email', $request->email)->first();
            // if ($user && $user->userStatus === 'INACTIVE') {
            //     session()->flash('Error', 'Your account is blocked. Please contact the administrator.');
            //     return false; 
            // }
            if ($user &&
                Hash::check($request->password, $user->password) && Validator::make($request->all(), [
                    'CaptchaCode' => ['required', 'valid_captcha']
                ])) {
                    // if(Validator::make($request->all(), [
                    //     'CaptchaCode' => ['required', 'valid_captcha']
                    // ]))
                return $user;
            }
             
            session()->flash('loginError', 'Invalid Credentials');
                return false; 
           
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
