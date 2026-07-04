<?php

namespace Slym758\FilaCraft\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Themes extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaintBrush;

    protected static ?string $navigationLabel = 'Themes';

    protected static ?string $title = 'Themes';

    protected static ?string $slug = 'themes';

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filacraft::pages.themes';
}
