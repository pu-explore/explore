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
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'lang' => $this->getLang(),
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
    protected function getLang(): array
    {
        $localePath = resource_path('lang');

        $files = scandir($localePath);

        $locales = [];

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $fileKey = explode('.', $file)[0];
                $locales[$fileKey] = include($localePath.'/'.$file.'/admin.php');
            }
        }

        return $locales;
    }
}
