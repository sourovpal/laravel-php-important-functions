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
