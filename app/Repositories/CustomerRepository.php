<?php

namespace App\Repositories;

use App\Entities\Customer;
use Illuminate\Support\Facades\Log;
use LaravelDoctrine\ORM\Facades\EntityManager;

class CustomerRepository
{
    private object $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function list(): array
    {
        $query = $this->em::createQueryBuilder()
            ->select(
                "CONCAT(c.first_name, ' ', c.last_name) AS full_name",
                "c.email",
                "c.country"
            )
            ->from(Customer::class, 'c')
            ->getQuery();

        return $query->getArrayResult();

    }

    public function show(int $id): array
    {
        $customer = $this->em::find(Customer::class, $id);

        if (!$customer) {
            return [];
        }

        return $customer->showIdInfo();
    }

}
