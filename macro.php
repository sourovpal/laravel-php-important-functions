Illuminate\Auth\RequestGuard
Illuminate\Auth\SessionGuard
Illuminate\Cache\Repository
Illuminate\Console\Command
Illuminate\Console\Scheduling\Event
Illuminate\Cookie\CookieJar
Illuminate\Database\Eloquent\FactoryBuilder
Illuminate\Database\Eloquent\Relations\Relation
Illuminate\Database\Grammar
Illuminate\Database\Query\Builder
Illuminate\Database\Schema\Blueprint
Illuminate\Filesystem\Filesystem
Illuminate\Foundation\Testing\TestResponse
Illuminate\Http\JsonResponse
Illuminate\Http\RedirectResponse
Illuminate\Http\Request
Illuminate\Http\Response
Illuminate\Http\UploadedFile
Illuminate\Mail\Mailer
Illuminate\Routing\PendingResourceRegistration
Illuminate\Routing\Redirector
Illuminate\Routing\ResponseFactory
Illuminate\Routing\Route
Illuminate\Routing\Router
Illuminate\Routing\UrlGenerator
Illuminate\Support\Arr
Illuminate\Support\Collection
Illuminate\Support\LazyCollection
Illuminate\Support\Str
Illuminate\Support\Testing\Fakes\NotificationFake
Illuminate\Translation\Translator
Illuminate\Validation\Rule
Illuminate\View\Factory
Illuminate\View\View




namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('isLength', function ($str, $length) {

            return static::length($str) == $length;
        });
    }
}


use Illuminate\Support\Str;
dd(Str::isLength('This is a Laravel Macro', 23)); // true


Str::macro('appendTo', function ($str, $char) {
    return $char.$str;
});

use Illuminate\Support\Str;
dd(Str::appendTo('LaraShout', '@')); // @LaraShout


namespace App\Mixins;

class StrMixin
{
    /**
     * @return \Closure
     */
    public function isLength()
    {
        return function($str, $length) {
            return static::length($str) == $length;
        };
    }

    /**
     * @return \Closure
     */
    public function appendTo()
    {
        return function($str, $char) {
            return $char.$str;
        };
    }
}




namespace App\Providers;

use App\Mixins\StrMixin;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Str::mixin(new StrMixin);
    }
}



use Illuminate\Database\Eloquent\Builder;

// ...

Builder::macro('search', function(string $attribute, string $searchTerm) {
   return $this->where($attribute, 'LIKE', "%{$searchTerm}%");
});




use Illuminate\Database\Eloquent\Builder;

// ...
Builder::macro('search', function($attributes, string $searchTerm) {
foreach(array_wrap($attributes) as $attribute) {
$this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
   }

return $this;
});


User::search('name', $searchTerm)->get();

// searching on multiple columns in one go
User::query()
->search('user', 'moom')
->search('email', 'gmail')
->get();



