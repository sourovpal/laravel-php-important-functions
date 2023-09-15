
<?php

$this->events()->create([
    'category_a' => optional($event)->categoryA,
    'category_b' => optional($event)->categoryB,
    'user' => optional($event->user)->accountId,
]);


$name = DB::table('users')->where('name', 'John')->pluck('name');

var_dump(DB::table('users')->where('id', 1)->pluck('id'));

$user = User::find(1);
$user->roles()->attach(1);

$user->articles()->syncWithoutDetaching([1]);
$user->articles()->syncWithoutDetaching([2]);
$user->articles()->syncWithoutDetaching([1]);


$user->articles()->sync([1]);
$user->articles()->sync([2, 3]);
$user->articles()->sync([3, 4]);


$user->roles()->sync(array(1 => array('expires' => true)));


$food = Food::find(1);
$food->allergies()->sync([1 => ['severity' => 3], 4 => ['severity' => 1]]);

return session()->get('url.intended');

protected $appends = ['cover'];
//define accessor
public function getCoverAttribute()
{
    return json_decode($this->InJson)->cover;
}

class User extends Authenticatable
{
    protected $dates = ['deleted_at'];
    protected $table = 'users';

    protected $appends =
    [
        'full_name',
        'last_post',
    ];

    protected $fillable =
    [
        'username',
        'first_name',
        'last_name',
    ];

    protected $hidden =
    [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post', 'user_id');
    }

    getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    getLastPostAttribute()
    {
        return $this->posts()->last()
    }
}

return $this->hasMany('App\Models\Post', 'post_author', 'ID')->where('post_status', 'publish')->latest('App\Models\Post'::CREATED_AT);



public function setStartDateAttribute($value)
{
    $this->attributes['start_date'] = Carbon::createFromFormat(env('Date_Format'), $value)->format('Y-m-d');
}

public function getStartDateAttribute($value)
{
    return Carbon::parse($value)->format(env('Date_Format'));
}


Announcement::with('company', 'department')->latest();

->pluck('id');

Attendance::where('attendance_date', now()->format('Y-m-d'))->distinct('employee_id')->count();


DB::beginTransaction();
try{
    User::whereId($id)->update($user);

    employee::whereId($id)->update($data);

    DB::commit();
} catch (Exception $e){
    DB::rollback();
    return response()->json(['error' =>  $e->getMessage()]);
} catch (Throwable $e){
    DB::rollback();
    return response()->json(['error' => $e->getMessage()]);
}

return response()->json(['success' => __('Data Added successfully.')]);




<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}



use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }
}

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        return UserResource::collection($user);
    }
}



your AppServiceProvider of your Laravel application.
/**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }


public function index(){
        return PostResource::collection(Post::query()->paginate(3));
    }
