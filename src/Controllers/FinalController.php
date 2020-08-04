<?php

namespace Turahe\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\LaravelInstaller\Events\LaravelInstallerFinished;
use Turahe\LaravelInstaller\Helpers\EnvironmentManager;
use Turahe\LaravelInstaller\Helpers\FinalInstallManager;
use Turahe\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param FinalInstallManager $finalInstall
     * @param EnvironmentManager $environment
     * @return View
     */
    public function finish(
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall,
        EnvironmentManager $environment
    ): View {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view(
            'installer::finished',
            compact('finalMessages', 'finalStatusMessage', 'finalEnvFile')
        );
    }
}
