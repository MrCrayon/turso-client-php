<?php

use Tests\TestCase;

uses(TestCase::class);

describe('Batch Operations', function () {
    test('execute multiple statements', function () {
        $batch = "
            CREATE TABLE cities (
                id INTEGER PRIMARY KEY,
                name TEXT,
                population INTEGER
            );
            
            INSERT INTO cities (name, population) VALUES 
                ('Paris', 2161000),
                ('London', 8982000),
                ('Berlin', 3769000);
        ";

        $success = $this->db->executeBatch($batch);
        expect($success)->toBeTrue();

        $result = $this->db->query("SELECT COUNT(*) FROM cities");
        expect($result->fetchArray(LibSQL::LIBSQL_NUM)[0])->toBe(3);
    });
});