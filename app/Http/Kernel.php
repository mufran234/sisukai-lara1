protected $routeMiddleware = [
    // ...
    'ensure.admin' => \App\Http\Middleware\EnsureAdmin::class,
    'ensure.pro'   => \App\Http\Middleware\EnsureProForFeature::class,
	'admin' => \App\Http\Middleware\IsAdmin::class,
	//'admin' => \App\Http\Middleware\EnsureAdmin::class,
    'pro'   => \App\Http\Middleware\IsPro::class,
    'free'  => \App\Http\Middleware\IsFree::class,
];