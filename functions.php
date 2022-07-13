$this->events()->create([
    'category_a' => optional($event)->categoryA,
    'category_b' => optional($event)->categoryB,
    'user' => optional($event->user)->accountId,
]);
