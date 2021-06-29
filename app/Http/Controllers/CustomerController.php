<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     *  Show customer data
     */
    public function index(): JsonResponse
    {
        $customers = app(CustomerRepository::class)->list();

        return response()->json($customers, 200);
    }

    /**
     * show custoemr data base on id
     */
    public function show(int $id): JsonResponse
    {
        $customer = app(CustomerRepository::class)->show($id);
        return response()->json($customer, 200);
    }
}
