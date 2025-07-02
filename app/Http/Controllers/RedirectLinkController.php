<?php

namespace App\Http\Controllers;

use App\Actions\RedirectLinkAction;

class RedirectLinkController extends Controller
{
    public function __invoke($shortUrl, RedirectLinkAction $action)
    {
        $originalUrl = $action->handle($shortUrl);
        
        return redirect()->away($originalUrl);
    }
}
