<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Весь функционал который тут написанный, можно разделить и вынести бизнес логику в Services
class UrlShortController extends Controller
{
    protected function checkValidUrl($url)
    {
        if ($url->transitions != 0 and $url->count >= $url->transitions) {
            return false;
        }
        if (Carbon::now() > $url->created_at->addHour($url->time_of_action))
        {
            return false;
        }
        return true;
    }

    public function index()
    {
        return view('shortUrl');
    }

    public function getShortUrl($id)
    {
        $shortUrl = Url::where('id', $id)->first();
        return view('shortUrl', compact('shortUrl'));
    }

    public function createShortUrl(Request $request)
    {
        //
        $request->validate([
            'link' => 'required|url',
            'time_of_action' => 'max:24'
        ]);

        $link = [
            'url' => $request->link,
            'short_url' => Str::random(8),
            'transitions' => $request->transitions ?? 0,
            'time_of_action' => $request->time_of_action,
        ];

        $id = Url::create($link);

        return redirect()->route('get.short.url', ['id' => $id->id]);
    }

    public function shortUrl($shortUrl)
    {
        $find = Url::where('short_url', $shortUrl)->first();
        if (!$this->checkValidUrl($find)) {
            return view('404');
        }
        $find->count++;
        $find->save();
        return redirect($find->url);
    }
}
