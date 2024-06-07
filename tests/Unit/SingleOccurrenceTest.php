<?php
namespace Tests\Unit;

use App\Helpers\SingleOccurrence;
use Illuminate\Support\Facades\Exceptions;
use Tests\TestCase;

class SingleOccurrenceTest extends TestCase
{
    /**
     * @test
     * @dataProvider validData
     * @return void
     */
    public function test_valid_data($validData): void
    {
        $result = SingleOccurrence::findSingle($validData['numbers']);

        $this->assertEquals($result, $validData['expected_result']);
    }

    /**
     * @test
     * @dataProvider invalidDataMissedParameter
     * @return void
     */
    public function test_invalid_data_missed_parameter($invalidDataMissedParameter): void
    {
        $this->expectException(\ErrorException::class);
        $result = SingleOccurrence::findSingle($invalidDataMissedParameter['numbers']);
    }

    public function validData()
    {
        return [
            'valid numbers' => [
                [
                    'numbers' => [1, 1, 2, 2, 3],
                    'expected_result' => [3]
                ]
            ],
            'valid numbers with non-number' => [
                [
                    'numbers' => [1, 1, 2, 2, 3, 'a'],
                    'expected_result' => [3]
                ]
            ],
            'valid numbers (float)' => [
                [
                    'numbers' => [1.2, 1.2, 2.3, 2.3, 4.5],
                    'expected_result' => [4.5]
                ]
            ],
            'valid numbers (only singles)' => [
                [
                    'numbers' => [1, 2, 3],
                    'expected_result' => [1, 2, 3]
                ]
            ],
            'empty array' => [
                [
                    'numbers' => [],
                    'expected_result' => []
                ]
            ]
        ];
    }

    public function invalidDataMissedParameter()
    {
        return [
            'missed numbers' => [
                [
                    'expected_result' => [1, 2, 3]
                ]
            ]
        ];
    }

}
