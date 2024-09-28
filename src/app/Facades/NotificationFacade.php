<?php

namespace App\Facades;

use App\Services\Admin\NotificationService;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static void notifyUser(\App\Models\User $user, string $role, bool $isNew)
 *
 * @see NotificationService
 */
class NotificationFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NotificationService::class;
    }
}
