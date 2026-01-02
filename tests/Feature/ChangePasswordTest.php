<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_change_password_with_correct_current_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $this->actingAs($user)
            ->post(route('settings.password.update'), [
                'current_password' => 'old-password',
                'new_password' => 'new-password',
                'new_password_confirmation' => 'new-password',
            ])
            ->assertSessionHas('success');

        $user->refresh();

        $this->assertTrue(Hash::check('new-password', $user->password));
    }

    public function test_user_cannot_change_password_with_incorrect_current_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $this->actingAs($user)
            ->post(route('settings.password.update'), [
                'current_password' => 'wrong-password',
                'new_password' => 'new-password',
                'new_password_confirmation' => 'new-password',
            ])
            ->assertSessionHasErrors(['current_password']);

        $user->refresh();

        $this->assertTrue(Hash::check('old-password', $user->password));
    }
}
