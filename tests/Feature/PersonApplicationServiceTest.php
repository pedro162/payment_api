<?php

namespace Tests\Feature;

use App\Application\Handlers\CreatePersonHandler;
use App\Application\Services\PersonApplicationService;
use App\Infrastructure\Persistence\EloquentPersonRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonApplicationServiceTest extends TestCase
{
    protected PersonApplicationService $personApplicationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testPersonApplicationServiceBootstrap();
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreatePersonService()
    {
        $response = $this->personApplicationService->createPerson(0, 'Pedro');
        $this->assertGreaterThan($response->getId(), 0);
    }

    private function testPersonApplicationServiceBootstrap()
    {
        $objRepo = new EloquentPersonRepository();
        $objHendler = new CreatePersonHandler($objRepo);
        $objSerice = new PersonApplicationService($objHendler);

        $this->personApplicationService = $objSerice;
    }
}
