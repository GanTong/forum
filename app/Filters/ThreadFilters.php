<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilters
{
    /**
     * @var Request
     */
    protected $request;
    protected $builder;

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

        if ($this->request->has('by')) {
            $this->by($this->request->by);
        }

        return $this->builder;
    }

    /**
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}