<?php

namespace App\Http\Middleware;

use App\News;
use Closure;
use Illuminate\Support\Facades\Validator;

class CheckNewsForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make($request->all(), News::rules(), [], News::attributeNames());

        if ($validator->fails()) {
            $request->flash();
            return redirect()->route('admin.news.create')->withErrors($validator->errors());
        }

        return $next($request);
    }
}
