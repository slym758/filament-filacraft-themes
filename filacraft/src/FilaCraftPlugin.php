<?php

namespace Slym758\FilaCraft;

use Filament\Contracts\Plugin;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsRenderHook;
use Slym758\FilaCraft\Http\Middleware\ApplyThemeLayout;
use Slym758\FilaCraft\Models\UserThemeSetting;
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
            function (): string {
                $user = auth()->user();
                $settings = $user ? UserThemeSetting::settingsForUser($user->getKey()) : [];
                $serverSettings = json_encode(
                    (object) $settings,
                    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES,
                );
                $userId = $user ? json_encode((string) $user->getKey()) : 'null';

                return <<<HTML
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <script>
                    (function() {
                        /* Sunucudan gelen kayitli tema ayarlari — localStorage bos ise fallback.
                           Boylece ilk yuklemede fetch + location.reload() gerekmez (flash/cift yukleme yok). */
                        var S = {$serverSettings};
                        var UID = {$userId};
                        var root = document.documentElement;

                        /* Kullanici bazli izolasyon: localStorage tarayici bazlidir, kullanici bazli
                           degil. Bu tarayicidaki ayarlar baska bir kullaniciya aitse temizle ki her
                           kullanici KENDI kayitli temasini gorsun (aksi halde ayni tarayicida ikinci
                           kullanici birincinin temasini gorur). */
                        var THEME_KEYS = ["theme", "color", "font", "radius", "density", "decorations", "table-style", "topbar", "lang"];
                        if (UID !== null && localStorage.getItem("filacraft-uid") !== UID) {
                            THEME_KEYS.forEach(function (k) { localStorage.removeItem("filacraft-" + k); });
                            root.style.removeProperty("--font-family");
                            localStorage.setItem("filacraft-uid", UID);
                        }

                        function pref(lsKey, dbKey) {
                            var v = localStorage.getItem("filacraft-" + lsKey);
                            if (v === null && dbKey && S[dbKey] !== undefined && S[dbKey] !== null && S[dbKey] !== "") {
                                v = String(S[dbKey]);
                                localStorage.setItem("filacraft-" + lsKey, v);
                            }
                            return v;
                        }

                        var theme = pref("theme", "theme");
                        var migrations = {"brisk":"ege","nord":"ege","kutup":"ege","sunset":"gunbatimi","ege":"ege"};
                        if (theme && migrations[theme] && migrations[theme] !== theme) { theme = migrations[theme]; localStorage.setItem("filacraft-theme", theme); }
                        var presetThemes = ["akdeniz", "gunbatimi", "atlas", "safir"];
                        if (theme && presetThemes.indexOf(theme) !== -1) {
                            root.classList.add("filacraft-" + theme);
                        }

                        /* Renk paleti: hue + ton varyanti (soft/std/vivid/deep) uzerinden uretilir.
                           Kayitli id ornekleri: "turquoise" (standart) veya "turquoise-vivid".
                           Blade Themes sayfasindaki uretici ile birebir ayni degerleri verir. */
                        var COLOR_HUES = { turquoise:"191.96", ocean:"259.82", emerald:"162.48", violet:"292.72", rose:"16.44", amber:"70.08", indigo:"277.12", slate:"257.42", cyan:"205.00", fuchsia:"330.00", red:"25.00", lime:"131.00", sky:"230.00" };
                        var COLOR_TONES = { soft:{c:0.60,lo:0.04}, std:{c:1.00,lo:0.00}, vivid:{c:1.15,lo:0.12}, deep:{c:1.10,lo:-0.08} };
                        var COLOR_BL = [0.977,0.950,0.905,0.840,0.754,0.683,0.598,0.515,0.446,0.395,0.278];
                        var COLOR_BC = [0.014,0.033,0.063,0.106,0.150,0.170,0.169,0.149,0.123,0.100,0.071];
                        var COLOR_LW = [0.0,0.2,0.45,0.7,0.9,1.0,1.0,0.92,0.8,0.65,0.5];
                        var COLOR_SK = ["50","100","200","300","400","500","600","700","800","900","950"];

                        var colorId = pref("color", "color");
                        if (colorId && colorId !== "default") {
                            var cBase = colorId, cTone = "std";
                            var cIdx = colorId.lastIndexOf("-");
                            if (cIdx > -1) { var tk = colorId.slice(cIdx + 1); if (COLOR_TONES[tk]) { cTone = tk; cBase = colorId.slice(0, cIdx); } }
                            var cHue = COLOR_HUES[cBase];
                            if (cHue) {
                                var tm = COLOR_TONES[cTone];
                                for (var ci = 0; ci < COLOR_SK.length; ci++) {
                                    var cL = Math.max(0, Math.min(0.995, COLOR_BL[ci] + tm.lo * COLOR_LW[ci]));
                                    var cC = COLOR_BC[ci] * tm.c;
                                    root.style.setProperty("--primary-" + COLOR_SK[ci], "oklch(" + cL.toFixed(3) + " " + cC.toFixed(3) + " " + cHue + ")");
                                }
                            }
                        }

                        /* Font */
                        var font = pref("font", "font");
                        if (font && font !== "default") {
                            var link = document.createElement("link");
                            link.rel = "stylesheet";
                            link.href = "https://fonts.googleapis.com/css2?family=" + font.replace(/\+/g, "+") + ":wght@300;400;500;600;700&display=swap";
                            document.head.appendChild(link);
                            var fontName = font.replace(/\+/g, " ");
                            root.style.setProperty("--font-family", fontName + ", sans-serif");
                        }

                        /* Border Radius */
                        var radius = pref("radius", "radius");
                        if (radius) {
                            root.setAttribute("data-radius", radius);
                        }

                        /* Compact Mode */
                        var density = pref("density", "density");
                        if (density && density !== "default") {
                            root.setAttribute("data-density", density);
                        }

                        /* Decorations */
                        var decorations = pref("decorations", "decorations");
                        if (decorations === "on") {
                            root.setAttribute("data-decorations", "on");
                        }

                        /* Table Style */
                        var tableStyle = pref("table-style", "tableStyle");
                        if (tableStyle && tableStyle !== "default") {
                            root.setAttribute("data-table-style", tableStyle);
                        }

                        /* Topbar variant (yalnizca localStorage) */
                        var topbar = pref("topbar", null);
                        if (topbar && topbar !== "default") {
                            root.setAttribute("data-topbar", topbar);
                        }

                        /* Dil tercihi + hata sayfasi stili (localStorage bos ise sunucudan doldurulur) */
                        pref("lang", "lang");
                        if (S.errorStyle && !/(^|;\s*)filacraft-error-style=/.test(document.cookie)) {
                            document.cookie = "filacraft-error-style=" + S.errorStyle + ";path=/;max-age=31536000";
                        }
                    })();
                </script>
                HTML;
            },
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
