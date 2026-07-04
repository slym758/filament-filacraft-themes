<?php

use Illuminate\Support\Facades\Route;
use Slym758\FilaCraft\Http\Controllers\ThemeSettingsController;

Route::middleware(['web', 'auth'])->prefix('api/theme-settings')->group(function () {
    Route::get('/', [ThemeSettingsController::class, 'show']);
    Route::post('/', [ThemeSettingsController::class, 'store']);
    Route::delete('/', [ThemeSettingsController::class, 'destroy']);
});

Route::get('/error-preview/{code}/{style}', function (string $code, string $style) {
    $pages = [
        '404' => ['title' => 'Sayfa Bulunamadi', 'message' => 'Aradiginiz sayfa mevcut degil veya tasinmis olabilir.'],
        '403' => ['title' => 'Erisim Engellendi', 'message' => 'Bu sayfaya erisim yetkiniz bulunmamaktadir.'],
        '500' => ['title' => 'Sunucu Hatasi', 'message' => 'Bir sorun olustu. Lutfen daha sonra tekrar deneyin.'],
    ];

    if (! isset($pages[$code]) || ! in_array($style, ['minimal', 'illustrated', 'gradient'])) {
        abort(404);
    }

    return view("filacraft::errors.styles.{$style}", [
        'code' => (int) $code,
        'title' => $pages[$code]['title'],
        'message' => $pages[$code]['message'],
    ]);
})->where('code', '404|403|500')->where('style', 'minimal|illustrated|gradient')->name('error.preview');
