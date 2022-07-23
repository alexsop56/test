<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\Interfaces\AdRepositoryInterface;
use App\Models\Ad;
use Illuminate\Testing\Fluent\AssertableJson;

class AdTest extends TestCase
{
    public function testAdRepositoryAll()
    {
        $response = $this->call('GET', "api/ad");

        $response->assertStatus(302);
    }

    public function testIndexAdRequestJson()
    {
        $response = $this->call('GET', "api/ad", ["page" => 1]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => [],
                "pagination" => [],
            ]);
    }

    public function testShowAdRequestJson()
    {
        $ad = Ad::factory()->create();

        $response = $this->call('GET', "api/ad/$ad->id");

        $response
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll("id", "title", "image", "price");
            });
    }

    public function testStoreAdRequestValidation()
    {
        $response = $this->post("/api/ad");

        $response
            ->assertStatus(302);
    }

    public function testStoreAdRequestJson()
    {
        $response = $this->post("/api/ad", ["title" => "Название"]);

        $response->assertStatus(200);
        
        $response_message = $response->getContent();
        $formatted_value = intval($response_message);
        $is_id = is_integer($formatted_value);

        $this->assertTrue($is_id);
    }
}
