<?php

namespace Slym758\FilaCraft;

use Filament\Contracts\Plugin;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Slym758\FilaCraft\Http\Middleware\ApplyThemeLayout;
use Slym758\FilaCraft\Pages\Themes;

class FilaCraftPlugin implements Plugin
{
    protected array $customTokens = [];

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }

    public function getId(): string
    {
        return 'filacraft';
    }

    /**
     * Override FilaCraft design tokens (--fc-*) via PHP.
     *
     * @param  array<string, string>  $tokens  e.g. ['surface' => '#faf9f6', 'border' => 'rgb(60 56 48 / 0.1)']
     */
    public function customize(array $tokens): static
    {
        $this->customTokens = $tokens;

        return $this;
    }

    public function register(Panel $panel): void
    {
        $panel->font('Kumbh Sans');

        $panel->authMiddleware([
            ApplyThemeLayout::class,
        ]);

        $panel->pages([
            Themes::class,
        ]);

        $panel->userMenuItems([
            MenuItem::make()
                ->label('Themes')
                ->icon(Heroicon::OutlinedPaintBrush)
                ->url(fn () => Themes::getUrl())
                ->sort(-1),
        ]);

        $panel->renderHook(
            PanelsRenderHook::HEAD_END,
            fn () => Blade::render('
                <script>
                    (function() {
                        var theme = localStorage.getItem("filacraft-theme");
                        var migrations = {"brisk":"ege","nord":"kutup","sunset":"gunbatimi","ege":"ege"};
                        if (theme && migrations[theme] && migrations[theme] !== theme) { theme = migrations[theme]; localStorage.setItem("filacraft-theme", theme); }
                        var presetThemes = ["akdeniz", "kutup", "gunbatimi", "atlas", "safir"];
                        if (theme && presetThemes.indexOf(theme) !== -1) {
                            document.documentElement.classList.add("filacraft-" + theme);
                        }

                        var palettes = {
                            turquoise:{ 50:"oklch(0.977 0.014 191.96)", 100:"oklch(0.950 0.033 191.96)", 200:"oklch(0.905 0.063 191.96)", 300:"oklch(0.840 0.106 191.96)", 400:"oklch(0.754 0.150 191.96)", 500:"oklch(0.683 0.170 191.96)", 600:"oklch(0.598 0.169 191.96)", 700:"oklch(0.515 0.149 191.96)", 800:"oklch(0.446 0.123 191.96)", 900:"oklch(0.395 0.100 191.96)", 950:"oklch(0.278 0.071 191.96)" },
                            ocean:    { 50:"oklch(0.977 0.014 259.82)", 100:"oklch(0.950 0.033 259.82)", 200:"oklch(0.905 0.063 259.82)", 300:"oklch(0.840 0.106 259.82)", 400:"oklch(0.754 0.150 259.82)", 500:"oklch(0.683 0.170 259.82)", 600:"oklch(0.598 0.169 259.82)", 700:"oklch(0.515 0.149 259.82)", 800:"oklch(0.446 0.123 259.82)", 900:"oklch(0.395 0.100 259.82)", 950:"oklch(0.278 0.071 259.82)" },
                            emerald:  { 50:"oklch(0.977 0.014 162.48)", 100:"oklch(0.950 0.033 162.48)", 200:"oklch(0.905 0.063 162.48)", 300:"oklch(0.840 0.106 162.48)", 400:"oklch(0.754 0.150 162.48)", 500:"oklch(0.683 0.170 162.48)", 600:"oklch(0.598 0.169 162.48)", 700:"oklch(0.515 0.149 162.48)", 800:"oklch(0.446 0.123 162.48)", 900:"oklch(0.395 0.100 162.48)", 950:"oklch(0.278 0.071 162.48)" },
                            violet:   { 50:"oklch(0.977 0.014 292.72)", 100:"oklch(0.950 0.033 292.72)", 200:"oklch(0.905 0.063 292.72)", 300:"oklch(0.840 0.106 292.72)", 400:"oklch(0.754 0.150 292.72)", 500:"oklch(0.683 0.170 292.72)", 600:"oklch(0.598 0.169 292.72)", 700:"oklch(0.515 0.149 292.72)", 800:"oklch(0.446 0.123 292.72)", 900:"oklch(0.395 0.100 292.72)", 950:"oklch(0.278 0.071 292.72)" },
                            rose:     { 50:"oklch(0.977 0.014 16.44)", 100:"oklch(0.950 0.033 16.44)", 200:"oklch(0.905 0.063 16.44)", 300:"oklch(0.840 0.106 16.44)", 400:"oklch(0.754 0.150 16.44)", 500:"oklch(0.683 0.170 16.44)", 600:"oklch(0.598 0.169 16.44)", 700:"oklch(0.515 0.149 16.44)", 800:"oklch(0.446 0.123 16.44)", 900:"oklch(0.395 0.100 16.44)", 950:"oklch(0.278 0.071 16.44)" },
                            amber:    { 50:"oklch(0.977 0.014 70.08)", 100:"oklch(0.950 0.033 70.08)", 200:"oklch(0.905 0.063 70.08)", 300:"oklch(0.840 0.106 70.08)", 400:"oklch(0.754 0.150 70.08)", 500:"oklch(0.683 0.170 70.08)", 600:"oklch(0.598 0.169 70.08)", 700:"oklch(0.515 0.149 70.08)", 800:"oklch(0.446 0.123 70.08)", 900:"oklch(0.395 0.100 70.08)", 950:"oklch(0.278 0.071 70.08)" },
                            indigo:   { 50:"oklch(0.977 0.014 277.12)", 100:"oklch(0.950 0.033 277.12)", 200:"oklch(0.905 0.063 277.12)", 300:"oklch(0.840 0.106 277.12)", 400:"oklch(0.754 0.150 277.12)", 500:"oklch(0.683 0.170 277.12)", 600:"oklch(0.598 0.169 277.12)", 700:"oklch(0.515 0.149 277.12)", 800:"oklch(0.446 0.123 277.12)", 900:"oklch(0.395 0.100 277.12)", 950:"oklch(0.278 0.071 277.12)" },
                            slate:    { 50:"oklch(0.977 0.014 257.42)", 100:"oklch(0.950 0.033 257.42)", 200:"oklch(0.905 0.063 257.42)", 300:"oklch(0.840 0.106 257.42)", 400:"oklch(0.754 0.150 257.42)", 500:"oklch(0.683 0.170 257.42)", 600:"oklch(0.598 0.169 257.42)", 700:"oklch(0.515 0.149 257.42)", 800:"oklch(0.446 0.123 257.42)", 900:"oklch(0.395 0.100 257.42)", 950:"oklch(0.278 0.071 257.42)" },
                            cyan:     { 50:"oklch(0.977 0.014 205.00)", 100:"oklch(0.950 0.033 205.00)", 200:"oklch(0.905 0.063 205.00)", 300:"oklch(0.840 0.106 205.00)", 400:"oklch(0.754 0.150 205.00)", 500:"oklch(0.683 0.170 205.00)", 600:"oklch(0.598 0.169 205.00)", 700:"oklch(0.515 0.149 205.00)", 800:"oklch(0.446 0.123 205.00)", 900:"oklch(0.395 0.100 205.00)", 950:"oklch(0.278 0.071 205.00)" },
                            fuchsia:  { 50:"oklch(0.977 0.014 330.00)", 100:"oklch(0.950 0.033 330.00)", 200:"oklch(0.905 0.063 330.00)", 300:"oklch(0.840 0.106 330.00)", 400:"oklch(0.754 0.150 330.00)", 500:"oklch(0.683 0.170 330.00)", 600:"oklch(0.598 0.169 330.00)", 700:"oklch(0.515 0.149 330.00)", 800:"oklch(0.446 0.123 330.00)", 900:"oklch(0.395 0.100 330.00)", 950:"oklch(0.278 0.071 330.00)" },
                            red:      { 50:"oklch(0.977 0.014 25.00)", 100:"oklch(0.950 0.033 25.00)", 200:"oklch(0.905 0.063 25.00)", 300:"oklch(0.840 0.106 25.00)", 400:"oklch(0.754 0.150 25.00)", 500:"oklch(0.683 0.170 25.00)", 600:"oklch(0.598 0.169 25.00)", 700:"oklch(0.515 0.149 25.00)", 800:"oklch(0.446 0.123 25.00)", 900:"oklch(0.395 0.100 25.00)", 950:"oklch(0.278 0.071 25.00)" },
                            lime:     { 50:"oklch(0.977 0.014 131.00)", 100:"oklch(0.950 0.033 131.00)", 200:"oklch(0.905 0.063 131.00)", 300:"oklch(0.840 0.106 131.00)", 400:"oklch(0.754 0.150 131.00)", 500:"oklch(0.683 0.170 131.00)", 600:"oklch(0.598 0.169 131.00)", 700:"oklch(0.515 0.149 131.00)", 800:"oklch(0.446 0.123 131.00)", 900:"oklch(0.395 0.100 131.00)", 950:"oklch(0.278 0.071 131.00)" },
                            sky:      { 50:"oklch(0.977 0.014 230.00)", 100:"oklch(0.950 0.033 230.00)", 200:"oklch(0.905 0.063 230.00)", 300:"oklch(0.840 0.106 230.00)", 400:"oklch(0.754 0.150 230.00)", 500:"oklch(0.683 0.170 230.00)", 600:"oklch(0.598 0.169 230.00)", 700:"oklch(0.515 0.149 230.00)", 800:"oklch(0.446 0.123 230.00)", 900:"oklch(0.395 0.100 230.00)", 950:"oklch(0.278 0.071 230.00)" },
                        };

                        var colorId = localStorage.getItem("filacraft-color");
                        if (colorId && colorId !== "default" && palettes[colorId]) {
                            var shades = palettes[colorId];
                            var root = document.documentElement;
                            for (var shade in shades) {
                                root.style.setProperty("--primary-" + shade, shades[shade]);
                            }
                        }

                        /* Font */
                        var font = localStorage.getItem("filacraft-font");
                        if (font && font !== "default") {
                            var link = document.createElement("link");
                            link.rel = "stylesheet";
                            link.href = "https://fonts.googleapis.com/css2?family=" + font.replace(/\+/g, "+") + ":wght@300;400;500;600;700&display=swap";
                            document.head.appendChild(link);
                            var fontName = font.replace(/\+/g, " ");
                            document.documentElement.style.setProperty("--font-family", fontName + ", sans-serif");
                        }

                        /* Border Radius */
                        var radius = localStorage.getItem("filacraft-radius");
                        if (radius) {
                            document.documentElement.setAttribute("data-radius", radius);
                        }

                        /* Compact Mode */
                        var density = localStorage.getItem("filacraft-density");
                        if (density && density !== "default") {
                            document.documentElement.setAttribute("data-density", density);
                        }

                        /* Decorations */
                        var decorations = localStorage.getItem("filacraft-decorations");
                        if (decorations === "on") {
                            document.documentElement.setAttribute("data-decorations", "on");
                        }

                        /* Table Style */
                        var tableStyle = localStorage.getItem("filacraft-table-style");
                        if (tableStyle && tableStyle !== "default") {
                            document.documentElement.setAttribute("data-table-style", tableStyle);
                        }

                        /* Topbar variant */
                        var topbar = localStorage.getItem("filacraft-topbar");
                        if (topbar && topbar !== "default") {
                            document.documentElement.setAttribute("data-topbar", topbar);
                        }

                        /* Sync from DB if localStorage is empty */
                        if (!localStorage.getItem("filacraft-theme")) {
                            fetch("/api/theme-settings", { headers: { "Accept": "application/json" } })
                                .then(function(r) { return r.ok ? r.json() : null; })
                                .then(function(s) {
                                    if (!s || !s.theme) return;
                                    if (s.theme) localStorage.setItem("filacraft-theme", s.theme);
                                    if (s.color) localStorage.setItem("filacraft-color", s.color);
                                    if (s.font) localStorage.setItem("filacraft-font", s.font);
                                    if (s.radius) localStorage.setItem("filacraft-radius", s.radius);
                                    if (s.density) localStorage.setItem("filacraft-density", s.density);
                                    if (s.decorations) localStorage.setItem("filacraft-decorations", s.decorations);
                                    if (s.tableStyle) localStorage.setItem("filacraft-table-style", s.tableStyle);
                                    if (s.lang) localStorage.setItem("filacraft-lang", s.lang);
                                    if (s.errorStyle) document.cookie = "filacraft-error-style=" + s.errorStyle + ";path=/;max-age=31536000";
                                    location.reload();
                                })
                                .catch(function() {});
                        }
                    })();
                </script>
            '),
        );
    }

    public function boot(Panel $panel): void
    {
        if ($this->customTokens !== []) {
            $css = ':root{';
            foreach ($this->customTokens as $key => $value) {
                $css .= '--fc-'.$key.':'.$value.';';
            }
            $css .= '}';

            $panel->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => '<style id="filacraft-custom-tokens">'.$css.'</style>',
            );
        }
    }
}
