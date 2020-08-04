<?php

namespace Turahe\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the installer welcome page.
     *
     * @return View
     */
    public function welcome(): View
    {
        return view('installer::welcome');
    }
}
