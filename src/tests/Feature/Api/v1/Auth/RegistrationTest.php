<?php

namespace Tests\Feature\Api\v1\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_successfully_registration_a_new_user()
    {
        $data = [
            'name' =>                  'test_user',
            'email' =>                 'tes_user@gmail.com',
            'password' =>              'Lfdjfu23klfy10381',
            'password_confirmation' => 'Lfdjfu23klfy10381',
        ];

        $response = $this->postJson('/api/v1/auth/registration', $data);

        $response->assertStatus(200)
            ->assertJson([
                'name'              => 'test_user',
                'email'             => 'tes_user@gmail.com',
                'email_verified_at' => null,
            ]);
    }

    public function test_registration_a_new_user_already_exists()
    {
        $data = [
            'name' =>                  'test_user',
            'email' =>                 'tes_user@gmail.com',
            'password' =>              'Lfdjfu23klfy10381',
            'password_confirmation' => 'Lfdjfu23klfy10381',
        ];

        $this->postJson('/api/v1/auth/registration', $data);
        $response = $this->postJson('/api/v1/auth/registration', $data);

        $response->assertStatus(422);
    }

    public function test_registration_a_new_user_validation_name_failed()
    {
        $data = [
            'name' =>                  'te',
            'email' =>                 'tes_user@gmail.com',
            'password' =>              'Lfdjfu23klfy10381',
            'password_confirmation' => 'Lfdjfu23klfy10381',
        ];

        $response = $this->postJson('/api/v1/auth/registration', $data);
        $response->assertStatus(422);
    }

    public function test_registration_a_new_user_validation_email_failed()
    {
        $data = [
            'name' =>                  'test_user',
            'email' =>                 '123@',
            'password' =>              'Lfdjfu23klfy10381',
            'password_confirmation' => 'Lfdjfu23klfy10381',
        ];

        $response = $this->postJson('/api/v1/auth/registration', $data);
        $response->assertStatus(422);
    }

    public function test_registration_a_new_user_validation_password_confirmation_failed()
    {
        $data = [
            'name' =>                  'test_user',
            'email' =>                 '123@',
            'password' =>              'Lfdjfu23klfy10381',
            'password_confirmation' => 'Lfdjfu2381',
        ];

        $response = $this->postJson('/api/v1/auth/registration', $data);
        $response->assertStatus(422);
    }
}
