<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'languages' => $this->getLanguages(),
            'locale' => config('app.locale'),
            'fallbackLocale' => config('app.fallback_locale'),
            'admin' => config('admin'),
            'auth' => [
                'user' => $request->user(),
            ],
        ]);
    }

    /**
     * @return array
     */
    protected function getLanguages(): array
    {
        $localePath = resource_path('lang');

        $directories = scandir($localePath);

        $languages = [];
        foreach ($directories as $directory) {
            if ($directory !== '.' && $directory !== '..') {
                $file = $localePath.'/'.$directory.'/admin.php';
                if (file_exists($file)) {
                    $languages[$directory] = include($file);
                }
            }
        }

        return $languages;
    }
}
