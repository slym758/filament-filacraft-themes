<x-filament-panels::page>
    {{-- Preload Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <div x-data="filacraftThemes()" class="space-y-8">

        {{-- Language Switcher --}}
        <div class="flex justify-end -mb-4">
            <div class="inline-flex items-center rounded-lg ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden text-xs font-medium">
                <button
                    x-on:click="setLang('tr')"
                    :class="lang === 'tr' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'"
                    class="px-3 py-1.5 transition-colors"
                >TR</button>
                <button
                    x-on:click="setLang('en')"
                    :class="lang === 'en' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-900 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800'"
                    class="px-3 py-1.5 transition-colors"
                >EN</button>
            </div>
        </div>

        {{-- Section: Theme Style --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.themeStyle"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4" x-text="t.themeStyleDesc"></p>

            <div class="space-y-6">
                {{-- Ege Esintisi --}}
                <div
                    :class="currentTheme === 'ege' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                    class="rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="t.egeTitle"></h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="t.egeDesc"></span>
                            <div x-show="currentTheme === 'ege'" x-transition class="h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <button
                            x-on:click="selectTheme('ege')"
                            :class="currentTheme === 'ege' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors"
                            x-text="currentTheme === 'ege' ? t.selected : t.select"
                        ></button>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="rounded-xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
                            <img src="{{ asset('vendor/filacraft/img/ege_esintisi.png') }}" alt="Ege Esintisi" class="w-full h-auto">
                        </div>
                    </div>
                </div>

                {{-- Akdeniz Ruhu --}}
                <div
                    :class="currentTheme === 'akdeniz' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                    class="rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="t.akdenizTitle"></h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="t.akdenizDesc"></span>
                            <div x-show="currentTheme === 'akdeniz'" x-transition class="h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <button
                            x-on:click="selectTheme('akdeniz')"
                            :class="currentTheme === 'akdeniz' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors"
                            x-text="currentTheme === 'akdeniz' ? t.selected : t.select"
                        ></button>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="rounded-xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
                            <img src="{{ asset('vendor/filacraft/img/akdeniz_ruhu.png') }}" alt="Akdeniz Ruhu" class="w-full h-auto">
                        </div>
                    </div>
                </div>

                {{-- Kutup Isigi --}}
                <div
                    :class="currentTheme === 'kutup' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                    class="rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="t.kutupTitle"></h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="t.kutupDesc"></span>
                            <div x-show="currentTheme === 'kutup'" x-transition class="h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <button
                            x-on:click="selectTheme('kutup')"
                            :class="currentTheme === 'kutup' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors"
                            x-text="currentTheme === 'kutup' ? t.selected : t.select"
                        ></button>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="rounded-xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
                            <img src="{{ asset('vendor/filacraft/img/kutup_isigi.png') }}" alt="Kutup Isigi" class="w-full h-auto">
                        </div>
                    </div>
                </div>

                {{-- Gun Batimi --}}
                <div
                    :class="currentTheme === 'gunbatimi' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                    class="rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="t.gunbatimiTitle"></h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="t.gunbatimiDesc"></span>
                            <div x-show="currentTheme === 'gunbatimi'" x-transition class="h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <button
                            x-on:click="selectTheme('gunbatimi')"
                            :class="currentTheme === 'gunbatimi' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors"
                            x-text="currentTheme === 'gunbatimi' ? t.selected : t.select"
                        ></button>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="rounded-xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
                            <img src="{{ asset('vendor/filacraft/img/gun_batimi.png') }}" alt="Gun Batimi" class="w-full h-auto">
                        </div>
                    </div>
                </div>

                {{-- Atlas --}}
                <div
                    :class="currentTheme === 'atlas' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                    class="rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="t.atlasTitle"></h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="t.atlasDesc"></span>
                            <div x-show="currentTheme === 'atlas'" x-transition class="h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <button
                            x-on:click="selectTheme('atlas')"
                            :class="currentTheme === 'atlas' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors"
                            x-text="currentTheme === 'atlas' ? t.selected : t.select"
                        ></button>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="rounded-xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
                            <img src="{{ asset('vendor/filacraft/img/atlas.png') }}" alt="Atlas" class="w-full h-auto">
                        </div>
                    </div>
                </div>

                {{-- Safir --}}
                <div
                    :class="currentTheme === 'safir' ? 'ring-2 ring-primary-500' : 'ring-1 ring-gray-200 dark:ring-gray-700'"
                    class="rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200"
                >
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="t.safirTitle"></h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400" x-text="t.safirDesc"></span>
                            <div x-show="currentTheme === 'safir'" x-transition class="h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <button
                            x-on:click="selectTheme('safir')"
                            :class="currentTheme === 'safir' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 ring-1 ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="px-4 py-1.5 rounded-lg text-sm font-medium transition-colors"
                            x-text="currentTheme === 'safir' ? t.selected : t.select"
                        ></button>
                    </div>
                    <div class="px-6 pb-6">
                        <div class="rounded-xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
                            <img src="{{ asset('vendor/filacraft/img/safir.png') }}" alt="Safir" class="w-full h-auto">
                        </div>
                    </div>
                </div>


            </div>
        </div>

        {{-- Section: Topbar Style (only for Safir) --}}
        <div x-show="currentTheme === 'safir'" x-transition>
            <div class="border-t border-gray-200 dark:border-gray-700 mb-8"></div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.topbarStyle"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.topbarStyleDesc"></p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Floating Island --}}
                <button
                    x-on:click="selectTopbar('default')"
                    :class="currentTopbar === 'default'
                        ? 'ring-2 ring-primary-500 bg-primary-50/50 dark:bg-primary-950/20'
                        : 'ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-gray-300 dark:hover:ring-gray-600'"
                    class="rounded-xl p-5 text-left transition-all duration-200"
                >
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-8 w-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <svg class="h-4 w-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a9 9 0 01-9 9m0 0a9 9 0 01-9-9" /></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white" x-text="t.topbarFloating"></h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="t.topbarFloatingDesc"></p>
                        </div>
                        <div x-show="currentTopbar === 'default'" x-transition class="ml-auto h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center shrink-0">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        </div>
                    </div>
                    <div class="h-12 rounded-lg bg-gray-100 dark:bg-gray-800 p-2 flex items-center gap-2">
                        <div class="h-full flex-1 rounded-md bg-white dark:bg-gray-700 shadow-sm ring-1 ring-gray-200/50 dark:ring-gray-600/50"></div>
                    </div>
                </button>

                {{-- Vault --}}
                <button
                    x-on:click="selectTopbar('vault')"
                    :class="currentTopbar === 'vault'
                        ? 'ring-2 ring-primary-500 bg-primary-50/50 dark:bg-primary-950/20'
                        : 'ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-gray-300 dark:hover:ring-gray-600'"
                    class="rounded-xl p-5 text-left transition-all duration-200"
                >
                    <div class="flex items-center gap-3 mb-2">
                        <div class="h-8 w-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <svg class="h-4 w-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white" x-text="t.topbarVault"></h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400" x-text="t.topbarVaultDesc"></p>
                        </div>
                        <div x-show="currentTopbar === 'vault'" x-transition class="ml-auto h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center shrink-0">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        </div>
                    </div>
                    <div class="h-12 rounded-lg bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        <div class="h-[calc(100%-2px)] bg-white dark:bg-gray-700"></div>
                        <div class="h-[2px]" style="background:linear-gradient(90deg, var(--primary-400, #60a5fa), var(--primary-600, #2563eb))"></div>
                    </div>
                </button>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Color Palette --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.colorPalette"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.colorPaletteDesc"></p>

            <div class="flex flex-wrap gap-5">
                <template x-for="(palette, key) in palettes" :key="key">
                    <button
                        x-on:click="selectColor(key)"
                        :title="palette.label"
                        class="group relative flex flex-col items-center gap-2.5"
                    >
                        <div
                            class="h-12 w-12 rounded-full transition-all duration-200 group-hover:scale-110 group-hover:shadow-lg"
                            :class="currentColor === key
                                ? 'ring-2 ring-offset-2 ring-offset-white dark:ring-offset-gray-900 scale-110 shadow-lg'
                                : 'ring-1 ring-black/10 dark:ring-white/10'"
                            :style="'background-color:' + palette.hex"
                        >
                            <div x-show="currentColor === key" x-transition class="h-full w-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                        </div>
                        <span
                            class="text-xs transition-colors duration-200"
                            :class="currentColor === key ? 'font-semibold text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400'"
                            x-text="t.paletteLabels[key]"
                        ></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Font Picker --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.fontPicker"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.fontPickerDesc"></p>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 max-w-4xl">
                <template x-for="(font, key) in fonts" :key="key">
                    <button
                        x-on:click="selectFont(key)"
                        :class="currentFont === key
                            ? 'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-950/30'
                            : 'ring-1 ring-gray-200 dark:ring-gray-700 bg-white dark:bg-gray-900 hover:ring-gray-300 dark:hover:ring-gray-600'"
                        class="relative rounded-xl p-4 text-center transition-all duration-200 hover:-translate-y-0.5"
                    >
                        <div class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Aa</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400" x-text="font.label"></div>
                        <div x-show="currentFont === key" x-transition class="absolute top-2 right-2 h-4 w-4 rounded-full bg-primary-500 text-white flex items-center justify-center">
                            <svg class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        </div>
                    </button>
                </template>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Border Radius --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.borderRadius"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.borderRadiusDesc"></p>

            <div class="flex flex-wrap gap-4 max-w-2xl">
                <template x-for="(opt, key) in radiusOptions" :key="key">
                    <button
                        x-on:click="selectRadius(key)"
                        :class="currentRadius === key
                            ? 'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-950/30'
                            : 'ring-1 ring-gray-200 dark:ring-gray-700 bg-white dark:bg-gray-900 hover:ring-gray-300 dark:hover:ring-gray-600'"
                        class="relative flex flex-col items-center gap-3 rounded-xl p-5 w-28 transition-all duration-200 hover:-translate-y-0.5"
                    >
                        <div class="flex gap-1.5">
                            <div class="h-6 w-6 bg-primary-400" :style="opt.style1"></div>
                            <div class="h-6 w-10 bg-primary-300" :style="opt.style2"></div>
                        </div>
                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300" x-text="t.radiusLabels[key]"></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Table Style --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.tableStyle"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.tableStyleDesc"></p>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 max-w-4xl">
                <template x-for="(opt, key) in tableStyleOptions" :key="key">
                    <button
                        x-on:click="selectTableStyle(key)"
                        :class="currentTableStyle === key
                            ? 'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-950/30'
                            : 'ring-1 ring-gray-200 dark:ring-gray-700 bg-white dark:bg-gray-900 hover:ring-gray-300 dark:hover:ring-gray-600'"
                        class="relative rounded-xl p-4 text-left transition-all duration-200 hover:-translate-y-0.5"
                    >
                        {{-- Mini table preview --}}
                        <div class="mb-3 rounded-lg overflow-hidden" :style="opt.containerStyle">
                            {{-- Header --}}
                            <div class="flex gap-px" :style="opt.headerStyle">
                                <div class="h-2 flex-1 rounded-sm" :style="opt.headerCellStyle"></div>
                                <div class="h-2 flex-1 rounded-sm" :style="opt.headerCellStyle"></div>
                                <div class="h-2 flex-[0.6] rounded-sm" :style="opt.headerCellStyle"></div>
                            </div>
                            {{-- Rows --}}
                            <template x-for="(row, ri) in opt.rows" :key="ri">
                                <div class="flex gap-px mt-px" :style="row.style">
                                    <div class="h-2 flex-1 rounded-sm" :style="row.cellStyle"></div>
                                    <div class="h-2 flex-1 rounded-sm" :style="row.cellStyle"></div>
                                    <div class="h-2 flex-[0.6] rounded-sm" :style="row.cellStyle"></div>
                                </div>
                            </template>
                        </div>
                        <div class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center" x-text="t.tableStyleLabels[key]"></div>
                        <div x-show="currentTableStyle === key" x-transition class="absolute top-2 right-2 h-4 w-4 rounded-full bg-primary-500 text-white flex items-center justify-center">
                            <svg class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                        </div>
                    </button>
                </template>
            </div>

            {{-- Live Preview Table --}}
            <div class="mt-6">
                <p class="text-xs font-medium text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-3" x-text="t.tablePreviewTitle"></p>
                <div :data-table-style="currentTableStyle === 'default' ? null : currentTableStyle">
                    <div class="fi-ta">
                        <div class="fi-ta-ctn rounded-lg overflow-hidden">
                            {{-- Toolbar --}}
                            <div class="fi-ta-header-toolbar flex items-center justify-between px-4 py-2.5">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-48 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center px-3">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                        <span class="ml-2 text-xs text-gray-400" x-text="t.tablePreviewSearch"></span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-8 px-3 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" /></svg>
                                        <span class="ml-1.5 text-xs text-gray-500 dark:text-gray-400" x-text="t.tablePreviewFilter"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Table --}}
                            <div class="overflow-x-auto">
                                <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 dark:divide-white/5 text-start">
                                    <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                        <tr class="bg-gray-50 dark:bg-white/5">
                                            <th class="fi-ta-header-cell px-4 py-2.5 text-start text-sm font-semibold text-gray-950 dark:text-white" x-text="t.tablePreviewCols[0]"></th>
                                            <th class="fi-ta-header-cell px-4 py-2.5 text-start text-sm font-semibold text-gray-950 dark:text-white" x-text="t.tablePreviewCols[1]"></th>
                                            <th class="fi-ta-header-cell px-4 py-2.5 text-start text-sm font-semibold text-gray-950 dark:text-white" x-text="t.tablePreviewCols[2]"></th>
                                            <th class="fi-ta-header-cell px-4 py-2.5 text-start text-sm font-semibold text-gray-950 dark:text-white" x-text="t.tablePreviewCols[3]"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-white/5 whitespace-nowrap">
                                        <template x-for="(row, idx) in tablePreviewRows" :key="idx">
                                            <tr class="fi-ta-row transition-colors"
                                                :class="tablePreviewSelected === idx ? 'fi-selected' : ''"
                                                x-on:click="tablePreviewSelected = (tablePreviewSelected === idx ? null : idx)"
                                                style="cursor:pointer"
                                            >
                                                <td class="fi-ta-cell px-4 py-2.5 text-sm text-gray-700 dark:text-gray-300">
                                                    <div class="flex items-center gap-2.5">
                                                        <div class="h-7 w-7 rounded-full flex items-center justify-center text-[10px] font-bold text-white shrink-0" :style="'background:' + row.avatar">
                                                            <span x-text="row.name.charAt(0)"></span>
                                                        </div>
                                                        <span class="font-medium text-gray-950 dark:text-white" x-text="row.name"></span>
                                                    </div>
                                                </td>
                                                <td class="fi-ta-cell px-4 py-2.5 text-sm text-gray-500 dark:text-gray-400" x-text="row.email"></td>
                                                <td class="fi-ta-cell px-4 py-2.5 text-sm">
                                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium" :class="row.badgeClass" x-text="t.tablePreviewRoles[row.role] || row.role"></span>
                                                </td>
                                                <td class="fi-ta-cell px-4 py-2.5 text-sm text-gray-500 dark:text-gray-400" x-text="row.date"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="fi-pagination-ctn flex items-center justify-between px-4 py-2.5">
                                <p class="text-xs text-gray-500 dark:text-gray-400" x-text="t.tablePreviewShowing"></p>
                                <div class="flex items-center gap-1">
                                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-md text-xs bg-gray-100 dark:bg-gray-800 text-gray-400 cursor-not-allowed">&lsaquo;</span>
                                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-md text-xs font-semibold bg-primary-500 text-white">1</span>
                                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-md text-xs text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer">2</span>
                                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-md text-xs text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer">3</span>
                                    <span class="inline-flex items-center justify-center h-7 w-7 rounded-md text-xs text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 cursor-pointer">&rsaquo;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 dark:text-gray-600 mt-2" x-text="t.tablePreviewHint"></p>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Density --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.density"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.densityDesc"></p>

            <div class="flex flex-wrap gap-4 max-w-2xl">
                <template x-for="(opt, key) in densityOptions" :key="key">
                    <button
                        x-on:click="selectDensity(key)"
                        :class="currentDensity === key
                            ? 'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-950/30'
                            : 'ring-1 ring-gray-200 dark:ring-gray-700 bg-white dark:bg-gray-900 hover:ring-gray-300 dark:hover:ring-gray-600'"
                        class="relative flex flex-col items-center gap-2 rounded-xl p-5 w-36 transition-all duration-200 hover:-translate-y-0.5"
                    >
                        <div class="w-full flex flex-col" :class="opt.gap">
                            <div class="h-1.5 w-full rounded-full bg-primary-300"></div>
                            <div class="h-1.5 w-3/4 rounded-full bg-primary-200"></div>
                            <div class="h-1.5 w-5/6 rounded-full bg-primary-300"></div>
                        </div>
                        <div class="mt-1">
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300 block" x-text="t.densityLabels[key]"></span>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500 block" x-text="t.densityDescs[key]"></span>
                        </div>
                    </button>
                </template>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Error Page Style --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.errorPageStyle"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.errorPageStyleDesc"></p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5 max-w-4xl">
                <template x-for="(opt, key) in errorStyles" :key="key">
                    <div
                        x-on:click="selectErrorStyle(key)"
                        :class="currentErrorStyle === key
                            ? 'ring-2 ring-primary-500'
                            : 'ring-1 ring-gray-200 dark:ring-gray-700 hover:ring-gray-300 dark:hover:ring-gray-600'"
                        class="group relative cursor-pointer rounded-2xl bg-white dark:bg-gray-900 overflow-hidden transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5"
                    >
                        <div class="aspect-[4/3] flex items-center justify-center p-6" :style="opt.bgStyle">
                            <div :style="opt.cardStyle" class="text-center w-full rounded-xl p-4">
                                <div class="text-3xl font-bold mb-1" :style="opt.numStyle">404</div>
                                <div class="text-[10px] opacity-60" :style="opt.textStyle" x-text="t.pageNotFound"></div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white text-sm" x-text="t.errorLabels[key]"></h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400" x-text="t.errorDescs[key]"></p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button
                                        x-on:click.stop="previewError(key)"
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        <span x-text="t.preview"></span>
                                    </button>
                                    <div x-show="currentErrorStyle === key" x-transition class="flex-shrink-0 h-5 w-5 rounded-full bg-primary-500 text-white flex items-center justify-center">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Error Preview Modal --}}
            <div x-show="errorPreviewUrl" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm" x-on:click.self="errorPreviewUrl = null" x-on:keydown.escape.window="errorPreviewUrl = null">
                <div class="relative w-full max-w-5xl mx-4" x-show="errorPreviewUrl" x-transition.scale.origin.center>
                    <button x-on:click="errorPreviewUrl = null" class="absolute -top-10 right-0 text-white/80 hover:text-white transition-colors flex items-center gap-1.5 text-sm">
                        <span x-text="t.close"></span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="rounded-2xl overflow-hidden shadow-2xl bg-white">
                        <div class="flex items-center gap-2 px-4 py-2 bg-gray-100 border-b border-gray-200">
                            <div class="flex gap-1.5">
                                <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                                <div class="h-3 w-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="flex-1 flex justify-center">
                                <div class="px-4 py-0.5 rounded-md bg-white text-xs text-gray-400 border border-gray-200" x-text="errorPreviewUrl"></div>
                            </div>
                            <div class="flex gap-2">
                                <template x-for="ec in ['404', '403', '500']" :key="ec">
                                    <button
                                        x-on:click="switchPreviewCode(ec)"
                                        :class="errorPreviewCode === ec ? 'bg-primary-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
                                        class="px-2.5 py-0.5 rounded-md text-xs font-medium border border-gray-200 transition-colors"
                                        x-text="ec"
                                    ></button>
                                </template>
                            </div>
                        </div>
                        <iframe :src="errorPreviewUrl" class="w-full h-[70vh] border-0"></iframe>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Decoration Effects --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.decorations"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.decorationsDesc"></p>

            <div class="flex items-center gap-4">
                <button
                    x-on:click="toggleDecorations()"
                    :class="currentDecorations === 'on'
                        ? 'bg-primary-500'
                        : 'bg-gray-300 dark:bg-gray-600'"
                    class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                >
                    <span
                        :class="currentDecorations === 'on' ? 'translate-x-5' : 'translate-x-0'"
                        class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out mt-0.5 ml-0.5"
                    ></span>
                </button>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300" x-text="currentDecorations === 'on' ? t.decorationsOn : t.decorationsOff"></span>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-gray-200 dark:border-gray-700"></div>

        {{-- Section: Reset --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.themeSettings"></h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.themeSettingsDesc"></p>

            <button
                x-on:click="resetSettings()"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-red-50 dark:bg-red-950/30 ring-1 ring-red-200 dark:ring-red-800 text-sm font-medium text-red-600 dark:text-red-400 hover:ring-red-300 dark:hover:ring-red-700 hover:-translate-y-0.5 transition-all duration-200"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182" /></svg>
                <span x-text="t.resetAll"></span>
            </button>
        </div>
    </div>

    <script>
        var filacraftTranslations = {
            tr: {
                themeStyle: 'Tema Stili',
                themeStyleDesc: 'Panelin genel gorunumunu secin',
                egeTitle: 'Ege Esintisi',
                egeDesc: 'Yumusak & yuvarlak pill stili',
                akdenizTitle: 'Akdeniz Ruhu',
                akdenizDesc: 'Pastel sidebar & navbar',
                kutupTitle: 'Kutup Işığı',
                kutupDesc: 'Ust navigasyon & buzul tonlari',
                gunbatimiTitle: 'Gün Batımı',
                gunbatimiDesc: 'Sicak tonlar & yumusak kenarlar',
                atlasTitle: 'Atlas',
                atlasDesc: 'Katmanli yuzeyler & rafine detaylar',
                safirTitle: 'Safir',
                safirDesc: 'Bankacilik estetiginde mavi tonlar',
                topbarStyle: 'Ust Bar Stili',
                topbarStyleDesc: 'Safir temasinda ust barin gorunumunu secin',
                topbarFloating: 'Floating Island',
                topbarFloatingDesc: 'Havada duran buzlu cam bar',
                topbarVault: 'Vault',
                topbarVaultDesc: 'Duz beyaz bar + gradient alt cizgi',
                colorPalette: 'Renk Paleti',
                colorPaletteDesc: 'Ana rengi secin — tum panel bu renge gore sekillenecek',
                fontPicker: 'Yazi Tipi',
                fontPickerDesc: 'Panel genelinde kullanilacak fontu secin',
                borderRadius: 'Kose Yuvarlaklik',
                borderRadiusDesc: 'Bilesenlerin kose yuvarlakligi',
                density: 'Yogunluk',
                densityDesc: 'Icerik araligi ve bosluk miktari',
                errorPageStyle: 'Hata Sayfasi Stili',
                errorPageStyleDesc: '404, 403, 500 hata sayfalarinin gorunumu',
                pageNotFound: 'Sayfa Bulunamadi',
                themeSettings: 'Tema Ayarlari',
                themeSettingsDesc: 'Tum ayarlari varsayilana dondur',
                resetAll: 'Tum Ayarlari Sifirla',
                resetConfirm: 'Tum tema ayarlarini sifirlamak istediginize emin misiniz?',
                preview: 'Goster',
                close: 'Kapat',
                select: 'Sec',
                selected: 'Secili',
                paletteLabels: {
                    'default': 'Varsayilan', 'turquoise': 'Turkuaz', 'ocean': 'Okyanus', 'emerald': 'Zumrut',
                    'violet': 'Mor', 'rose': 'Gul', 'amber': 'Amber', 'indigo': 'Indigo',
                    'slate': 'Celik', 'cyan': 'Cyan', 'fuchsia': 'Fusya', 'red': 'Kirmizi',
                    'lime': 'Yesil', 'sky': 'Gok'
                },
                radiusLabels: { 'sharp': 'Keskin', 'small': 'Hafif', 'default': 'Normal', 'large': 'Yuvarlak' },
                densityLabels: { 'compact': 'Sıkışık', 'default': 'Normal', 'comfortable': 'Ferah' },
                densityDescs: { 'compact': 'Daha az bosluk', 'default': 'Varsayilan aralik', 'comfortable': 'Daha fazla bosluk' },
                errorLabels: { 'default': 'Varsayilan', 'minimal': 'Minimal', 'illustrated': 'Illustrasyonlu', 'gradient': 'Gradient' },
                errorDescs: { 'default': 'Laravel varsayilani', 'minimal': 'Sade ve temiz', 'illustrated': 'Canli ve renkli', 'gradient': 'Modern ve etkileyici' },
                tableStyle: 'Tablo Stili',
                tableStyleDesc: 'Tablolar icin gorsel stil',
                tableStyleLabels: { 'default': 'Varsayilan', 'card': 'Kart', 'glass': 'Cam', 'accent': 'Vurgulu', 'flat': 'Duz' },
                tablePreviewTitle: 'Canli Onizleme',
                tablePreviewSearch: 'Ara...',
                tablePreviewFilter: 'Filtre',
                tablePreviewCols: ['Ad', 'E-posta', 'Rol', 'Kayit Tarihi'],
                tablePreviewShowing: '1-5 / 24 kayit',
                tablePreviewHint: 'Satira tiklayarak secim onizlemesi yapabilirsiniz',
                tablePreviewRoles: { admin: 'Yonetici', editor: 'Editör', user: 'Kullanici' },
                decorations: 'Dekorasyon Efektleri',
                decorationsDesc: 'Hover vurgulamalari, focus efektleri ve yukleme animasyonlari',
                decorationsOn: 'Acik',
                decorationsOff: 'Kapali',
            },
            en: {
                themeStyle: 'Theme Style',
                themeStyleDesc: 'Choose the overall look of the panel',
                egeTitle: 'Aegean Breeze',
                egeDesc: 'Soft & rounded pill style',
                akdenizTitle: 'Mediterranean Soul',
                akdenizDesc: 'Pastel sidebar & navbar',
                kutupTitle: 'Northern Light',
                kutupDesc: 'Top navigation & icy tones',
                gunbatimiTitle: 'Sunset Glow',
                gunbatimiDesc: 'Warm tones & soft edges',
                atlasTitle: 'Atlas',
                atlasDesc: 'Layered surfaces & refined details',
                safirTitle: 'Sapphire',
                safirDesc: 'Banking-grade blue tones & clarity',
                topbarStyle: 'Topbar Style',
                topbarStyleDesc: 'Choose the topbar appearance for Sapphire theme',
                topbarFloating: 'Floating Island',
                topbarFloatingDesc: 'Frosted glass floating bar',
                topbarVault: 'Vault',
                topbarVaultDesc: 'Solid white bar + gradient accent line',
                colorPalette: 'Color Palette',
                colorPaletteDesc: 'Pick a primary color — the entire panel adapts to it',
                fontPicker: 'Font',
                fontPickerDesc: 'Choose the font used across the panel',
                borderRadius: 'Border Radius',
                borderRadiusDesc: 'Corner roundness of components',
                density: 'Density',
                densityDesc: 'Content spacing and gap amount',
                errorPageStyle: 'Error Page Style',
                errorPageStyleDesc: 'Appearance of 404, 403, 500 error pages',
                pageNotFound: 'Page Not Found',
                themeSettings: 'Theme Settings',
                themeSettingsDesc: 'Reset all settings to defaults',
                resetAll: 'Reset All Settings',
                resetConfirm: 'Are you sure you want to reset all theme settings?',
                preview: 'Preview',
                close: 'Close',
                select: 'Select',
                selected: 'Selected',
                paletteLabels: {
                    'default': 'Default', 'turquoise': 'Turquoise', 'ocean': 'Ocean', 'emerald': 'Emerald',
                    'violet': 'Violet', 'rose': 'Rose', 'amber': 'Amber', 'indigo': 'Indigo',
                    'slate': 'Slate', 'cyan': 'Cyan', 'fuchsia': 'Fuchsia', 'red': 'Red',
                    'lime': 'Lime', 'sky': 'Sky'
                },
                radiusLabels: { 'sharp': 'Sharp', 'small': 'Slight', 'default': 'Normal', 'large': 'Rounded' },
                densityLabels: { 'compact': 'Compact', 'default': 'Normal', 'comfortable': 'Comfortable' },
                densityDescs: { 'compact': 'Less spacing', 'default': 'Default spacing', 'comfortable': 'More spacing' },
                errorLabels: { 'default': 'Default', 'minimal': 'Minimal', 'illustrated': 'Illustrated', 'gradient': 'Gradient' },
                errorDescs: { 'default': 'Laravel default', 'minimal': 'Clean and simple', 'illustrated': 'Vivid and colorful', 'gradient': 'Modern and striking' },
                tableStyle: 'Table Style',
                tableStyleDesc: 'Visual style for tables',
                tableStyleLabels: { 'default': 'Default', 'card': 'Card', 'glass': 'Glass', 'accent': 'Accent', 'flat': 'Flat' },
                tablePreviewTitle: 'Live Preview',
                tablePreviewSearch: 'Search...',
                tablePreviewFilter: 'Filter',
                tablePreviewCols: ['Name', 'Email', 'Role', 'Created'],
                tablePreviewShowing: '1-5 of 24 records',
                tablePreviewHint: 'Click a row to preview selection highlight',
                tablePreviewRoles: { admin: 'Admin', editor: 'Editor', user: 'User' },
                decorations: 'Decoration Effects',
                decorationsDesc: 'Hover highlights, focus effects, and loading animations',
                decorationsOn: 'On',
                decorationsOff: 'Off',
            }
        };

        function filacraftThemes() {
            return {
                lang: localStorage.getItem('filacraft-lang') || 'tr',

                get t() {
                    return filacraftTranslations[this.lang] || filacraftTranslations.tr;
                },

                setLang(l) {
                    this.lang = l;
                    localStorage.setItem('filacraft-lang', l);
                    this.saveToDb();
                },

                currentTheme: (() => { var t = localStorage.getItem('filacraft-theme'); var m = {'brisk':'ege','nord':'kutup','sunset':'gunbatimi'}; if (t && m[t]) { t = m[t]; localStorage.setItem('filacraft-theme', t); } return t || 'ege'; })(),
                currentColor: localStorage.getItem('filacraft-color') || 'default',
                currentFont: localStorage.getItem('filacraft-font') || 'default',
                currentRadius: localStorage.getItem('filacraft-radius') || 'default',
                currentDensity: localStorage.getItem('filacraft-density') || 'default',
                currentTopbar: localStorage.getItem('filacraft-topbar') || 'default',
                currentDecorations: localStorage.getItem('filacraft-decorations') || 'off',
                currentTableStyle: localStorage.getItem('filacraft-table-style') || 'default',
                currentErrorStyle: (() => {
                    var match = document.cookie.match(/filacraft-error-style=([^;]+)/);
                    return match ? match[1] : 'default';
                })(),

                fonts: {
                    'default':       { label: 'Kumbh Sans' },
                    'Inter':         { label: 'Inter' },
                    'Poppins':       { label: 'Poppins' },
                    'Nunito':        { label: 'Nunito' },
                    'Plus+Jakarta+Sans': { label: 'Jakarta Sans' },
                    'DM+Sans':       { label: 'DM Sans' },
                    'Outfit':        { label: 'Outfit' },
                    'Manrope':       { label: 'Manrope' },
                    'Space+Grotesk': { label: 'Space Grotesk' },
                    'Sora':          { label: 'Sora' },
                    'Lexend':        { label: 'Lexend' },
                },

                radiusOptions: {
                    'sharp':   { label: 'Keskin',   style1: 'border-radius:2px', style2: 'border-radius:2px' },
                    'small':   { label: 'Hafif',    style1: 'border-radius:4px', style2: 'border-radius:4px' },
                    'default': { label: 'Normal',   style1: 'border-radius:8px', style2: 'border-radius:8px' },
                    'large':   { label: 'Yuvarlak', style1: 'border-radius:50%', style2: 'border-radius:9999px' },
                },

                densityOptions: {
                    'compact':     { label: 'Sıkışık',  desc: 'Daha az bosluk',     gap: 'gap-0.5' },
                    'default':     { label: 'Normal',   desc: 'Varsayilan aralik',   gap: 'gap-1.5' },
                    'comfortable': { label: 'Ferah',    desc: 'Daha fazla bosluk',   gap: 'gap-3' },
                },

                tableStyleOptions: {
                    'default': {
                        containerStyle: 'padding:6px; height:60px; border:1px solid #e5e7eb; border-radius:8px; background:#fff',
                        headerStyle: 'padding:0 4px; margin-bottom:3px',
                        headerCellStyle: 'background:#f3f4f6; height:7px; border-radius:1px',
                        rows: [
                            { style: 'padding:0 4px; border-bottom:1px solid #f3f4f6', cellStyle: 'background:#fff; height:6px' },
                            { style: 'padding:0 4px; border-bottom:1px solid #f3f4f6', cellStyle: 'background:#fff; height:6px' },
                            { style: 'padding:0 4px', cellStyle: 'background:#fff; height:6px' },
                        ]
                    },
                    'card': {
                        containerStyle: 'padding:6px 4px; height:60px; background:transparent',
                        headerStyle: 'padding:0 4px; margin-bottom:4px',
                        headerCellStyle: 'background:transparent; height:5px; opacity:0.3; border-radius:1px',
                        rows: [
                            { style: 'padding:2px 2px; margin-bottom:3px', cellStyle: 'background:#fff; height:8px; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,0.1); border:1px solid #d1d5db' },
                            { style: 'padding:2px 2px; margin-bottom:3px', cellStyle: 'background:#fff; height:8px; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,0.1); border:1px solid #d1d5db' },
                            { style: 'padding:2px 2px', cellStyle: 'background:#fff; height:8px; border-radius:6px; box-shadow:0 1px 4px rgba(0,0,0,0.1); border:1px solid #d1d5db' },
                        ]
                    },
                    'glass': {
                        containerStyle: 'padding:6px; height:60px; border-radius:12px; background:rgba(255,255,255,0.55); border:1px solid rgba(255,255,255,0.6); box-shadow:0 4px 16px rgba(0,0,0,0.06),inset 0 1px 0 rgba(255,255,255,0.8); backdrop-filter:blur(8px)',
                        headerStyle: 'padding:0 4px; margin-bottom:3px; border-bottom:1px solid rgba(209,213,219,0.4)',
                        headerCellStyle: 'background:linear-gradient(135deg,rgba(249,250,251,0.8),rgba(243,244,246,0.4)); height:7px; border-radius:2px',
                        rows: [
                            { style: 'padding:0 4px; border-bottom:1px solid rgba(229,231,235,0.3)', cellStyle: 'background:rgba(255,255,255,0.35); height:6px; border-radius:1px' },
                            { style: 'padding:0 4px; border-bottom:1px solid rgba(229,231,235,0.3)', cellStyle: 'background:rgba(255,255,255,0.35); height:6px; border-radius:1px' },
                            { style: 'padding:0 4px', cellStyle: 'background:rgba(255,255,255,0.35); height:6px; border-radius:1px' },
                        ]
                    },
                    'accent': {
                        containerStyle: 'padding:6px; height:60px; border:1px solid #e5e7eb; border-radius:8px; background:#fff',
                        headerStyle: 'padding:0; margin-bottom:3px',
                        headerCellStyle: 'background:var(--primary-500,#6366f1); height:9px; border-radius:2px',
                        rows: [
                            { style: 'padding:0 4px; border-bottom:1px solid #f3f4f6; border-left:2px solid transparent', cellStyle: 'background:#fff; height:6px' },
                            { style: 'padding:0 4px; border-bottom:1px solid #f3f4f6; border-left:2px solid var(--primary-400,#818cf8)', cellStyle: 'background:color-mix(in oklab,var(--primary-500,#6366f1) 4%,#fff); height:6px' },
                            { style: 'padding:0 4px; border-left:2px solid transparent', cellStyle: 'background:#fff; height:6px' },
                        ]
                    },
                    'flat': {
                        containerStyle: 'padding:0; height:60px; border-radius:6px; background:#f3f4f6; overflow:hidden',
                        headerStyle: 'padding:0 4px; margin-bottom:0',
                        headerCellStyle: 'background:#1f2937; height:9px',
                        rows: [
                            { style: 'padding:0 4px', cellStyle: 'background:#f3f4f6; height:7px' },
                            { style: 'padding:0 4px', cellStyle: 'background:#e5e7eb; height:7px' },
                            { style: 'padding:0 4px', cellStyle: 'background:#f3f4f6; height:7px' },
                        ]
                    },
                },

                tablePreviewSelected: null,
                tablePreviewRows: [
                    { name: 'Ahmet Yilmaz', email: 'ahmet@example.com', role: 'admin', badgeClass: 'bg-primary-50 text-primary-700 ring-1 ring-primary-600/20 dark:bg-primary-400/10 dark:text-primary-400 dark:ring-primary-400/30', date: '12.03.2025', avatar: '#6366f1' },
                    { name: 'Elif Demir', email: 'elif@example.com', role: 'editor', badgeClass: 'bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 dark:bg-amber-400/10 dark:text-amber-400 dark:ring-amber-400/30', date: '08.01.2025', avatar: '#f59e0b' },
                    { name: 'Mehmet Kaya', email: 'mehmet@example.com', role: 'user', badgeClass: 'bg-gray-50 text-gray-700 ring-1 ring-gray-600/20 dark:bg-gray-400/10 dark:text-gray-400 dark:ring-gray-400/30', date: '21.11.2024', avatar: '#10b981' },
                    { name: 'Zeynep Arslan', email: 'zeynep@example.com', role: 'editor', badgeClass: 'bg-amber-50 text-amber-700 ring-1 ring-amber-600/20 dark:bg-amber-400/10 dark:text-amber-400 dark:ring-amber-400/30', date: '15.09.2024', avatar: '#ec4899' },
                    { name: 'Can Ozturk', email: 'can@example.com', role: 'admin', badgeClass: 'bg-primary-50 text-primary-700 ring-1 ring-primary-600/20 dark:bg-primary-400/10 dark:text-primary-400 dark:ring-primary-400/30', date: '03.07.2024', avatar: '#3b82f6' },
                ],

                errorStyles: {
                    'default': {
                        label: 'Varsayilan',
                        desc: 'Laravel / Filament varsayilani',
                        bgStyle: 'background:#f3f4f6',
                        cardStyle: '',
                        numStyle: 'color:#6b7280; font-size:3rem',
                        textStyle: 'color:#9ca3af'
                    },
                    'minimal': {
                        label: 'Minimal',
                        desc: 'Sade ve temiz',
                        bgStyle: 'background:#fff',
                        cardStyle: '',
                        numStyle: 'color:#e5e7eb; font-size:3rem',
                        textStyle: 'color:#9ca3af'
                    },
                    'illustrated': {
                        label: 'Illustrasyonlu',
                        desc: 'Canli ve renkli',
                        bgStyle: 'background:linear-gradient(135deg,#fff7ed,#fff,#fffbeb)',
                        cardStyle: '',
                        numStyle: 'color:#f97316; font-size:3rem',
                        textStyle: 'color:#6b7280'
                    },
                    'gradient': {
                        label: 'Gradient',
                        desc: 'Modern ve etkileyici',
                        bgStyle: 'background:linear-gradient(135deg,#1e1b4b,#4338ca,#818cf8)',
                        cardStyle: 'background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.15)',
                        numStyle: 'color:rgba(255,255,255,0.9); font-size:3rem',
                        textStyle: 'color:rgba(255,255,255,0.6)'
                    },
                },

                palettes: {
                    'default':   { label: 'Varsayilan', hex: '#d97234', shades: { '50':'oklch(0.977 0.014 48.67)', '100':'oklch(0.950 0.033 48.67)', '200':'oklch(0.905 0.063 48.67)', '300':'oklch(0.840 0.106 48.67)', '400':'oklch(0.754 0.150 48.67)', '500':'oklch(0.683 0.170 48.67)', '600':'oklch(0.598 0.169 48.67)', '700':'oklch(0.515 0.149 48.67)', '800':'oklch(0.446 0.123 48.67)', '900':'oklch(0.395 0.100 48.67)', '950':'oklch(0.278 0.071 48.67)' }},
                    'turquoise': { label: 'Turkuaz',    hex: '#1FB6B2', shades: { '50':'oklch(0.977 0.014 191.96)', '100':'oklch(0.950 0.033 191.96)', '200':'oklch(0.905 0.063 191.96)', '300':'oklch(0.840 0.106 191.96)', '400':'oklch(0.754 0.150 191.96)', '500':'oklch(0.683 0.170 191.96)', '600':'oklch(0.598 0.169 191.96)', '700':'oklch(0.515 0.149 191.96)', '800':'oklch(0.446 0.123 191.96)', '900':'oklch(0.395 0.100 191.96)', '950':'oklch(0.278 0.071 191.96)' }},
                    'ocean':     { label: 'Okyanus',    hex: '#3B82F6', shades: { '50':'oklch(0.977 0.014 259.82)', '100':'oklch(0.950 0.033 259.82)', '200':'oklch(0.905 0.063 259.82)', '300':'oklch(0.840 0.106 259.82)', '400':'oklch(0.754 0.150 259.82)', '500':'oklch(0.683 0.170 259.82)', '600':'oklch(0.598 0.169 259.82)', '700':'oklch(0.515 0.149 259.82)', '800':'oklch(0.446 0.123 259.82)', '900':'oklch(0.395 0.100 259.82)', '950':'oklch(0.278 0.071 259.82)' }},
                    'emerald':   { label: 'Zumrut',     hex: '#10B981', shades: { '50':'oklch(0.977 0.014 162.48)', '100':'oklch(0.950 0.033 162.48)', '200':'oklch(0.905 0.063 162.48)', '300':'oklch(0.840 0.106 162.48)', '400':'oklch(0.754 0.150 162.48)', '500':'oklch(0.683 0.170 162.48)', '600':'oklch(0.598 0.169 162.48)', '700':'oklch(0.515 0.149 162.48)', '800':'oklch(0.446 0.123 162.48)', '900':'oklch(0.395 0.100 162.48)', '950':'oklch(0.278 0.071 162.48)' }},
                    'violet':    { label: 'Mor',        hex: '#8B5CF6', shades: { '50':'oklch(0.977 0.014 292.72)', '100':'oklch(0.950 0.033 292.72)', '200':'oklch(0.905 0.063 292.72)', '300':'oklch(0.840 0.106 292.72)', '400':'oklch(0.754 0.150 292.72)', '500':'oklch(0.683 0.170 292.72)', '600':'oklch(0.598 0.169 292.72)', '700':'oklch(0.515 0.149 292.72)', '800':'oklch(0.446 0.123 292.72)', '900':'oklch(0.395 0.100 292.72)', '950':'oklch(0.278 0.071 292.72)' }},
                    'rose':      { label: 'Gul',        hex: '#F43F5E', shades: { '50':'oklch(0.977 0.014 16.44)', '100':'oklch(0.950 0.033 16.44)', '200':'oklch(0.905 0.063 16.44)', '300':'oklch(0.840 0.106 16.44)', '400':'oklch(0.754 0.150 16.44)', '500':'oklch(0.683 0.170 16.44)', '600':'oklch(0.598 0.169 16.44)', '700':'oklch(0.515 0.149 16.44)', '800':'oklch(0.446 0.123 16.44)', '900':'oklch(0.395 0.100 16.44)', '950':'oklch(0.278 0.071 16.44)' }},
                    'amber':     { label: 'Amber',      hex: '#F59E0B', shades: { '50':'oklch(0.977 0.014 70.08)', '100':'oklch(0.950 0.033 70.08)', '200':'oklch(0.905 0.063 70.08)', '300':'oklch(0.840 0.106 70.08)', '400':'oklch(0.754 0.150 70.08)', '500':'oklch(0.683 0.170 70.08)', '600':'oklch(0.598 0.169 70.08)', '700':'oklch(0.515 0.149 70.08)', '800':'oklch(0.446 0.123 70.08)', '900':'oklch(0.395 0.100 70.08)', '950':'oklch(0.278 0.071 70.08)' }},
                    'indigo':    { label: 'Indigo',     hex: '#6366F1', shades: { '50':'oklch(0.977 0.014 277.12)', '100':'oklch(0.950 0.033 277.12)', '200':'oklch(0.905 0.063 277.12)', '300':'oklch(0.840 0.106 277.12)', '400':'oklch(0.754 0.150 277.12)', '500':'oklch(0.683 0.170 277.12)', '600':'oklch(0.598 0.169 277.12)', '700':'oklch(0.515 0.149 277.12)', '800':'oklch(0.446 0.123 277.12)', '900':'oklch(0.395 0.100 277.12)', '950':'oklch(0.278 0.071 277.12)' }},
                    'slate':     { label: 'Celik',      hex: '#64748B', shades: { '50':'oklch(0.977 0.014 257.42)', '100':'oklch(0.950 0.033 257.42)', '200':'oklch(0.905 0.063 257.42)', '300':'oklch(0.840 0.106 257.42)', '400':'oklch(0.754 0.150 257.42)', '500':'oklch(0.683 0.170 257.42)', '600':'oklch(0.598 0.169 257.42)', '700':'oklch(0.515 0.149 257.42)', '800':'oklch(0.446 0.123 257.42)', '900':'oklch(0.395 0.100 257.42)', '950':'oklch(0.278 0.071 257.42)' }},
                    'cyan':      { label: 'Cyan',       hex: '#06B6D4', shades: { '50':'oklch(0.977 0.014 205.00)', '100':'oklch(0.950 0.033 205.00)', '200':'oklch(0.905 0.063 205.00)', '300':'oklch(0.840 0.106 205.00)', '400':'oklch(0.754 0.150 205.00)', '500':'oklch(0.683 0.170 205.00)', '600':'oklch(0.598 0.169 205.00)', '700':'oklch(0.515 0.149 205.00)', '800':'oklch(0.446 0.123 205.00)', '900':'oklch(0.395 0.100 205.00)', '950':'oklch(0.278 0.071 205.00)' }},
                    'fuchsia':   { label: 'Fusya',      hex: '#D946EF', shades: { '50':'oklch(0.977 0.014 330.00)', '100':'oklch(0.950 0.033 330.00)', '200':'oklch(0.905 0.063 330.00)', '300':'oklch(0.840 0.106 330.00)', '400':'oklch(0.754 0.150 330.00)', '500':'oklch(0.683 0.170 330.00)', '600':'oklch(0.598 0.169 330.00)', '700':'oklch(0.515 0.149 330.00)', '800':'oklch(0.446 0.123 330.00)', '900':'oklch(0.395 0.100 330.00)', '950':'oklch(0.278 0.071 330.00)' }},
                    'red':       { label: 'Kirmizi',    hex: '#EF4444', shades: { '50':'oklch(0.977 0.014 25.00)', '100':'oklch(0.950 0.033 25.00)', '200':'oklch(0.905 0.063 25.00)', '300':'oklch(0.840 0.106 25.00)', '400':'oklch(0.754 0.150 25.00)', '500':'oklch(0.683 0.170 25.00)', '600':'oklch(0.598 0.169 25.00)', '700':'oklch(0.515 0.149 25.00)', '800':'oklch(0.446 0.123 25.00)', '900':'oklch(0.395 0.100 25.00)', '950':'oklch(0.278 0.071 25.00)' }},
                    'lime':      { label: 'Yesil',      hex: '#84CC16', shades: { '50':'oklch(0.977 0.014 131.00)', '100':'oklch(0.950 0.033 131.00)', '200':'oklch(0.905 0.063 131.00)', '300':'oklch(0.840 0.106 131.00)', '400':'oklch(0.754 0.150 131.00)', '500':'oklch(0.683 0.170 131.00)', '600':'oklch(0.598 0.169 131.00)', '700':'oklch(0.515 0.149 131.00)', '800':'oklch(0.446 0.123 131.00)', '900':'oklch(0.395 0.100 131.00)', '950':'oklch(0.278 0.071 131.00)' }},
                    'sky':       { label: 'Gok',        hex: '#0EA5E9', shades: { '50':'oklch(0.977 0.014 230.00)', '100':'oklch(0.950 0.033 230.00)', '200':'oklch(0.905 0.063 230.00)', '300':'oklch(0.840 0.106 230.00)', '400':'oklch(0.754 0.150 230.00)', '500':'oklch(0.683 0.170 230.00)', '600':'oklch(0.598 0.169 230.00)', '700':'oklch(0.515 0.149 230.00)', '800':'oklch(0.446 0.123 230.00)', '900':'oklch(0.395 0.100 230.00)', '950':'oklch(0.278 0.071 230.00)' }},
                },

                selectTheme(id) {
                    var previousTheme = this.currentTheme;
                    this.currentTheme = id;
                    localStorage.setItem('filacraft-theme', id);
                    document.documentElement.classList.remove('filacraft-ege', 'filacraft-akdeniz', 'filacraft-kutup', 'filacraft-gunbatimi', 'filacraft-atlas', 'filacraft-safir');
                    if (id !== 'ege') {
                        document.documentElement.classList.add('filacraft-' + id);
                    }
                    var needsReload = (id === 'kutup' || previousTheme === 'kutup');
                    if (needsReload) {
                        this.saveToDbAndReload();
                    } else {
                        this.saveToDb();
                    }
                },

                selectColor(id) {
                    this.currentColor = id;
                    localStorage.setItem('filacraft-color', id);
                    this.applyColor(id);
                    this.saveToDb();
                },

                applyColor(id) {
                    var root = document.documentElement;
                    var shadeKeys = ['50','100','200','300','400','500','600','700','800','900','950'];
                    if (id === 'default') {
                        shadeKeys.forEach(function(s) { root.style.removeProperty('--primary-' + s); });
                        return;
                    }
                    var palette = this.palettes[id];
                    if (!palette) return;
                    Object.keys(palette.shades).forEach(function(shade) {
                        root.style.setProperty('--primary-' + shade, palette.shades[shade]);
                    });
                },

                selectFont(id) {
                    this.currentFont = id;
                    localStorage.setItem('filacraft-font', id);
                    if (id === 'default') {
                        document.documentElement.style.removeProperty('--font-family');
                        return;
                    }
                    var existing = document.querySelector('link[data-filacraft-font]');
                    if (existing) existing.remove();
                    var link = document.createElement('link');
                    link.rel = 'stylesheet';
                    link.setAttribute('data-filacraft-font', '');
                    link.href = 'https://fonts.googleapis.com/css2?family=' + id.replace(/\+/g, '+') + ':wght@300;400;500;600;700&display=swap';
                    document.head.appendChild(link);
                    var fontName = id.replace(/\+/g, ' ');
                    document.documentElement.style.setProperty('--font-family', fontName + ', sans-serif');
                    this.saveToDb();
                },

                selectTopbar(id) {
                    this.currentTopbar = id;
                    localStorage.setItem('filacraft-topbar', id);
                    if (id === 'default') {
                        document.documentElement.removeAttribute('data-topbar');
                    } else {
                        document.documentElement.setAttribute('data-topbar', id);
                    }
                    this.saveToDb();
                },

                selectRadius(id) {
                    this.currentRadius = id;
                    localStorage.setItem('filacraft-radius', id);
                    if (id === 'default') {
                        document.documentElement.removeAttribute('data-radius');
                    } else {
                        document.documentElement.setAttribute('data-radius', id);
                    }
                    this.saveToDb();
                },

                selectDensity(id) {
                    this.currentDensity = id;
                    localStorage.setItem('filacraft-density', id);
                    if (id === 'default') {
                        document.documentElement.removeAttribute('data-density');
                    } else {
                        document.documentElement.setAttribute('data-density', id);
                    }
                    this.saveToDb();
                },

                selectTableStyle(id) {
                    this.currentTableStyle = id;
                    localStorage.setItem('filacraft-table-style', id);
                    if (id === 'default') {
                        document.documentElement.removeAttribute('data-table-style');
                    } else {
                        document.documentElement.setAttribute('data-table-style', id);
                    }
                    this.saveToDb();
                },

                errorPreviewUrl: null,
                errorPreviewCode: '404',
                errorPreviewStyle: null,

                toggleDecorations() {
                    this.currentDecorations = this.currentDecorations === 'on' ? 'off' : 'on';
                    localStorage.setItem('filacraft-decorations', this.currentDecorations);
                    if (this.currentDecorations === 'on') {
                        document.documentElement.setAttribute('data-decorations', 'on');
                    } else {
                        document.documentElement.removeAttribute('data-decorations');
                    }
                    this.saveToDb();
                },

                selectErrorStyle(id) {
                    this.currentErrorStyle = id;
                    if (id === 'default') {
                        document.cookie = 'filacraft-error-style=;path=/;max-age=0';
                    } else {
                        document.cookie = 'filacraft-error-style=' + id + ';path=/;max-age=31536000';
                    }
                    this.saveToDb();
                },

                previewError(styleKey) {
                    this.errorPreviewStyle = styleKey;
                    this.errorPreviewCode = '404';
                    this.errorPreviewUrl = '/error-preview/404/' + styleKey;
                },

                switchPreviewCode(code) {
                    this.errorPreviewCode = code;
                    this.errorPreviewUrl = '/error-preview/' + code + '/' + this.errorPreviewStyle;
                },

                _saveTimer: null,

                saveToDb() {
                    var self = this;
                    clearTimeout(this._saveTimer);
                    this._saveTimer = setTimeout(function() {
                        self._doSave();
                    }, 500);
                },

                saveToDbAndReload() {
                    var self = this;
                    clearTimeout(this._saveTimer);
                    this._doSave().then(function() {
                        location.reload();
                    });
                },

                _doSave() {
                    var self = this;
                    var csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfToken) return Promise.resolve();
                    return fetch('/api/theme-settings', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            settings: {
                                theme: self.currentTheme,
                                color: self.currentColor,
                                font: self.currentFont,
                                radius: self.currentRadius,
                                density: self.currentDensity,
                                decorations: self.currentDecorations,
                                tableStyle: self.currentTableStyle,
                                errorStyle: self.currentErrorStyle,
                                lang: self.lang,
                            }
                        })
                    });
                },

                loadFromDb() {
                    var self = this;
                    fetch('/api/theme-settings', {
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(function(r) { return r.json(); })
                    .then(function(s) {
                        if (!s || !s.theme) return;
                        var changed = false;
                        if (s.theme && s.theme !== self.currentTheme) { self.selectTheme(s.theme); changed = true; }
                        if (s.color && s.color !== self.currentColor) { self.selectColor(s.color); changed = true; }
                        if (s.font && s.font !== self.currentFont) { self.selectFont(s.font); changed = true; }
                        if (s.radius && s.radius !== self.currentRadius) { self.selectRadius(s.radius); changed = true; }
                        if (s.density && s.density !== self.currentDensity) { self.selectDensity(s.density); changed = true; }
                        if (s.decorations && s.decorations !== self.currentDecorations) { self.currentDecorations = s.decorations; localStorage.setItem('filacraft-decorations', s.decorations); if (s.decorations === 'on') { document.documentElement.setAttribute('data-decorations', 'on'); } else { document.documentElement.removeAttribute('data-decorations'); } changed = true; }
                        if (s.tableStyle && s.tableStyle !== self.currentTableStyle) { self.selectTableStyle(s.tableStyle); changed = true; }
                        if (s.errorStyle && s.errorStyle !== self.currentErrorStyle) { self.selectErrorStyle(s.errorStyle); changed = true; }
                        if (s.lang && s.lang !== self.lang) { self.setLang(s.lang); changed = true; }
                    })
                    .catch(function() {});
                },

                resetSettings() {
                    if (!confirm(this.t.resetConfirm)) return;
                    localStorage.removeItem('filacraft-theme');
                    localStorage.removeItem('filacraft-color');
                    localStorage.removeItem('filacraft-font');
                    localStorage.removeItem('filacraft-radius');
                    localStorage.removeItem('filacraft-density');
                    localStorage.removeItem('filacraft-decorations');
                    localStorage.removeItem('filacraft-table-style');
                    localStorage.removeItem('filacraft-topbar');
                    localStorage.removeItem('filacraft-lang');
                    document.cookie = 'filacraft-error-style=;path=/;max-age=0';
                    var csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (csrfToken) {
                        fetch('/api/theme-settings', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                                'Accept': 'application/json',
                            }
                        });
                    }
                    location.reload();
                },

                init() {
                    if (this.currentColor && this.currentColor !== 'default') {
                        this.applyColor(this.currentColor);
                    }
                    if (this.currentFont && this.currentFont !== 'default') {
                        this.selectFont(this.currentFont);
                    }
                    if (this.currentRadius && this.currentRadius !== 'default') {
                        document.documentElement.setAttribute('data-radius', this.currentRadius);
                    }
                    if (this.currentDensity && this.currentDensity !== 'default') {
                        document.documentElement.setAttribute('data-density', this.currentDensity);
                    }
                    if (this.currentDecorations === 'on') {
                        document.documentElement.setAttribute('data-decorations', 'on');
                    }
                    if (this.currentTableStyle && this.currentTableStyle !== 'default') {
                        document.documentElement.setAttribute('data-table-style', this.currentTableStyle);
                    }
                    this.loadFromDb();
                }
            };
        }
    </script>
</x-filament-panels::page>
