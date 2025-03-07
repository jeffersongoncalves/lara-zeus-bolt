<?php

namespace LaraZeus\Bolt;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use LaraZeus\Bolt\Filament\Resources\CategoryResource;
use LaraZeus\Bolt\Filament\Resources\CollectionResource;
use LaraZeus\Bolt\Filament\Resources\FormResource;
use LaraZeus\FilamentPluginTools\Concerns\CanDisableBadges;
use LaraZeus\FilamentPluginTools\Concerns\CanGloballySearch;
use LaraZeus\FilamentPluginTools\Concerns\HasModels;
use LaraZeus\FilamentPluginTools\Concerns\HasNavigationGroupLabel;
use LaraZeus\FilamentPluginTools\Concerns\HasRouteNamePrefix;
use LaraZeus\FilamentPluginTools\Concerns\CanHideResources;
use Closure;

final class BoltPlugin implements Plugin
{
    use CanDisableBadges;
    use CanGloballySearch;
    use Configuration;
    use EvaluatesClosures;
    use HasRouteNamePrefix;
    use HasModels;
    use HasNavigationGroupLabel;
    use CanHideResources;

    protected Closure | string $navigationGroupLabel = 'Bolt';

    public array $defaultGloballySearchableAttributes = [
        CategoryResource::class => ['name', 'slug'],
        CollectionResource::class => ['name', 'values'],
        FormResource::class => ['name', 'slug'],
    ];

    public function getId(): string
    {
        return 'zeus-bolt';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                CollectionResource::class,
                FormResource::class,
                CategoryResource::class,
            ]);
    }

    public static function make(): static
    {
        return new self;
    }

    public static function get(): static
    {
        // @phpstan-ignore-next-line
        return filament('zeus-bolt');
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
