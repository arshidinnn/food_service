<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;

class CheckUniqueAssociation implements ValidationRule
{
    protected Model $firstModel;
    protected string $relation;
    protected string $attribute;

    public function __construct(Model $firstModel, string $relationMethod, string $attribute = null)
    {
        $this->firstModel = $firstModel;
        $this->relation = $relationMethod;
        $this->attribute = $attribute ?? "";
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->attribute = $this->attribute ?: $attribute;

        $firstModelRecord = $this->firstModel->where($this->attribute, $value)->first();

        if ($firstModelRecord) {
            $relationExists = call_user_func([$firstModelRecord, $this->relation])->exists();

            if ($relationExists) {
                $fail("The :attribute is already associated with another record.");
            }
        }
    }
}
