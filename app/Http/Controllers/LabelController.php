<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use IssueTracker\Label;

class LabelController extends Controller
{
    public function getIndex()
    {
        $labels = Label::all();

        return view('issue.label', compact('labels'));
    }

    public function postStore(Request $request)
    {
        $label = Label::create([
            'name'  => $request->get('name'),
            'color' => $request->get('color'),
        ]);
        if ($label) {
            $response = [
                'status' => 'success',
                'msg'    => 'Label create successfully!',
            ];
        } else {
            $response = [
                'status' => 'error',
                'msg'    => 'Label create failed!',
            ];
        }

        return \Response::json($response);
    }

    public function postUpdate(Request $request)
    {
        $label = Label::where('id', $request->get('id'));
        $label->update([
            'name'  => $request->get('name'),
            'color' => $request->get('color'),
        ]);
    }

    public function postDestroy(Request $request)
    {
        $label = Label::where('id', $request->get('id'));
        $label->delete();
        if (!$label) {
            $response = [
                'status' => 'success',
                'msg'    => 'Label delete successfully!',
            ];
        } else {
            $response = [
                'status' => 'error',
                'msg'    => 'Label delete failed!',
            ];
        }

        return \Response::json($response);
    }
}
