<?php

namespace Tests;

use App\Models\Loan;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessfulResponseWithAllModels()
    {
        $data = [
            'data' => Loan::all()
        ];
        $data = json_encode($data);

        $this->get('/api/loans');

        $this->assertEquals($data, $this->response->getContent());
    }

    public function testSuccessfulResponseWithOneModel()
    {
        $model = Loan::create([
            'name' => 'test',
            'summ' => 10000,
            'client_id' => 10
        ]);

        $data = [
            'data' => Loan::find($model->id)
        ];
        $data = json_encode($data);

        $this->get("/api/loans/{$model->id}");

        $this->assertJson($data, $this->response->getContent());
    }

    public function testSuccessfulResponseOnModelCreation()
    {
        $data = [
            'name' => 'test',
            'summ' => 15000,
            'client_id' => 100
        ];

        $response = $this->call('POST', '/api/loans', $data);

        $this->assertEquals(201, $response->status());
    }

    public function testSuccessfulResponseOnModelUpdate()
    {
        $data = [
            'name' => 'test_create',
            'summ' => 20000,
            'client_id' => 100
        ];

        $model = new Loan();
        $model->fill($data)->save();

        $response = $this->call('PUT', "/api/loans/{$model->id}", ['name' => 'test_create_updated']);

        $updated = Loan::findOrFail($model->id);

        $this->assertNotEquals($data['name'], $updated->name);
        $this->assertEquals(200, $response->status());
    }

    public function testSuccessfulResponseOnModelDeletion()
    {
        $model = Loan::create([
            'name' => 'test_delete',
            'summ' => 50000,
            'client_id' => 65
        ]);

        $response = $this->call('DELETE', "/api/loans/{$model->id}");

        $this->assertEquals(204, $response->status());
    }
}
