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
        if (! $username = $this->request->by) return $builder;

        return $this->by($builder, $username);

    }

    /**
     * @param $builder
     * @param $username
     * @return mixed
     */
    protected function by($builder, $username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $builder->where('user_id', $user->id);
    }
}