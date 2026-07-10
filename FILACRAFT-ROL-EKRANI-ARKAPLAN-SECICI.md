# FilaCraft — Rol Seçme Ekranı Arka Plan Seçici (Ekleme Rehberi)

> Bu doküman, **FilaCraft tema paketine** (`slym758/filament-filacraft-theme`) "Rol Ekranı
> Arka Planı" ayarının nasıl ekleneceğini adım adım anlatır. Amaç: Themes (Tema) sayfasından
> kullanıcının rol-seçme ekranı için 4 arka plandan (+ düz varsayılan) birini seçebilmesi.
>
> Değişiklikler **paketin kendi kaynaklarında** yapılır; tüketici projede yalnız `npm run build`
> gerekir (app'in `theme.css`'i FilaCraft CSS'ini zaten `@import` eder).

## Seçenekler

| Değer | İsim | His |
|-------|------|-----|
| `default` | Düz | Mevcut davranış (preset `--primary-200` zemini) |
| `glow` | Işık Lekeleri | Köşelerde primary ışık lekeleri + diyagonal degrade |
| `mesh` | Mesh Gradient | Dört köşeden akan primary blob'ları; canlı |
| `aurora` | Aurora Bantları | Eğik, iç içe yumuşak renk bantları |
| `login` | Login Degradesi | Giriş ekranıyla birebir uyumlu degrade + köşe daireleri |

Renkler `--primary-*` değişkenlerinden türetilir → **her tema kendi tonunda** otomatik farklı görünür.
Seçiciler **yalnız rol-seçme ekranını** hedefler (`.fi-body:has(.astart-role-card-grid)`);
başka hiçbir sayfa etkilenmez.

---

## Mimari — mevcut `tableStyle` deseni

FilaCraft'ta bir ayar 5 katmandan geçer. `background` ayarı bu deseni birebir taklit eder:

1. **CSS** → `<html data-bg="...">` attribute'una göre kurallar
2. **Inline script** (`FilaCraftPlugin.php`) → tercihi okuyup `<html>`'e `data-bg` basar (açılışta, flash yok)
3. **Controller** → `settings.background` validasyonu; JSON `settings` kolonuna kaydeder
4. **Themes blade** → UI + Alpine state + seç/kaydet/yükle/sıfırla
5. Değer `localStorage` + DB'de tutulur

Attribute adı: **`data-bg`**.

---

## 1) CSS — yeni dosya

`resources/css/customization/role-background.css` oluştur:

```css
/* ══════════════════════════════════════════════════════════════
   Rol Seçme (role-switch) ekranı — seçilebilir arka planlar.
   <html data-bg="..."> attribute'una göre uygulanır (Themes sayfası).
   Yalnız rol-seçme ekranını hedefler; --primary-*'tan türer → her
   tema kendi tonunda. data-bg yoksa preset'in düz zemini kalır.
   ══════════════════════════════════════════════════════════════ */

/* 1 · Işık Lekeleri */
html[data-bg="glow"] .fi-body:has(.astart-role-card-grid) {
    background-color: var(--primary-50);
    background-image:
        radial-gradient(1200px 620px at 12% -12%, color-mix(in srgb, var(--primary-300) 45%, transparent), transparent 60%),
        radial-gradient(900px 520px at 105% 0%,  color-mix(in srgb, var(--primary-200) 55%, transparent), transparent 55%),
        radial-gradient(1000px 720px at 50% 118%, color-mix(in srgb, var(--primary-400) 30%, transparent), transparent 60%),
        linear-gradient(160deg, var(--primary-100) 0%, var(--primary-50) 45%, #fff 100%);
    background-attachment: fixed; background-repeat: no-repeat;
}
.dark html[data-bg="glow"] .fi-body:has(.astart-role-card-grid),
html.dark[data-bg="glow"] .fi-body:has(.astart-role-card-grid) {
    background-color: #0b1120;
    background-image:
        radial-gradient(1200px 620px at 12% -12%, color-mix(in srgb, var(--primary-500) 28%, transparent), transparent 60%),
        radial-gradient(900px 520px at 105% 0%,  color-mix(in srgb, var(--primary-700) 38%, transparent), transparent 55%),
        radial-gradient(1000px 720px at 50% 118%, color-mix(in srgb, var(--primary-600) 22%, transparent), transparent 60%),
        linear-gradient(160deg, #0d1526 0%, #0b1120 55%, #090d18 100%);
}

/* 2 · Mesh Gradient */
html[data-bg="mesh"] .fi-body:has(.astart-role-card-grid) {
    background-color: var(--primary-50);
    background-image:
        radial-gradient(45% 55% at 18% 22%, color-mix(in srgb, var(--primary-300) 75%, transparent), transparent 70%),
        radial-gradient(40% 50% at 82% 18%, color-mix(in srgb, var(--primary-400) 60%, transparent), transparent 70%),
        radial-gradient(50% 55% at 75% 85%, color-mix(in srgb, var(--primary-200) 85%, transparent), transparent 70%),
        radial-gradient(45% 50% at 20% 88%, color-mix(in srgb, var(--primary-500) 40%, transparent), transparent 72%);
    background-attachment: fixed; background-repeat: no-repeat;
}
.dark html[data-bg="mesh"] .fi-body:has(.astart-role-card-grid),
html.dark[data-bg="mesh"] .fi-body:has(.astart-role-card-grid) {
    background-color: #0b1120;
    background-image:
        radial-gradient(45% 55% at 18% 22%, color-mix(in srgb, var(--primary-600) 42%, transparent), transparent 70%),
        radial-gradient(40% 50% at 82% 18%, color-mix(in srgb, var(--primary-500) 34%, transparent), transparent 70%),
        radial-gradient(50% 55% at 75% 85%, color-mix(in srgb, var(--primary-700) 46%, transparent), transparent 70%),
        radial-gradient(45% 50% at 20% 88%, color-mix(in srgb, var(--primary-600) 30%, transparent), transparent 72%);
}

/* 3 · Aurora Bantları */
html[data-bg="aurora"] .fi-body:has(.astart-role-card-grid) {
    background-color: var(--primary-50);
    background-image:
        linear-gradient(115deg, color-mix(in srgb, var(--primary-200) 80%, transparent) 0%, transparent 42%),
        linear-gradient(245deg, color-mix(in srgb, var(--primary-300) 62%, transparent) 0%, transparent 46%),
        radial-gradient(80% 60% at 50% 120%, color-mix(in srgb, var(--primary-400) 30%, transparent), transparent 60%),
        linear-gradient(180deg, #fff, var(--primary-50));
    background-attachment: fixed; background-repeat: no-repeat;
}
.dark html[data-bg="aurora"] .fi-body:has(.astart-role-card-grid),
html.dark[data-bg="aurora"] .fi-body:has(.astart-role-card-grid) {
    background-color: #0b1120;
    background-image:
        linear-gradient(115deg, color-mix(in srgb, var(--primary-600) 40%, transparent) 0%, transparent 42%),
        linear-gradient(245deg, color-mix(in srgb, var(--primary-700) 34%, transparent) 0%, transparent 46%),
        radial-gradient(80% 60% at 50% 120%, color-mix(in srgb, var(--primary-600) 22%, transparent), transparent 60%),
        linear-gradient(180deg, #0d1526, #0b1120);
}

/* 4 · Login Degradesi (giriş ekranıyla uyumlu) */
html[data-bg="login"] .fi-body:has(.astart-role-card-grid) {
    background-color: var(--primary-50);
    background-image:
        radial-gradient(38% 46% at 100% 0%, color-mix(in srgb, var(--primary-300) 45%, transparent), transparent 70%),
        radial-gradient(46% 52% at 0% 100%, color-mix(in srgb, var(--primary-400) 34%, transparent), transparent 72%),
        linear-gradient(135deg, var(--primary-50) 0%, #fff 50%, var(--primary-50) 100%);
    background-attachment: fixed; background-repeat: no-repeat;
}
.dark html[data-bg="login"] .fi-body:has(.astart-role-card-grid),
html.dark[data-bg="login"] .fi-body:has(.astart-role-card-grid) {
    background-color: #0b1120;
    background-image:
        radial-gradient(38% 46% at 100% 0%, color-mix(in srgb, var(--primary-600) 26%, transparent), transparent 70%),
        radial-gradient(46% 52% at 0% 100%, color-mix(in srgb, var(--primary-700) 30%, transparent), transparent 72%),
        linear-gradient(135deg, #0d1526 0%, #0b1120 50%, #090d18 100%);
}
```

> **Not:** `.dark` seçici satırlarını paketin dark-mode işaretine göre koru — FilaCraft `.dark`
> class'ı kullanıyor (safir preset'inde `.dark .filacraft-safir .fi-body` var), o yüzden ikili
> seçici yeterli.

