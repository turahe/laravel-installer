<?php

namespace Turahe\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class FinalInstallManager.
 */
class FinalInstallManager
{
    /**
     * Run final commands.
     *
     * @return string
     */
    public function runFinal(): string
    {
        $outputLog = new BufferedOutput;

        $this->generateKey($outputLog);
        $this->publishVendorAssets($outputLog);

        return $outputLog->fetch();
    }

    /**
     * Generate New Application Key.
     *
     * @param  BufferedOutput  $outputLog
     * @return array|BufferedOutput
     */
    private static function generateKey(BufferedOutput $outputLog)
    {
        try {
            if (config('installer.final.key')) {
                Artisan::call('key:generate', ['--force'=> true], $outputLog);
            }
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Publish vendor assets.
     *
     * @param  BufferedOutput  $outputLog
     * @return array|BufferedOutput
     */
    private static function publishVendorAssets(BufferedOutput $outputLog)
    {
        try {
            if (config('installer.final.publish')) {
                Artisan::call('vendor:publish', ['--all' => true], $outputLog);
            }
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param  BufferedOutput  $outputLog
     * @return array
     */
    private static function response($message, BufferedOutput $outputLog)
    {
        return [
            'status' => 'error',
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }
}
