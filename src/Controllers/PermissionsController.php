<?php

namespace Turahe\LaravelInstaller\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Turahe\LaravelInstaller\Helpers\PermissionsChecker;

/**
 * Class PermissionsController.
 */
class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected PermissionsChecker $permissions;

    /**
     * @param  PermissionsChecker  $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return View
     */
    public function permissions(): View
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('installer::permissions', compact('permissions'));
    }
}
