# Filament Tema Paketleri Derinlemesine Analiz

> 4 farki tema paketi incelendi: SpykApp/theme-inverness, SpykApp/theme-aberdeen, SpykApp/theme-edinburgh, caresome/filament-neobrutalism-theme

---

## 1. Genel Mimari Karsilastirmasi

| Ozellik | Inverness | Aberdeen | Edinburgh | Neobrutalism |
|---------|-----------|----------|-----------|--------------|
| Yontem | CSS-only + Plugin | CSS-only + Plugin | CSS-only + Plugin | CSS-only + Plugin |
| CSS Dosya Sayisi | 1 | 1 | 1 | 1 |
| Blade Override | Yok | Yok | Yok | Yok |
| JS/Alpine | Yok | Yok | Yok | Yok |
| Tailwind Config | Yok | Yok | Yok | Yok |
| CSS Yukleme | @import (theme.css) | @import (theme.css) | @import (theme.css) | FilamentAsset::register |
| Plugin boot() | FilamentColor::register | FilamentColor::register | Bos | Bos |
| Install Command | Var | Var | Var | Yok |
| Customization API | Yok | Yok | Yok | customize() metodu |
| CSS Satir Sayisi | ~400 | ~500 | ~600 | ~1800 |

### Temel Bulgu
Tum paketler **tek bir CSS dosyasiyla** Filament'in tum gorunumunu degistiriyor. Hicbiri Blade view override, JavaScript veya Tailwind config degisikligi yapmiyor. Bu, Filament'in `.fi-*` prefix'li CSS sinif isimlerinin ne kadar tutarli ve hedeflenebilir oldugunu gosteriyor.

---

## 2. CSS Entegrasyon Yontemleri

### Yontem A: @import Injection (SpykApp Temalari)
SpykApp temalari bir `install` Artisan komutu ile calisir:

```php
// InstallCommand.php
$filamentImport = "@import '../../../../vendor/filament/filament/resources/css/theme.css';";
$themeImport = "@import '../../../../vendor/spykapps/theme-{name}/resources/css/{name}.css';";

// Filament import'undan SONRA eklenir (cascade siralama)
File::replaceInFile($filamentImport, $filamentImport . "\n" . $themeImport, $themeCssPath);
```

**Avantajlar:**
- Tailwind build pipeline'ina dahil olur, `@apply` kullanilabilir
- Vite/Tailwind derleme sirasinda optimize edilir
- Purge/tree-shaking'den etkilenmez

**Dezavantajlar:**
- Kullanicinin `npm run build` calistirmasi gerekir
- Panel basina ayri theme.css dosyasi gerektirir

### Yontem B: FilamentAsset (Neobrutalism)
```php
// Plugin register() icinde
$panel->assets([
    Css::make('neobrutalism-theme', __DIR__.'/../resources/css/theme.css'),
], 'caresome/filament-neobrutalism-theme');
```

**Avantajlar:**
- npm build gerekmez, `php artisan filament:assets` yeterli
- Daha basit kurulum

