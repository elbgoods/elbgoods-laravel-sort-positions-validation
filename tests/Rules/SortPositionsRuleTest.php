<?php

namespace Elbgoods\LaravelSortPositionsValidation\Tests\Rules;

use Elbgoods\LaravelSortPositionsValidation\Rules\SortPositionsRule;
use Elbgoods\LaravelSortPositionsValidation\Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final class SortPositionsRuleTest extends TestCase
{
    /**
     * @test
     */
    public function it_passes_when_array_is_empty(): void
    {
        $rule = new SortPositionsRule('position');

        $this->assertTrue($rule->passes('data', []));
    }

    /**
     * @test
     */
    public function it_passes_single_item_with_start_sort_position_of_1(): void
    {
        $rule = new SortPositionsRule('position');

        $data = [
            [
                'position' => 1,
            ],
        ];

        $this->assertTrue($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_passes_single_item_with_custom_start_sort_position(): void
    {
        $startValue = rand(-100, 100);
        $rule = new SortPositionsRule('position', $startValue);

        $data = [
            [
                'position' => $startValue,
            ],
        ];

        $this->assertTrue($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_passes_two_items_with_sort_position_sequence_beginning_with_1(): void
    {
        $rule = new SortPositionsRule('position');

        $data = [
            [
                'position' => 1,
            ], [
                'position' => 2,
            ],
        ];

        $this->assertTrue($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_passes_two_items_with_sort_position_sequence_beginning_with_custom_start_position(): void
    {
        $startValue = rand(-100, 100);
        $rule = new SortPositionsRule('position', $startValue);

        $data = [
            [
                'position' => $startValue,
            ], [
                'position' => $startValue + 1,
            ],
        ];

        $this->assertTrue($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_passes_three_items_with_unordered_position_sequence_values(): void
    {
        $rule = new SortPositionsRule('position');

        $data = [
            [
                'position' => 1,
            ], [
                'position' => 3,
            ], [
                'position' => 2,
            ],
        ];

        $this->assertTrue($rule->passes('data', $data));
    }

    /**
     * @test
     * @dataProvider nonIntValues
     */
    public function it_fails_when_sort_position_has_non_int_values($value): void
    {
        $rule = new SortPositionsRule('position');
        $this->assertFalse($rule->passes('data', [
            'position' => $value,
        ]));
    }

    /**
     * @test
     */
    public function it_fails_when_sort_position_has_values_less_then_the_start_value(): void
    {
        $startValue = rand(-100, 100);
        $rule = new SortPositionsRule('position', $startValue);

        $data = [
            [
                'position' => $startValue,
            ], [
                'position' => $startValue - 1,
            ],
        ];

        $this->assertFalse($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_fails_with_one_item_with_other_position_then_the_start_position(): void
    {
        $startValue = rand(-100, 100);
        $rule = new SortPositionsRule('position', $startValue);

        $data = [
            [
                'position' => $startValue + 1,
            ],
        ];

        $this->assertFalse($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_fails_when_sort_position_sequence_has_gaps(): void
    {
        $startValue = rand(-100, 100);
        $rule = new SortPositionsRule('position', $startValue);

        $data = [
            [
                'position' => $startValue,
            ], [
                'position' => $startValue + 3,
            ],
        ];

        $this->assertFalse($rule->passes('data', $data));
    }

    /**
     * @test
     */
    public function it_generates_correct_message(): void
    {
        $validator = Validator::make([
            'data' => [
                'position' => 0,
            ],
        ], [
            'data' => new SortPositionsRule('position'),
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $this->assertEquals('data has incorrect sorting.', $e->errors()['data'][0]);
        }
    }

    public function nonIntValues(): array
    {
        return [
            [null],
            [1.2],
            ['hallo'],
            [[]],
        ];
    }
}
