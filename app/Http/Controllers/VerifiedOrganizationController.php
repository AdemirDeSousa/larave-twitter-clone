<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifiedOrganizationController extends Controller
{
    public function __invoke()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->createOrGetStripeCustomer();

        if ($user->subscribed('verified-org')) {
            return $user->redirectToBillingPortal();
        }

        return $user->newSubscription('verified-org', 'price_1NMzReFMi4sxdEN8t9tZ3GdX')
            ->checkout()
            ->redirect();
    }
}
