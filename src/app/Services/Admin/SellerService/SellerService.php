<?php

namespace App\Services\Admin\SellerService;

use App\Http\Requests\Admin\Seller\StoreSellerRequest;
use App\Http\Requests\Admin\Seller\UpdateSellerRequest;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SellerService
{
    /**
     * @throws \Exception
     */
    public function store(StoreSellerRequest $request): void
    {
        DB::beginTransaction();
        try {
            $email = $request->string('email');
            $user = $this->getUser($email);
            $user->seller()->create([
                'name' => $request->string('name'),
                'reg_number' => $request->string('reg_number'),
                'bin' => $request->string('bin')
            ]);

            $this->notifyUser($user, isset($user->temporary_password));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function update(UpdateSellerRequest $request, string $sellerId): void
    {
        DB::beginTransaction();
        try {
            $seller = Seller::query()->findOrFail($sellerId);

            $seller->update([
                'name' => $request->string('name'),
                'bin' => $request->string('bin'),
                'reg_number' => $request->string('reg_number'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function getUser(string $email)
    {
        if (!User::emailExists($email)) {
            $tempPassword = Str::random(8);

            return User::query()->create([
                'email' => $email,
                'temporary_password' => $tempPassword,
                'password' => $tempPassword,
                'is_admin' => true
            ]);
        }

        return User::getUserByEmail($email);
    }

    private function notifyUser(User $user, bool $isNew): void
    {
        if ($isNew) {
            $message = "Welcome! Your temporary password is: {$user->temporary_password}";
        } else {
            $message = "You have been granted admin privileges.";
        }

        Mail::raw($message, function ($mail) use ($user) {
            $mail->to($user->email)
                ->subject('Account Information');
        });
    }
}
