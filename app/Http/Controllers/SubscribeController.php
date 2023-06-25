<?php

namespace App\Http\Controllers;

use App\Models\User;

class SubscribeController extends Controller
{
    public function __invoke()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->createOrGetStripeCustomer();

        return $user->newSubscription('default', 'price_1NLlacFMi4sxdEN8HxC9ERge')
            ->checkout()
            ->redirect();
    }
}
