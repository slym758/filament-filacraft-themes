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
            $settings = UserThemeSetting::where('user_id', $user->id)->first();
            $theme = $settings?->settings['theme'] ?? null;

            if ($theme === 'kutup') {
                Filament::getCurrentPanel()?->topNavigation();
            }
        }

        return $next($request);
    }
}
