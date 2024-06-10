<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Person\Entities\Person;
use App\Domain\Person\Repositories\PersonRepositoryInterface;
use App\Domain\Person\ValueObjects\PersonDocument;
use App\Domain\Person\ValueObjects\PersonId;
use App\Domain\Person\ValueObjects\PersonName;
use App\Domain\Person\ValueObjects\PersonStatus;
use App\Domain\Person\ValueObjects\PersonType;
use Illuminate\Support\Facades\DB;
use App\Models\Person as ModelPerson;

class EloquentPersonRepository implements PersonRepositoryInterface
{
    public function save(Person $person): ?Person
    {
        //Todo
        //Implement an object model instance and save or update within database, after that, return the object person implementation
        $personId = (string) $person->getId();
        $personId = (int) $personId;
        if ($personId > 0) {
            //update
            $person = ModelPerson::where('id', '=', $personId)->first();
            $person->updated([
                'name' => $person->getName(),
                'document' => $person->getDocumen(),
                'person_type' => $person->getType(),
                //'users_create_id'
                //'users_update_id'   
            ]);

            $result = $person;
        } else {
            //create
            $result = ModelPerson::create([
                'name' => $person->getName(),
                'document' => $person->getDocumen(),
                'person_type' => $person->getType(),
                //'users_create_id'
                //'users_update_id'   
            ]);
            $person->setId(new PersonId($result->id));
        }

        return $this->findById($person->getId());
    }
    public function findById(PersonId $id): ?Person
    {
        $person = DB::table('people')->where('id', '=', (string)$id)->first();
        if ($person) {
            $objPerson = new Person();
            $objPerson->setId(new PersonId($person->id));
            $objPerson->setName(new PersonName($person->name));
            $objPerson->setDocument(new PersonDocument($person->document));
            $objPerson->setType(new PersonType($person->person_type));

            return $objPerson;
        }
        return null;
    }
}
