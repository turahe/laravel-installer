<?php

namespace Turahe\LaravelInstaller\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Turahe\LaravelInstaller\Helpers\DatabaseManager;
use Turahe\LaravelInstaller\Helpers\MigrationsHelper;
use Turahe\LaravelInstaller\Helpers\InstalledFileManager;

/**
 * Class UpdateController
 * @package Turahe\LaravelInstaller\Controllers
 */
class UpdateController extends Controller
{
    use MigrationsHelper;

    /**
     * Display the updater welcome page.
     *
     * @return View
     */
    public function welcome(): View
    {
        return view('installer::update.welcome');
    }

    /**
     * Display the updater overview page.
     *
     * @return View
     */
    public function overview(): View
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return view('installer::update.overview', ['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)]);
    }

    /**
     * Migrate and seed the database.
     *
     * @return RedirectResponse
     */
    public function database(): RedirectResponse
    {
        $databaseManager = new DatabaseManager;
        $response = $databaseManager->migrateAndSeed();

        return redirect()->route('LaravelUpdater::final')
                         ->with(['message' => $response]);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();

        return view('installer::update.finished');
    }
}
