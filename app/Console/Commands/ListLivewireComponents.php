<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ListLivewireComponents extends Command
{
    protected $signature = 'livewire:list';
    protected $description = 'List all Livewire components';

    public function handle()
    {
        $livewirePath = app_path('Livewire');
        $components = $this->getComponents($livewirePath);

        if (empty($components)) {
            $this->info('No Livewire components found.');
            return;
        }

        $this->info('Livewire Components:');
        foreach ($components as $component) {
            $this->line($component);
        }
    }

    private function getComponents($path, $namespace = 'App\\Livewire')
    {
        $components = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            $relativePath = str_replace($path . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $class = $namespace . '\\' . str_replace(['/', '.php'], ['\\', ''], $relativePath);
            if (class_exists($class)) {
                $components[] = $class;
            }
        }

        return $components;
    }
}
