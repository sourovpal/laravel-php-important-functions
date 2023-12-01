->selectRaw('price * ? as price_with_tax', [1.0825])
->get()
->groupBy('department')
->havingRaw('SUM(price) > ?', [2500])
->orderByRaw('updated_at - created_at DESC')
->groupByRaw('city, state')
->join('contacts', 'users.id', '=', 'contacts.user_id')
->join('orders', 'users.id', '=', 'orders.user_id')
->select('users.*', 'contacts.phone', 'orders.price')
->leftJoin('posts', 'users.id', '=', 'posts.user_id')
->rightJoin('posts', 'users.id', '=', 'posts.user_id')
DB::table('users')
->crossJoin('colors')
->join('contacts', function ($join) {
   $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
})

->join('contacts', function ($join) {
    $join->on('users.id', '=', 'contacts.user_id')
    ->where('contacts.user_id', '>', 5);
})
->whereNull('first_name');
->whereNull('last_name')->union($first);
->where('votes', '>', 100)->orWhere('name', 'John');
->orWhere(function($query) {
  $query->where('name', 'Abigail')->where('votes', '>', 50);
});
->whereBetween('votes', [1, 100])
->whereNotBetween('votes', [1, 100])
->whereIn('id', [1, 2, 3])
->whereNotIn('id', [1, 2, 3])
->whereNotNull('updated_at')
->whereDate('created_at', '2016-12-31')
->whereMonth('created_at', '12')
->whereDay('created_at', '31')
->whereYear('created_at', '2016')
->whereTime('created_at', '=', '11:20:45')
->whereColumn('first_name', 'last_name')
->whereColumn('updated_at', '>', 'created_at')
->whereColumn([
    ['first_name', '=', 'last_name'],
    ['updated_at', '>', 'created_at'],
])
->whereExists(function ($query) {
   $query->select(DB::raw(1))
         ->from('orders')
         ->whereRaw('orders.user_id = users.id');
})
->whereJsonContains('options->languages', 'en')
->whereJsonContains('options->languages', ['en', 'de'])
->whereJsonLength('options->languages', 0)
->orderBy('name', 'desc')
->latest()
->first();
->inRandomOrder()
->groupBy('account_id')
->having('account_id', '>', 100)
->skip(10)
->take(5)
->offset(10)
->limit(5)
->when($role, function ($query, $role) { 
   return $query->where('role_id', $role); 
});
->when($sortBy, function ($query, $sortBy) {
  return $query->orderBy($sortBy);
}, function ($query) {
  return $query->orderBy('name');
})
DB::table('users')->insert(
    ['email' => 'john@example.com', 'votes' => 0]
);
DB::table('users')->insert([
    ['email' => 'taylor@example.com', 'votes' => 0],
    ['email' => 'dayle@example.com', 'votes' => 0]
]);
DB::table('users')->insertOrIgnore([
    ['id' => 1, 'email' => 'taylor@example.com'],
    ['id' => 2, 'email' => 'dayle@example.com']
]);
$id = DB::table('users')->insertGetId(
    ['email' => 'john@example.com', 'votes' => 0]
);
DB::table('users')
->where('id', 1)
->update(['votes' => 1]);
DB::table('users')
 ->updateOrInsert(
     ['email' => 'john@example.com', 'name' => 'John'],
     ['votes' => '2']
 );
DB::table('users')->increment('votes');
 
DB::table('users')->increment('votes', 5);
 
DB::table('users')->decrement('votes');
 
DB::table('users')->decrement('votes', 5);
DB::table('users')->where('votes', '>', 100)->delete();
DB::table('users')->where('votes', '>', 100)->dd(); 
DB::table('users')->where('votes', '>', 100)->dump();
->count();
->max('price');
->avg('price');
->exists();
->doesntExist();
->distinct()->get();

DB::table('users')
->joinSub($latestPosts, 'latest_posts', function ($join) {
   $join->on('users.id', '=', 'latest_posts.user_id');
})->get();

->whereHas()
->withWhereHas()
->orWhereHas()
->whereDoesntHave()
->orWhereDoesntHave()
->firstWhere()
->firstWhere()
->orWhere()
->whereNot()
->orWhereNot()
->latest()
->oldest()
->find()
->findMany()
->findOrFail()
->findOrNew()
->findOr()
->firstOrNew()
->firstOrCreate()
->createOrFirst()
->updateOrCreate()
->firstOrFail()
->firstOr()
->value()
->soleValue()
->valueOrFail()
->get()
->getModels()
->getModels()
->paginate()
->simplePaginate()
->create()
->update()
->touch()
->delete()
->forceDelete()
->onDelete()
->with()
->without()
->getQuery()
->setQuery()
->getModel()
->setModel()
->toArray()
->toSql()
->withCount()
->has()
->unique()
->toArray();








