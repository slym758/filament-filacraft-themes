<?php

namespace Slym758\FilaCraft\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallCommand extends Command
{
    protected $signature = 'filacraft:install';

    protected $description = 'Install FilaCraft: CSS import, error views, and migration.';

    public function handle(): int
    {
        $this->registerPlugin();
        $this->installCss();
        $this->publishErrorViews();
        $this->runMigrations();

        $this->newLine();
        $this->info('FilaCraft installed successfully!');
        $this->info('Run `npm run build` to compile the theme.');

        return self::SUCCESS;
    }

    protected function registerPlugin(): void
    {
        $providerPath = app_path('Providers/Filament/AdminPanelProvider.php');

        if (! File::exists($providerPath)) {
            $this->warn('AdminPanelProvider not found, skipping plugin registration.');

            return;
        }

        $contents = File::get($providerPath);

        if (str_contains($contents, 'FilaCraftPlugin')) {
            $this->info('FilaCraftPlugin already registered in AdminPanelProvider.');

            return;
        }

        // Add use statement
        $useStatement = 'use Slym758\\FilaCraft\\FilaCraftPlugin;';

        if (preg_match('/^(namespace .+?;\n)/ms', $contents, $m, \PREG_OFFSET_CAPTURE)) {
            $insertPos = $m[0][1] + strlen($m[0][0]);
            // Find the last use statement to insert after it
            if (preg_match_all('/^use .+?;\n/ms', substr($contents, $insertPos), $uses, \PREG_OFFSET_CAPTURE)) {
                $lastUse = end($uses[0]);
                $afterLastUse = $insertPos + $lastUse[1] + strlen($lastUse[0]);
                $contents = substr($contents, 0, $afterLastUse).$useStatement."\n".substr($contents, $afterLastUse);
            }
        }

        // Add plugin to panel - find ->plugins([...]) or add after ->authMiddleware([...])
        if (preg_match('/->plugins\(\[/', $contents)) {
            // plugins() already exists, add to it
            $contents = preg_replace(
                '/(->plugins\(\[)/',
                "$1\n                FilaCraftPlugin::make(),",
                $contents
            );
        } else {
            // Add ->plugins() after ->authMiddleware([...])
            $contents = preg_replace(
                '/(->authMiddleware\(\[\s*[^]]*?\]\s*\))/',
                "$1\n            ->plugins([\n                FilaCraftPlugin::make(),\n            ])",
                $contents
            );
        }

        File::put($providerPath, $contents);

        $this->info('FilaCraftPlugin registered in AdminPanelProvider.');
    }

    protected function installCss(): void
    {
        $themePath = resource_path('css/filament/admin/theme.css');

        if (! File::exists($themePath)) {
            $this->info('Theme file not found, creating it...');
            $this->call('make:filament-theme', ['panel' => 'admin']);
        }

        if (! File::exists($themePath)) {
            $this->warn('Could not create theme file at: '.$themePath);

            return;
        }

        $contents = File::get($themePath);

        // Detect the correct import path
        $vendorPath = base_path('vendor/slym758/filacraft/resources/css/theme.css');
        $localPath = base_path('packages/filacraft/resources/css/theme.css');

        if (File::exists($localPath)) {
            $importLine = "@import '../../../../packages/filacraft/resources/css/theme.css';";
        } else {
            $importLine = "@import '../../../../vendor/slym758/filacraft/resources/css/theme.css';";
        }

        $hasImport = str_contains($contents, 'filacraft/resources/css/theme.css');
        $hasSource = str_contains($contents, 'filacraft/resources/views');

        if ($hasImport && $hasSource) {
            $this->info('FilaCraft CSS import already exists in theme.css');

            return;
        }

        // Add @source for package views (Tailwind CSS v4)
        $sourceLine = File::exists($localPath)
            ? "@source '../../../../packages/filacraft/resources/views/**/*';"
            : "@source '../../../../vendor/slym758/filacraft/resources/views/**/*';";

        $newContents = $importLine."\n".$sourceLine."\n".$contents;
        File::put($themePath, $newContents);

        $this->info('FilaCraft CSS import and @source added to theme.css');
    }

    protected function publishErrorViews(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'filacraft-error-views',
            '--force' => true,
        ]);

        $this->info('Error page views published.');
    }

    protected function runMigrations(): void
    {
        $this->call('migrate');
    }
}
