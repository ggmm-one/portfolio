<?php

namespace App\Http\Controllers;

use App\EvaluationScore;
use App\Http\Requests\SettingRequest;
use App\Setting;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $this->authorize('view', $setting);

        return view('settings.edit', compact('setting'));
    }

    public function update(SettingRequest $request)
    {
        $setting = Setting::first();
        $this->authorize('update', $setting);
        $setting->fill($request->validated());
        if ($setting->isDirty('evaluation_max') && EvaluationScore::where('score', '>', $setting->evaluation_max)->exists()) {
            Session::flash('flash-warning', 'Cannot change Evaluation Highest Score as there are evaluations assigned with higher values. Please change any evaluation higher than the new score and try again.');
        } else {
            $setting->save();
        }

        return Redirect::route('settings.index', [$setting]);
    }
}
