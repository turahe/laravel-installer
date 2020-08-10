<?php

namespace Turahe\LaravelInstaller\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;

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
