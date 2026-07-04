<?php

namespace Slym758\FilaCraft\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Slym758\FilaCraft\Models\UserThemeSetting;

class ThemeSettingsController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $record = UserThemeSetting::where('user_id', $request->user()->id)->first();

        return response()->json($record?->settings ?? []);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.theme' => 'nullable|string|in:ege,akdeniz,kutup,gunbatimi,atlas,safir',
            'settings.color' => 'nullable|string|max:30',
            'settings.font' => 'nullable|string|max:50',
            'settings.radius' => 'nullable|string|in:sharp,small,default,large',
            'settings.density' => 'nullable|string|in:compact,default,comfortable',
            'settings.errorStyle' => 'nullable|string|in:default,minimal,illustrated,gradient',
            'settings.decorations' => 'nullable|string|in:off,on',
            'settings.tableStyle' => 'nullable|string|in:default,card,glass,accent,flat',
            'settings.lang' => 'nullable|string|in:tr,en',
        ]);

        UserThemeSetting::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['settings' => $validated['settings']],
        );

        return response()->json(['ok' => true]);
    }

    public function destroy(Request $request): JsonResponse
    {
        UserThemeSetting::where('user_id', $request->user()->id)->delete();

        return response()->json(['ok' => true]);
    }
}
