<?php

namespace Slym758\FilaCraft\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Slym758\FilaCraft\Models\UserThemeSetting;
use Symfony\Component\HttpFoundation\Response;

class ApplyThemeLayout
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($user = $request->user()) {
            $theme = UserThemeSetting::settingsForUser($user->id)['theme'] ?? null;

            if ($theme === 'kutup') {
                Filament::getCurrentPanel()?->topNavigation();
            }
        }

        return $next($request);
    }
}
