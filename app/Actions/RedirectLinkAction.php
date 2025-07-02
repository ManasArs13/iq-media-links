<?php

namespace App\Actions;

use App\Models\Link;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class RedirectLinkAction
{
    public function handle(string $shortLink)
    {
        return DB::transaction(function () use ($shortLink) {
            $link = Link::select('id', 'url')->where('short_url', $shortLink)->where('active', true)->firstOrFail();

            Visit::create([
                'link_id' => $link->id,
                'ip_address' => request()->ip(),
            ]);

            return $link->url;
        });
    }
}
