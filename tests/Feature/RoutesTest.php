<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_default_api_url_returns_404_page_not_found()
    {
        $response = $this->get('/api/v1/');

        $response->assertStatus(404);
    }


    public function test_get_request_on_login_url_returns_405_method_not_allowed()
    {
        $response = $this->get('/api/v1/login');

        $response->assertStatus(405);
    }

    public function test_get_request_on_register_url_returns_405_method_not_allowed()
    {
        $response = $this->get('/api/v1/register');

        $response->assertStatus(405);
    }

    public function test_login_on_not_exist_user_will_return_422_unproccesable_data()
    {
        $response = $this->post(
            '/api/v1/login',
            ["email" => "test@gmail.com", "password" => "123", "device_name" => "test"],
            ["Accept" => "application/json"]
        );

        $response->assertStatus(422);
    }

    public function test_register_new_user_will_return_expected_data()
    {
        $path = "../../list-authentication-users.png";
        $image = new UploadedFile(resource_path($path), 'test_image.jpg', "image/png", null, true);
        $response = $this->post(
            '/api/v1/register',
            ["name" => "John George", "email"=>"john@example.com", "password" => "123", "date_of_birth" => "1998-10-01", "image" => $image],
            ["Accept" => "application/json"]
        );
        $content = $response->json()["data"];
        $this->assertArrayHasKey("id", $content);
        $this->assertArrayHasKey("email", $content);
        $this->assertArrayHasKey("date_of_birth", $content);
        $this->assertArrayHasKey("image", $content);
        $response->assertStatus(201);
    }

}
