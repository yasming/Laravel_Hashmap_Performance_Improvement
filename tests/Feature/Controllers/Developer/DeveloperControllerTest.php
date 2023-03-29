<?php

namespace Tests\Feature\Controllers\Developer;

use App\Models\Candidate\Candidate;
use App\Models\Developer\Developer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Tests\TestCase;

class DeveloperControllerTest extends TestCase
{
    use DatabaseMigrations;

    private Candidate $candidate;
    private Developer $developer;
    private Developer $developer2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->candidate = Candidate::factory(1)->create()->first();
        $this->developer = Developer::factory(1)->create(['email' => $this->candidate->email])->first();
        $this->developer2 = Developer::factory(1)->create()->first();
    }

    public function test_should_return_right_endpoint_values(): void
    {
        $response = $this->get('/api/get-developers-with-uuid')->assertStatus(HttpResponse::HTTP_OK);
        $this->assertEquals([
            [
                "id" => $this->developer->id,
                "name" => $this->developer->name,
                "email" => $this->developer->email,
                "created_at" => $this->developer->created_at->toJson(),
                "updated_at" => $this->developer->updated_at->toJson(),
                "candidateId" => $this->candidate->id,
            ],
            [
                "id" => $this->developer2->id,
                "name" => $this->developer2->name,
                "email" => $this->developer2->email,
                "created_at" => $this->developer2->created_at->toJson(),
                "updated_at" => $this->developer2->updated_at->toJson(),
            ]
        ], $response->json());
    }

    public function test_should_return_right_endpoint_values_for_improved_endpoint(): void
    {
        $response = $this->get('/api/get-developers-with-uuid-improvement')->assertStatus(HttpResponse::HTTP_OK);
        $this->assertEquals([
            [
                "id" => $this->developer->id,
                "name" => $this->developer->name,
                "email" => $this->developer->email,
                "created_at" => $this->developer->created_at->toJson(),
                "updated_at" => $this->developer->updated_at->toJson(),
                "candidateId" => $this->candidate->id,
            ],
            [
                "id" => $this->developer2->id,
                "name" => $this->developer2->name,
                "email" => $this->developer2->email,
                "created_at" => $this->developer2->created_at->toJson(),
                "updated_at" => $this->developer2->updated_at->toJson(),
            ]
        ], $response->json());
    }
}
