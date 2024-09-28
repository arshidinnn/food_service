<?php

namespace App\Console\Commands;

use App\Enums\RoleType;
use App\Models\Role;
use Illuminate\Console\Command;

class GenerateRoles extends Command
{
    /**
     * @var string
     */
    protected $signature = 'roles:generate';

    /**
     * @var string
     */
    protected $description = 'Command for roles generating';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (RoleType::getValues() as $role) {
            if (!Role::whereName($role)->exists()) {
                Role::query()->create([
                    'name' => $role
                ]);
                $this->info("Role {$role} has been added.");
            } else {
                $this->info("Role '{$role}' already exists.");
            }
        }
        $this->info("\nAll roles have been processed.");
    }
}