Ardından `resources/css/customization/index.css`'e import ekle (diğer `@import`ların yanına):

```css
@import './role-background.css';
```

---

## 2) Inline script — `src/FilaCraftPlugin.php`

**(a)** `THEME_KEYS` dizisine `"background"` ekle (~satır 91):

```js
var THEME_KEYS = ["theme", "color", "font", "radius", "density", "decorations", "table-style", "background", "topbar", "lang"];
```

**(b)** "Table Style" bloğunun hemen altına (~satır 174'ten sonra) ekle:

```js
/* Role-select Background */
var background = pref("background", "background");
if (background && background !== "default") {
    root.setAttribute("data-bg", background);
}
```

> Bu inline script tüm panel sayfalarında (rol-seçme dahil) `<head>`'de çalışır → attribute
> açılışta basılır, flash olmaz.

---

## 3) Controller — `src/Http/Controllers/ThemeSettingsController.php`

Validasyon dizisine ekle (~satır 30, `tableStyle`'ın yanına):

```php
'settings.background' => 'nullable|string|in:default,glow,mesh,aurora,login',
```

> Kolon değişikliği yok — `settings` zaten JSON, yeni anahtar otomatik saklanır.

---

## 4) Themes blade — `resources/views/pages/themes.blade.php`

### (a) UI bölümü

"Table Style" section'ının (`{{-- Section: Table Style --}}`) hemen altına yeni section ekle:

```blade
<div class="border-t border-gray-200 dark:border-gray-700"></div>

{{-- Section: Role-select Background --}}
<div>
    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1" x-text="t.background"></h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-5" x-text="t.backgroundDesc"></p>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 max-w-4xl">
        <template x-for="(opt, key) in backgroundOptions" :key="key">
            <button
                x-on:click="selectBackground(key)"
                :class="currentBackground === key
                    ? 'ring-2 ring-primary-500 bg-primary-50 dark:bg-primary-950/30'
                    : 'ring-1 ring-gray-200 dark:ring-gray-700 bg-white dark:bg-gray-900 hover:ring-gray-300 dark:hover:ring-gray-600'"
                class="relative rounded-xl p-4 text-left transition-all duration-200 hover:-translate-y-0.5"
            >
                {{-- Mini önizleme --}}
                <div class="mb-3 h-14 rounded-lg overflow-hidden ring-1 ring-black/5" :style="opt.preview"></div>
                <div class="text-xs font-medium text-gray-700 dark:text-gray-300 text-center" x-text="t.backgroundLabels[key]"></div>
                <div x-show="currentBackground === key" x-transition class="absolute top-2 right-2 h-4 w-4 rounded-full bg-primary-500 text-white flex items-center justify-center">
                    <svg class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                </div>
            </button>
        </template>
    </div>
</div>
```

### (b) Alpine state

`currentTableStyle` satırının (~786) yanına:

```js
currentBackground: localStorage.getItem('filacraft-background') || 'default',
```

### (c) Seçenek tanımları

`tableStyleOptions: { ... }` nesnesinin yanına ekle (mini önizleme `--primary-*` ile temaya uyumlu):

```js
backgroundOptions: {
    'default': { preview: 'background:var(--primary-200)' },
    'glow':    { preview: 'background:radial-gradient(120% 90% at 15% -10%, var(--primary-300), transparent 60%), linear-gradient(160deg, var(--primary-100), #fff)' },
    'mesh':    { preview: 'background:radial-gradient(50% 60% at 20% 25%, var(--primary-300), transparent 70%), radial-gradient(50% 60% at 80% 80%, var(--primary-200), transparent 70%), var(--primary-50)' },
    'aurora':  { preview: 'background:linear-gradient(115deg, var(--primary-200) 0%, transparent 45%), linear-gradient(245deg, var(--primary-300) 0%, transparent 50%), var(--primary-50)' },
    'login':   { preview: 'background:linear-gradient(135deg, var(--primary-100) 0%, #fff 50%, var(--primary-100) 100%)' },
},
```

### (d) Çeviriler

TR bloğuna (`tableStyle:` yanına, ~683):

```js
background: 'Rol Ekranı Arka Planı',
backgroundDesc: 'Rol seçme ekranı için arka plan',
backgroundLabels: { 'default': 'Düz', 'glow': 'Işık Lekeleri', 'mesh': 'Mesh', 'aurora': 'Aurora', 'login': 'Login' },
```

EN bloğuna (~749):

```js
background: 'Role Screen Background',
backgroundDesc: 'Background for the role-select screen',
backgroundLabels: { 'default': 'Plain', 'glow': 'Glow', 'mesh': 'Mesh', 'aurora': 'Aurora', 'login': 'Login' },
```

### (e) Seç fonksiyonu

`selectTableStyle()`'ın (~1108) yanına:

```js
selectBackground(id) {
    this.currentBackground = id;
    localStorage.setItem('filacraft-background', id);
    if (id === 'default') {
        document.documentElement.removeAttribute('data-bg');
    } else {
        document.documentElement.setAttribute('data-bg', id);
    }
    this.saveToDb();
},
```

### (f) Kaydet payload'ı

`_doSave` içindeki `settings:` nesnesine (`tableStyle: ...` yanına, ~1183):

```js
background: self.currentBackground,
```

### (g) Sunucudan yükle

`loadFromDb` içine (`tableStyle` satırının yanına, ~1206):

```js
if (s.background && s.background !== self.currentBackground) { self.selectBackground(s.background); changed = true; }
```

### (h) Sıfırla

`resetSettings` içine (~1221):

```js
localStorage.removeItem('filacraft-background');
```

### (i) Açılışta uygula

init bloğunda (`currentTableStyle` uygulamasının yanına, ~1257):

```js
if (this.currentBackground && this.currentBackground !== 'default') {
    document.documentElement.setAttribute('data-bg', this.currentBackground);
}
```

---

## Derleme & Doğrulama

- Paketteki değişiklikler sonrası tüketici projede: `npm run build`
- CSS literal kural olduğu için Tailwind purge etmez; `:has(.astart-role-card-grid)` seçici korunur.
- Doğrulama: Themes sayfasından bir arka plan seç → rol-seçme ekranını (yalnız birden fazla rolü
  olan kullanıcıda görünür) yenile → arka plan uygulanmalı. Tema paletini değiştir → arka plan
  otomatik o tonda görünmeli. Açık/koyu geçişini de test et.

## Opsiyonel — Login ekranını da kapsamak

Aynı arka planı giriş ekranında da istersen, her `html[data-bg="..."]` kuralının seçicisine
`.fi-simple-main-ctn`'i ekle, örn:

```css
html[data-bg="glow"] .fi-body:has(.astart-role-card-grid),
html[data-bg="glow"] .fi-simple-main-ctn { /* ... aynı background ... */ }
```

> Login sayfası `customization/login.css` ile zaten kendi degradesine sahip; onunla çakışmaması
> için birini tercih et.