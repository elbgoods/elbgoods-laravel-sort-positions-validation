<?php

namespace Elbgoods\SortPositionsRule\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class SortPositionsRule implements Rule
{
    protected string $sortPositionField;
    protected int $startValue;

    public function __construct(string $sortPositionField, int $startValue = 1)
    {
        $this->sortPositionField = $sortPositionField;
        $this->startValue = $startValue;
    }

    /**
     * {@inheritdoc}
     */
    public function passes($attribute, $value)
    {
        if ($value === []) {
            return true;
        }

        $sortPositionValues = collect($value)->pluck($this->sortPositionField)->sort();

        $currentSortPositionValue = $this->startValue;
        foreach ($sortPositionValues as $sortPositionValue) {
            if (! is_int($sortPositionValue)) {
                return false;
            }

            if ($currentSortPositionValue !== $sortPositionValue) {
                return false;
            }

            $currentSortPositionValue++;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function message()
    {
        return Lang::get('sortPositionsRule::validation.sort_positions');
    }
}
