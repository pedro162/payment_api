<?php

namespace Tests\Feature;

use App\Application\Handlers\CreatePersonHandler;
use App\Application\Handlers\InfoPersonHandler;
use App\Application\Services\PersonApplicationService;
use App\Domain\Person\Entities\Person;
use App\Infrastructure\Persistence\EloquentPersonRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Person\ValueObjects\PersonType;
use InvalidArgumentException;

class PersonApplicationServiceTest extends TestCase
{
    protected PersonApplicationService $personApplicationService;
    //Test Documentatin: https://www.devmedia.com.br/teste-unitario-com-phpunit/41231#assertgreaterthan-
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

    public function testCreateNaturalPersonService()
    {
        $response = $this->personApplicationService->createPerson(0, 'Pedro', '61224450370', PersonType::PERSON_TYPE_NP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
        $this->assertGreaterThan(0, $idPerson, "It was no possíble to create a natural person");
    }

    public function testCreateNaturalPersonWithInvalidDocumentService()
    {
        $this->expectException(\InvalidArgumentException::class);
        $response = $this->personApplicationService->createPerson(0, 'Pedro', '612.244.503.70', PersonType::PERSON_TYPE_LP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
    }

    public function testCreateNaturalPersonWithInvalidNameService()
    {
        $this->expectException(\InvalidArgumentException::class);
        $response = $this->personApplicationService->createPerson(0, '', '61224450370', PersonType::PERSON_TYPE_LP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
    }

    public function testCreateLegalPersonService()
    {
        $response = $this->personApplicationService->createPerson(0, 'Pedro', '09408500000131', PersonType::PERSON_TYPE_LP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
        $this->assertGreaterThan(0, $idPerson, "It was no possible to create a ligal person");
    }

    public function testCreateLegalPersonWithInvalidDocumentService()
    {
        $this->expectException(\InvalidArgumentException::class);
        $response = $this->personApplicationService->createPerson(0, 'Pedro', '48.508.199/0001-90', PersonType::PERSON_TYPE_LP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
    }

    public function testCreateLigalPersonWithInvalidNameService()
    {
        $this->expectException(\InvalidArgumentException::class);
        $response = $this->personApplicationService->createPerson(0, '', '09408500000131', PersonType::PERSON_TYPE_LP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
    }

    public function testCheckTheInstanceTypeReturnedByCreateLigalPersonServiceMethod()
    {
        $response = $this->personApplicationService->createPerson(0, 'Pedro', '09408500000131', PersonType::PERSON_TYPE_LP);
        $this->assertInstanceOf(Person::class, $response, "The instance type returned by the Service's createPerson method is not an instance of 'App\Domain\Person\Entities\Person'");
    }

    public function testTryToCreateAndLoadASpecificNaturalPerson()
    {
        $response = $this->personApplicationService->createPerson(0, 'Pedro', '09408500000131', PersonType::PERSON_TYPE_LP);
        $idPerson = (string) $response->getId();
        $idPerson = (int) $idPerson;
        $entityPersonObject = $this->personApplicationService->findPersonById($idPerson);
        $idPersonEntityPersonObject = (string) $entityPersonObject->getId();
        $idPersonEntityPersonObject = (int) $idPersonEntityPersonObject;

        $this->assertGreaterThan(0, $idPersonEntityPersonObject, "It was no possible to load the natural person of code \"{$idPersonEntityPersonObject}\"");
    }


    private function testPersonApplicationServiceBootstrap()
    {
        $objRepo = new EloquentPersonRepository();
        $objHendler = new CreatePersonHandler($objRepo);
        $objPersonHendler = new InfoPersonHandler($objRepo);
        $objSerice = new PersonApplicationService($objHendler, $objPersonHendler);

        $this->personApplicationService = $objSerice;
    }
}
