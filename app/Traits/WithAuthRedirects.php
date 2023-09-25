<?php

namespace App\Traits;

trait WithAuthRedirects
{
    public function redirectToLogin(): \Illuminate\Http\RedirectResponse
    {
        return $this->redirectTo('login');
    }

    public function redirectToRegister(): \Illuminate\Http\RedirectResponse
    {
        return $this->redirectTo('register');
    }

    public function redirectTo($routeName): \Illuminate\Http\RedirectResponse
    {
        redirect()->setIntendedUrl(url()->previous());

        return to_route($routeName);
    }
}