**Dezavantajlar:**
- `@apply` kullanilMAZ (Tailwind pipeline'inda degil)
- Ayri bir CSS dosyasi olarak yuklenir

---

## 3. CSS Custom Properties (Design Token) Sistemleri

### 3.1 Inverness - Minimal Token Sistemi
```css
:root {
    --theme-radius: 4px;
    --theme-radius-sm: 3px;
    --theme-radius-xs: 2px;
    --theme-transition: 100ms ease;
    --theme-transition-slow: 180ms ease;
    --theme-shadow-soft: 0 1px 2px 0 rgb(0 0 0 / 0.04);
    --theme-shadow-md: 0 2px 8px 0 rgb(0 0 0 / 0.06);
    --theme-shadow-lg: 0 8px 24px -4px rgb(0 0 0 / 0.08);
    --theme-border: rgb(0 0 0 / 0.08);
    --theme-border-mid: rgb(0 0 0 / 0.13);
    --theme-surface: #ffffff;
    --theme-surface-dim: #f9fafb;
    --laravel-red: #FF2D20;
    --laravel-red-dim: rgba(255, 45, 32, 0.12);
}
```
**Felsefe:** "Isiklari kapatip yeniden acmak" - Filament'in mevcut yapisini minimum degisiklikle rafine etmek.

### 3.2 Aberdeen - Sicak Amber Sistemi
```css
:root {
    --theme-radius: 8px;
    --theme-border: rgb(217 196 166 / 0.5);
    --theme-border-dash: rgb(203 183 152 / 0.7);
    --theme-surface: #fffdf9;
    --theme-surface-dim: #fdf6ec;
    --theme-surface-card: #fefcf8;
    --theme-amber: #f4a522;
    --theme-amber-hover: #e6960f;
    --theme-amber-dim: rgba(244, 165, 34, 0.12);
    --theme-text: #3d3425;
    --theme-text-dim: #8b7a60;
    --theme-text-muted: #b5a48a;
    --theme-body-bg: #fdf6ec;
    --cb-color: rgba(255, 45, 32, 0.35);  /* corner bracket */
    --cb-size: 16px;
    --cb-weight: 1.5px;
    --cb-offset: 6px;
}
```
**Felsefe:** Tam bir renk sistemi. Sicak tonlar, ozel border tipleri, ve dekoratif elemanlar icin token'lar.

### 3.3 Edinburgh - En Kapsamli Token Sistemi
```css
:root {
    /* 5 katmanli yuzey hiyerarsisi */
    --theme-surface: #faf9f6;
    --theme-surface-dim: #f2f0eb;
    --theme-surface-card: #ffffff;
    --theme-surface-inset: #eae7e0;
    --theme-surface-deep: #e3dfd6;

    /* 4 katmanli border sistemi */
    --theme-border: rgb(60 56 48 / 0.1);
    --theme-border-mid: rgb(60 56 48 / 0.16);
    --theme-border-heavy: rgb(60 56 48 / 0.24);
    --theme-border-ornate: rgb(168 135 42 / 0.2);

    /* 4 katmanli golge sistemi */
    --theme-shadow-soft: 0 1px 2px 0 rgb(40 36 28 / 0.06);
    --theme-shadow-md: 0 4px 16px -4px rgb(40 36 28 / 0.1);
    --theme-shadow-lg: 0 16px 48px -12px rgb(40 36 28 / 0.15);
    --theme-shadow-inset: inset 0 2px 4px rgb(40 36 28 / 0.06);

    /* Pirinc (brass) vurgu renkleri */
    --theme-brass: #a8872a;
    --theme-brass-hover: #8e7222;
    --theme-brass-light: #c4a94d;
    --theme-brass-dim: rgba(168, 135, 42, 0.08);
    --theme-brass-ring: rgba(168, 135, 42, 0.2);

    /* Yazi renkleri */
    --theme-slate: #3a362e;
    --theme-slate-dim: #635d52;
    --theme-slate-muted: #9c958a;
    --theme-slate-faint: #c4bfb4;

    /* Border radius - cok keskin */
    --theme-radius: 3px;
    --theme-radius-sm: 2px;
    --theme-radius-xs: 1px;
}
```
**Felsefe:** En zengin token sistemi. 5 yuzey katmani, 4 border katmani, 4 golge katmani ve tam bir accent renk paleti.

### 3.4 Neobrutalism - Fonksiyonel Token Sistemi
```css
:root {
    --neo-border-width: 2px;
    --neo-border-width-thick: 3px;
    --neo-radius-sm: 0.375rem;
    --neo-radius-md: 0.5rem;
    --neo-radius-lg: 0.75rem;
    --neo-radius-xl: 1rem;
    --neo-shadow-offset-sm: 2px;
    --neo-shadow-offset-md: 3px;
    --neo-shadow-offset-lg: 4px;
    --neo-shadow-offset-xl: 6px;
    --neo-font-weight-normal: 400;
    --neo-font-weight-bold: 700;
    --neo-font-weight-black: 900;
    --neo-letter-spacing-tight: -0.03em;
    --neo-letter-spacing-wide: 0.03em;
    --neo-transition-duration: 150ms;
    --neo-transition-timing: cubic-bezier(0.4, 0, 0.2, 1);
    --neo-transform-offset-xs: 0.125rem;
    --neo-transform-offset-sm: 0.25rem;
    --neo-spacing-xs: 0.25rem;
    --neo-spacing-sm: 0.5rem;
    --neo-spacing-md: 0.75rem;
    --neo-opacity-disabled: 0.7;
    --neo-scale: 1;
}
```
**Felsefe:** Her gorsel ozellik icin bir token. Transform, spacing, opacity, animation, scale - hepsi parametrik. Bu sayede `customize()` API ile her sey degistirilebilir.

---

## 4. Border Radius Override Stratejisi

**Tum temalar ayni teknik kullanir**: 60+ Filament CSS sinifini tek bir mega-selektorde birlestirip `border-radius` degistirmek.

```css
/* Her temada var olan mega-selektor (ornek) */
.fi-fo-toggle span.inline-block, .fi-fo-toggle, .fi-checkbox-input,
.fi-tabs, .fi-tabs-item, .fi-section, .fi-wi-stats-overview-stat,
.fi-tenant-menu, .fi-dropdown-panel, .fi-btn, .fi-fieldset,
.fi-icon-btn, .fi-input-wrp, .fi-badge, .fi-modal-window,
/* ... 50+ daha ... */
{
    border-radius: var(--theme-radius);
}
```

### Radius Degerleri Karsilastirmasi
| Tema | Standard | Small | XSmall |
|------|----------|-------|--------|
| Inverness | 4px | 3px | 2px |
| Aberdeen | 8px | 6px | 4px |
| Edinburgh | 3px | 2px | 1px |
| Neobrutalism | 6-16px (4 katman) | - | - |

**Ders:** Radius degistirmek tek basina UI'i dramatik sekilde donusturur. Edinburgh'un 3px'i "mimarisi" bir his verirken, Aberdeen'in 8px'i daha "yumusak" gorunur.

---

## 5. Sidebar Ozellestirme Teknikleri

### 5.1 Aktif Eleman Gostergesi

**Inverness & Aberdeen - ::before ile Sol Bar:**
```css
.fi-sidebar-item.fi-active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 5px;
    bottom: 5px;
    width: 2px;  /* Inverness: 2px, Aberdeen: 3px */
    background-color: var(--laravel-red);  /* veya --theme-amber */
    border-radius: 0 1px 1px 0;
    z-index: 1;
}
```

**Edinburgh - Sol Border + Ornate Inset:**
```css
.fi-sidebar-item.fi-active > .fi-sidebar-item-btn {
    background-color: var(--theme-brass-dim);
    border-left: 2px solid var(--theme-brass);
    font-weight: 600;
    box-shadow: inset 0 0 0 1px var(--theme-border-ornate);
}
```

**Neobrutalism - Tam Dolgu + Golge:**
```css
.fi-sidebar-item.fi-active > .fi-sidebar-item-btn {
    background-color: var(--primary-600);
    border-color: var(--primary-700);
    box-shadow: 3px 3px 0px var(--primary-700);
}
```

### 5.2 Sidebar Arka Plan

| Tema | Yaklasim |
|------|----------|
| Inverness | `bg-white dark:bg-gray-950` (duz) |
| Aberdeen | `background-color: var(--theme-surface)` (sicak beyaz) |
| Edinburgh | `linear-gradient(180deg, surface-dim, surface-inset)` (gradient!) |
| Neobrutalism | `background-color: var(--warning-50)` (sicak sari) |

### 5.3 Grup Baslik Stilleri

**Edinburgh - En Agresif:**
```css
.fi-sidebar-group-btn {
    font-size: 0.625rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    font-weight: 700;
    border-bottom: 1px solid var(--theme-border);
}
```

### 5.4 Ozel Scrollbar
Tum SpykApp temalari sidebar icin ince scrollbar tanimlar:
```css
.fi-sidebar-nav::-webkit-scrollbar { width: 3px; } /* veya 4px */
.fi-sidebar-nav::-webkit-scrollbar-track { background: transparent; }
.fi-sidebar-nav::-webkit-scrollbar-thumb { background: var(--theme-border); border-radius: 2px; }
```

---

## 6. Tablo Ozellestirme Teknikleri

### 6.1 Baslik Hucresi (Header Cell)
Tum temalar tablo basliklarini **uppercase + letter-spacing** yapar:

```css
.fi-ta-header-cell {
    font-size: 0.625rem - 0.75rem;     /* kucuk */
    font-weight: 600 - 800;             /* kalin */
    text-transform: uppercase;
    letter-spacing: 0.1em - 0.12em;     /* genis */
    color: var(--theme-text-muted);     /* soluk */
}
```

### 6.2 Satir Ayiricilar
| Tema | Border Stili |
|------|-------------|
| Inverness | `1px solid var(--theme-border)` |
| Aberdeen | `1px dashed var(--theme-border-dash)` |
| Edinburgh | `2px solid var(--theme-border-mid)` (baslik), `1px solid` (satirlar) |
| Neobrutalism | `var(--neo-border-width) solid` + row-gap teknik |

### 6.3 Hover Efektleri
```css
/* Inverness */
.fi-ta-row:hover td { @apply bg-gray-50 dark:bg-white/[0.015]; }

/* Aberdeen */
.fi-ta-row:hover td { background-color: var(--theme-surface-dim); }

/* Edinburgh - Pirinc ton */
.fi-ta-row:hover td { background-color: var(--theme-brass-dim); }

/* Neobrutalism - Yok (border-based) */
```

### 6.4 Neobrutalism'in Benzersiz Tablo Teknigi
Row gap'i border olarak kullanir:
```css
.fi-ta-ctn {
    background-color: var(--gray-950);  /* arka plan border rengi olur */
}
/* Satirlar arasindaki row-gap arka plani gosterir = kalin cizgiler */
```

---

## 7. Form Input Ozellestirme

### 7.1 Focus State Karsilastirmasi

**Inverness - Kirmizi Glow:**
```css
.fi-input-wrp:focus-within {
    border-color: var(--laravel-red);
    box-shadow: 0 0 0 2px rgba(255, 45, 32, 0.1);
}
```

**Aberdeen - Amber Glow:**
```css
.fi-input-wrp:focus-within {
    border-color: var(--theme-amber);
    box-shadow: 0 0 0 2px var(--theme-amber-ring);
}
```

**Edinburgh - Pirinc Glow + Inset Shadow:**
```css
.fi-input-wrp:focus-within {
    border-color: var(--theme-brass);
    box-shadow: 0 0 0 3px var(--theme-brass-ring), var(--theme-shadow-inset);
}
```

**Neobrutalism - Golge Rengi Degisiyor:**
```css
.fi-input-wrp:not(.fi-disabled):focus-within {
    border-color: var(--primary-700);
    box-shadow: 3px 3px 0px var(--primary-700);  /* hard shadow primary olur */
}
```

### 7.2 Invalid State (Sadece Neobrutalism)
```css
.fi-input-wrp.fi-invalid {
    border-color: var(--danger-600);
    box-shadow: 3px 3px 0px var(--danger-600);  /* golge kirmizi olur */
}
```

---

## 8. Buton Ozellestirme

### 8.1 Primary Buton

**Inverness:**
```css
.fi-btn-color-primary {
    background-color: var(--laravel-red) !important;
    border-color: var(--laravel-red) !important;
    color: #ffffff !important;
}
```

**Edinburgh - Gradient:**
```css
.fi-btn-color-primary {
    background: linear-gradient(180deg, var(--theme-brass-light), var(--theme-brass)) !important;
    border: 1px solid var(--theme-brass-hover) !important;
    text-shadow: 0 1px 1px rgb(0 0 0 / 0.15);
    box-shadow: 0 1px 3px rgb(0 0 0 / 0.1), inset 0 1px 0 rgb(255 255 255 / 0.2);
}
```

**Neobrutalism - Basma Efekti:**
```css
/* Normal */
.fi-btn { box-shadow: 3px 3px 0px var(--gray-950); }

/* Hover: yari basilmis */
.fi-btn:hover {
    transform: translateY(0.125rem);
    box-shadow: 2px 2px 0px var(--gray-950);
}

/* Active: tam basilmis */
.fi-btn:active {
    transform: translateY(0.25rem);
    box-shadow: 0px 0px 0px var(--gray-950);
}
```

### 8.2 Buton Press Efektleri
| Tema | Hover | Active |
|------|-------|--------|
| Inverness | transform: none | opacity: 0.85 |
| Aberdeen | transform: none | opacity: 0.85 |
| Edinburgh | gradient ters cevriliyor | translateY(1px) |
| Neobrutalism | translateY + golge kucuyor | translateY + golge yok oluyor |

---

## 9. Modal Ozellestirme

### 9.1 Standard Modal

**Edinburgh - Pirinc Ust Border:**
```css
.fi-modal-window {
    border-top: 3px solid var(--theme-brass);
    border-radius: 0 0 var(--theme-radius) var(--theme-radius);
}
```

**Neobrutalism - En Buyuk Golge:**
```css
.fi-modal-window {
    box-shadow: 6px 6px 0px var(--gray-950);  /* --neo-shadow-offset-xl */
}
```

### 9.2 Slide-Over Modal

**Edinburgh - Sol Pirinc Border:**
```css
.fi-modal-slide-over .fi-modal-window {
    border-left: 3px solid var(--theme-brass);
    box-shadow: -8px 0 40px rgb(0 0 0 / 0.12);
}
```

### 9.3 Overlay/Backdrop

| Tema | Light Mode | Dark Mode | Blur |
|------|-----------|-----------|------|
| Inverness | `rgb(0 0 0 / 0.25)` | `rgb(0 0 0 / 0.5)` | 4px |
| Aberdeen | `rgb(253 246 236 / 0.7)` (krem!) | `rgb(0 0 0 / 0.6)` | 6px |
| Edinburgh | `rgb(30 28 24 / 0.55)` | ayni | 12px + saturate |
| Neobrutalism | `color-mix(gray-950 60%, transparent)` | - | 4px |

**Onemli:** Aberdeen'in overlay'i KREM renkli - bu cok farkli bir his veriyor.

---

## 10. Dekoratif Elemanlar

### 10.1 Corner Brackets (Edinburgh & Aberdeen)
CSS mask-image ile sadece 4 kosede gorunen dekoratif cerceve:

```css
.fi-section::before {
    content: "";
    position: absolute;
    top: var(--cb-offset);    /* 6-7px */
    left: var(--cb-offset);
    right: var(--cb-offset);
    bottom: var(--cb-offset);
    border: var(--cb-weight) solid var(--cb-color);
    pointer-events: none;
    z-index: 1;

    /* Sadece 4 koseyi goster */
    mask-image:
        linear-gradient(#000, #000),
        linear-gradient(#000, #000),
        linear-gradient(#000, #000),
        linear-gradient(#000, #000);
    mask-position: 0 0, 100% 0, 0 100%, 100% 100%;
    mask-size: var(--cb-size) var(--cb-size);  /* 16-22px */
    mask-repeat: no-repeat;
}
```

### 10.2 Edinburgh Stats Card - Hover'da Ust Border
```css
.fi-wi-stats-overview-stat {
    border-top: 2px solid var(--theme-border-heavy);
}
.fi-wi-stats-overview-stat:hover {
    border-top-color: var(--theme-brass);  /* pirinc rengine donusuyor */
}
```

### 10.3 Neobrutalism - Disabled Capraz Cizgiler
```css
.fi-btn.fi-disabled {
    background-image: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 8px,
        var(--gray-100) 8px,
        var(--gray-200) 16px
    ) !important;
}
```

### 10.4 Neobrutalism - Loading Shimmer Animasyonu
```css
@keyframes neo-shimmer {
    0%   { background-position: -200% center; box-shadow: 3px 3px 0px var(--gray-950); }
    50%  { background-position: 200% center;  box-shadow: 4px 4px 0px var(--gray-950); }
    100% { background-position: -200% center; box-shadow: 3px 3px 0px var(--gray-950); }
}
```

---

## 11. Tipografi Degisiklikleri

### 11.1 Sayfa Basligi
| Tema | Size | Weight | Tracking |
|------|------|--------|----------|
| Inverness | 1.5rem (text-2xl) | bold (700) | -0.02em |
| Aberdeen | 1.5rem | 700 | -0.02em |
| Edinburgh | 1.375rem | 800 | -0.015em |
| Neobrutalism | 1.875rem | 900 (black) | -0.03em |

### 11.2 Tablo Basliklari
| Tema | Size | Weight | Tracking | Transform |
|------|------|--------|----------|-----------|
| Inverness | 0.75rem | 600 | widest | uppercase |
| Aberdeen | 0.75rem | 600 | 0.1em | uppercase |
| Edinburgh | 0.625rem | 800 | 0.12em | uppercase |
| Neobrutalism | 0.75rem | 700 | 0.05em | uppercase |

### 11.3 Form Label (Sadece Neobrutalism)
```css
.fi-fo-field-wrp-label {
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-size: 0.75rem;
}
```

---

## 12. Dark Mode Stratejileri

### Yaklasim A: CSS Custom Property Reassignment (Edinburgh)
En kapsamli - her token dark mode icin yeniden tanimlanir:
```css
.dark {
    --theme-brass: #c9a43a;           /* daha parlak */
    --theme-surface: #13110e;         /* cok koyu sicak siyah */
    --theme-surface-card: #1a1815;
    --theme-slate: #d4cfc4;           /* ters cevrilmis */
    --theme-border: rgb(255 255 255 / 0.06);
    --theme-shadow-soft: 0 1px 3px 0 rgb(0 0 0 / 0.3);
}
```

### Yaklasim B: Filament Renk Degiskenleri (Neobrutalism)
Filament'in kendi `--gray-*`, `--primary-*` degiskenlerini kullanir. Dark mode Filament tarafindan otomatik yonetilir. Ek olarak `.dark` prefix ile override:
```css
.dark .fi-section { background-color: var(--gray-900); }
.dark .fi-ta-ctn { border-color: var(--gray-600); }
```

### Yaklasim C: @apply + .dark (Inverness)
Tailwind'in dark variant'ini kullanir:
```css
.fi-main-sidebar { @apply bg-white dark:bg-gray-950; }
.fi-sidebar-item-btn:hover { @apply bg-gray-100 dark:bg-white/[0.04]; }
```

---

## 13. Renk Sistemi Yaklasimlari

### Yaklasim A: Kendi Renk Paleti (Edinburgh)
Filament'in renk sisteminden BAGIMSIZ, tamamen ozel renkler:
- Pirinc (brass): `#a8872a` - vurgu rengi
- Slate: `#3a362e` - yazi rengi
- Surface: `#faf9f6` - arka plan

### Yaklasim B: Filament Renkleri + Override (Inverness, Aberdeen)
`FilamentColor::register()` ile Filament'in renk paletini degistirir, sonra CSS ile `!important` kullanarak primary butonlari zorlayarak kendi rengini uygular:
```php
FilamentColor::register(['primary' => Color::Red]);
```
```css
.fi-btn-color-primary { background-color: var(--laravel-red) !important; }
```

### Yaklasim C: Filament Native Renkleri (Neobrutalism)
Filament'in kendi CSS degiskenlerini kullanir: `var(--primary-600)`, `var(--gray-950)`, `var(--warning-50)`. Bu sayede panel'de ayarlanan renkler otomatik olarak temaya yansir.

---

## 14. Golge Stratejileri

### Inverness - Golge Kaldir
```css
.fi-section { box-shadow: none; }
.fi-ta-ctn { box-shadow: none; }
.fi-btn:hover { box-shadow: none; }
/* Sadece modal ve login card'da golge var */
```

### Edinburgh - Sicak Tonlu Golgeler
```css
/* Siyah yerine sicak kahverengi base */
--theme-shadow-soft: 0 1px 2px 0 rgb(40 36 28 / 0.06);
--theme-shadow-inset: inset 0 2px 4px rgb(40 36 28 / 0.06);
```

### Neobrutalism - Hard Offset Golgeler (Blur Yok!)
```css
/* Bulaniklastirma YOK, sadece offset */
box-shadow: 4px 4px 0px var(--gray-950);  /* sert, grafik golge */
```

---

## 15. Pseudo-Element Kullanim Kaliplari

### ::before - Gosterge Cubugu
```css
/* Sidebar aktif bar (Inverness/Aberdeen) */
.fi-sidebar-item.fi-active::before {
    content: ""; position: absolute;
    left: 0; top: 5px; bottom: 5px; width: 2-3px;
    background: accent-color;
}

/* Stats hover top-bar (Inverness/Aberdeen) */
.fi-wi-stats-overview-stat::before {
    content: ""; position: absolute;
    top: 0; left: 0; right: 0; height: 1-2px;
    background: accent-color; opacity: 0;
}
.fi-wi-stats-overview-stat:hover::before { opacity: 1; }
```

### ::after - Alt Cizgi Gostergesi
```css
/* Aktif tab alt cizgisi (tum temalar) */
.fi-tabs-item.fi-active::after {
    content: ""; position: absolute;
    left: 0; right: 0; bottom: 0; height: 2px;
    background: accent-color;
}
```

### ::before + ::after - Corner Bracket (Edinburgh/Aberdeen)
Bir pseudo-element mask ile kose suslemesi, digeri tam border overlay.

---

## 16. !important Kullanim Politikasi

| Tema | !important Kullanimi |
|------|---------------------|
| Inverness | Minimum - sadece primary buton renkleri ve modal overlay |
| Aberdeen | Minimum - sadece primary buton ve tablo ic padding |
| Edinburgh | Az - primary buton, modal overlay, bazi border-radius |
| Neobrutalism | Daha fazla - disabled durumlar, badge suppression |

**Ders:** `!important` genellikle Filament'in inline style veya utility class'larini override etmek icin gerekli. Primary buton renkleri ve modal overlay neredeyse her zaman `!important` gerektiriyor.

---

## 17. Neobrutalism'in Benzersiz Ozellikleri

### 17.1 customize() PHP API
```php
NeobrutalismeTheme::make()
    ->customize([
        'border-width' => '4px',          // --neo-border-width: 4px
        'shadow-offset-lg' => '8px',      // --neo-shadow-offset-lg: 8px
        '--custom-var' => 'value',         // --custom-var: value
    ])
```
Bu API `FilamentAsset::registerCssVariables()` kullanir - diger temalarda boyle bir ozellik YOK.

### 17.2 Filament Renk Sistemi Entegrasyonu
Neobrutalism, `var(--primary-600)`, `var(--color-700)` gibi Filament'in native CSS degiskenlerini kullanir. Bu sayede:
- Panel'de `->colors(['primary' => Color::Blue])` ayarlanirsa tema otomatik mavi olur
- Component'te `->color('success')` kullanilirsa tema otomatik yesil gosterir

### 17.3 color-mix() Kullanimi
```css
@supports (color: color-mix(in lab, red, red)) {
    .fi-modal-close-overlay {
        background-color: color-mix(in oklab, var(--gray-950) 60%, transparent);
    }
}
```

---

## 18. FilaCraft Icin Cikarilacak Dersler

### 18.1 Bizim Avantajlarimiz
FilaCraft zaten modular CSS mimarisine sahip (panel/, form/, table/, support/ klasorleri). Bu, diger temalarin "tek dosya" yaklasimina gore cok daha iyi organize.

### 18.2 Eksik Olan ve Eklenebilecek Seyler

1. **CSS Custom Property Sistemi**: Edinburgh tarzi kapsamli bir token sistemi olmali
   - Minimum 3-5 yuzey katmani
   - 3-4 border yogunluk katmani
   - 3-4 golge boyutu
   - Accent renk varyasyonlari (base, hover, dim, ring)

2. **customize() API**: Neobrutalism'in PHP API'si gibi, kullanicinin token'lari override edebilmesi

3. **Pseudo-Element Dekorasyonlari**: Corner bracket, sidebar bar indicator, tab underline gibi CSS-only suslemeler

4. **Filament Native Renk Entegrasyonu**: `var(--primary-*)`, `var(--gray-*)` kullanarak panel renklerine otomatik uyum

5. **Mega Border-Radius Selektoru**: 60+ fi-* sinifini hedefleyen tek bir kural ile global radius kontrolu

6. **Tablo Baslik Formatlamasi**: uppercase + letter-spacing + kucuk font = profesyonel gorunum

7. **Form Focus State**: Accent renkli ring/glow efekti

8. **Modal Overlay**: Backdrop-filter: blur + saturate + ozel arka plan rengi

9. **Ozel Scrollbar**: 3-4px genisliginde, tema renklerine uyumlu

10. **Animasyon/Loading Durumlari**: Shimmer, diagonal stripe gibi ozel loading gosterimleri

### 18.3 Kacinilmasi Gerekenler

1. **Tek dosya yaklasimi**: Bizim modular yapimiz daha iyi, bunu koruyalim
2. **Asiri !important**: Mumkun oldugunda specificity ile cozum
3. **Sabit renk kodlari**: Token sistemi ile parametrik olmali
4. **FilamentColor override**: Kullanicinin panel renklerini ezmek yerine, onlara uyum saglamak
5. **@apply bagimliligini**: FilamentAsset ile yuklenen CSS'te @apply calismaz

### 18.4 Mimari Oneriler

```
filacraft/resources/css/
├── tokens/               # CSS Custom Properties (YENi)
│   ├── colors.css        # Renk tokenlari
│   ├── radius.css        # Border radius
│   ├── shadows.css       # Golge tokenlari
│   ├── spacing.css       # Bosluk
│   └── typography.css    # Yazi tokenlari
├── panel/                # Panel bilesenleri (MEVCUT)
├── form/                 # Form bilesenleri (MEVCUT)
├── table/                # Tablo bilesenleri (MEVCUT)
├── support/              # Destek bilesenleri (MEVCUT)
├── customization/        # Kullanici tercihleri (MEVCUT)
├── decorations/          # Dekoratif elemanlar (YENi)
│   ├── corner-brackets.css
│   ├── active-indicators.css
│   └── loading-states.css
└── presets/              # Hazir temalar (MEVCUT)
```

---

## 19. Hedeflenmesi Gereken fi-* CSS Siniflari (Tam Liste)

### Panel
- `.fi-main-sidebar` - Ana sidebar container
- `.fi-sidebar-nav` - Sidebar navigasyon
- `.fi-sidebar-item` / `.fi-sidebar-item-btn` - Sidebar ogeleri
- `.fi-sidebar-item.fi-active` - Aktif sidebar ogesi
- `.fi-sidebar-group-btn` - Sidebar grup basliklari
- `.fi-topbar` - Ust cubuk
- `.fi-topbar-item-btn` - Ust cubuk butonlari
- `.fi-tenant-menu` / `.fi-tenant-menu-trigger` - Tenant menusu

### Table
- `.fi-ta-ctn` - Tablo container
- `.fi-ta-header-cell` - Baslik hucresi
- `.fi-ta-cell` - Veri hucresi
- `.fi-ta-row` - Tablo satiri
- `.fi-pagination` - Sayfalama

### Form
- `.fi-input-wrp` - Input wrapper
- `.fi-fo-toggle` - Toggle
- `.fi-fo-repeater-item` - Repeater ogesi
- `.fi-fo-builder-item` - Builder ogesi
- `.fi-fo-wizard-header` - Wizard basligi
- `.fi-fo-field-wrp-label` - Form label

### Support
- `.fi-btn` / `.fi-btn-color-primary` - Butonlar
- `.fi-badge` - Badge
- `.fi-icon-btn` - Icon buton
- `.fi-dropdown-panel` / `.fi-dropdown-list-item` - Dropdown
- `.fi-modal-window` / `.fi-modal-close-overlay` - Modal
- `.fi-section` / `.fi-section-header` / `.fi-section-content-ctn` - Section
- `.fi-tabs` / `.fi-tabs-item` - Tab
- `.fi-no-notification` - Notification

### Widget
- `.fi-wi-stats-overview-stat` - Stats widget

### Auth
- `.fi-simple-main` - Login/register card

### Navigation
- `.fi-header-heading` - Sayfa basligi
- `.fi-breadcrumbs` / `.fi-breadcrumbs-item-label` - Breadcrumb
- `.fi-avatar` - Avatar
- `.fi-global-search-results-ctn` - Arama sonuclari