<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Redirect fresh registered user to /favsports.
     * -> vue component for favorite sports choice.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toResponse($request)
    {
        return redirect()->route('favsports.index')
            ->with('freshlyRegistered', true);
    }
}
