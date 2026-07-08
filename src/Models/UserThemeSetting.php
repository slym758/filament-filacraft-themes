<?php

namespace Slym758\FilaCraft\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class UserThemeSetting extends Model
{
    protected $fillable = ['user_id', 'settings'];

    protected function casts(): array
    {
        return [
            'settings' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Kullanici bazli cache anahtari.
     */
    public static function cacheKey(int|string $userId): string
    {
        return "filacraft.theme-settings.{$userId}";
    }

    /**
     * Kullanicinin tema ayarlarini cache'ten dondur; her istekte DB sorgusu yapmamak icin.
     *
     * @return array<string, mixed>
     */
    public static function settingsForUser(int|string $userId): array
    {
        $settings = Cache::remember(
            static::cacheKey($userId),
            now()->addDay(),
            fn () => static::query()->where('user_id', $userId)->first()?->settings ?? [],
        );

        if (($settings['theme'] ?? null) === 'kutup') {
            $settings['theme'] = 'ege';
        }

        return $settings;
    }

    /**
     * Ayar kaydedildiginde/silindiginde cache'i temizle.
     */
    public static function forgetCache(int|string $userId): void
    {
        Cache::forget(static::cacheKey($userId));
    }
}
