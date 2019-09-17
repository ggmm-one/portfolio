<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use TiMacDonald\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

abstract class LinkController extends Controller
{
    protected function validateValues(Request $request)
    {
        return $request->validate([
            'title' => Rule::required()->string(1, Link::DD_TITLE_LENGTH)->get(),
            'url' => Rule::required()->url(Link::DD_URL_LENGTH)->get(),
            'sort_order' => Rule::integer(0, Link::DD_SORT_ORDER_MAX)->get()
        ]);
    }

    protected function validateModelLink(Model $model, Link $link, $subtype)
    {
        if ($link->linkable_id != $model->id
            || $link->linkable_type != $model::MORPH_SHORT_NAME
            || $link->linkable_subtype != $subtype)
            abort(404);
    }
}
