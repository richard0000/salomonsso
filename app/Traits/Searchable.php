<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait SearchableTrait
 *
 * @property array $searchable
 * @property string $table
 * @property string $primaryKey
 * @method   string getTable()
 */

trait Searchable
{
    /**
     * @var array
     */
    protected $operators = [
        'eq'      => '=',
        'matches' => 'LIKE',
        'start'   => 'LIKE',
        'end'     => 'LIKE',
        'in'      => 'IN',
        'lt'      => '<',
        'lteq'    => '<=',
        'gt'      => '>',
        'gteq'    => '>=',
    ];

    /**
     * Creates the search from the defined operators and fields
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string                                $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $search): Builder
    {
        if (!empty($search['filter'])) {
            foreach ($search['filter'] as $filter => $value) {
                list($field, $operator) = $this->prepareFilter($filter);
                $query                  = $this->buildQuery($query, $operator, $field, $value);
            }
        }
        return $query;
    }

    /**
     * Given a filter in the url, explode by '_'
     * where we find a 2 value array, the first is te field, the second, the operator
     *
     * @param  string $filter
     * @return array
     */
    private function prepareFilter(string $filter): array
    {
        $parts = explode('_', $filter);
        $last  = array_pop($parts);
        $parts = array(implode('_', $parts), $last);
        return $parts;
    }

    /**
     * Build the filter for a model, validating the corrections of the operators and the existence of the field
     * in the model and that it is or not searchable. If it is, put the conditions in the "where" of the query
     *
     * @param  Builder $query
     * @param  string  $operator
     * @param  string  $field
     * @param  string  $value
     * @return Builder
     */
    private function buildQuery(Builder $query, string $operator, string $field, string $value): Builder
    {
        if (array_key_exists($operator, $this->operators) && in_array($field, $this->search_bindings)) {
            $value = $this->prepareValue($operator, $value);
            $query = $query->where(\DB::raw("TRIM(" . strtoupper($field) . ")"), $this->operators[$operator], strtoupper($value));
        }
        return $query;
    }

    /**
     * This is only for the "start" and "end" operators, to appending the % for the LIKE if it fits.
     * Otherwise it returns the value without modifying
     *
     * @param  string $operator
     * @param  string $value
     * @return string
     */
    private function prepareValue(string $operator, string $value): string
    {
        if ($operator == 'start') {
            return "{$value}%";
        }
        if ($operator == 'end') {
            return "%{$value}";
        }
        if ($operator == 'matches') {
            return "%{$value}%";
        }
        return $value;
    }
}
