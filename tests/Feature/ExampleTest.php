<?php

use Database\Seeders\RoleSeeder;

it('returns a successful response', function () {
    $this->seed(RoleSeeder::class);

    $response = $this->get('/');

    $response->assertStatus(200);
});
