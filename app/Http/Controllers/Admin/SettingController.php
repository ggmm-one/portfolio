<?php

namespace App\Http\Controllers\Admin;

use App\EvaluationScore;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TiMacDonald\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->fill($this->validateValues($request));
        if ($setting->isDirty('evaluation_max') && EvaluationScore::where('score', '>', $setting->evaluation_max)->exists()) {
            Session::flash('flash-warning', 'Cannot change Evaluation Highest Score as there are evaluations assigned with higher values. Please change any evaluation higher than the new score and try again.');
        } else {
            $setting->save();
        }

        return Redirect::route('admin.settings.edit');
    }

    private function validateValues(Request $request)
    {
        return $request->validate([
            'evaluation_max' => Rule::required()->integer(0, Setting::DD_EVALUATION_MAX)->get()
        ]);
    }
}
