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














