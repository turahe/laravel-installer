<?php

namespace Turahe\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Turahe\LaravelInstaller\Helpers\DatabaseManager;

/**
 * Class DatabaseController
 * @package Turahe\LaravelInstaller\Controllers
 */
class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private DatabaseManager $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return RedirectResponse
     */
    public function database(): RedirectResponse
    {
        $response = $this->databaseManager->migrateAndSeed();

        return redirect()->route('LaravelInstaller::final')
                         ->with(['message' => $response]);
    }
}
