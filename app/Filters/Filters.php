<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;
    protected $builder;

    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->filters as $filter) {
            if($this->hasFilter($filter)) {
                $this->$filter($this->request->$filter);
            }
        }

        return $this->builder;
    }

    /**
     * @param $filter
     * @return bool
     */
    protected function hasFilter($filter)
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}