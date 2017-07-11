<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class FileController extends Controller
{
    public function index() {
        return view('welcome', [
            'files' => File::orderBy('id')->paginate(5)
        ]);
    }

    public function file($id) {
        $file = File::where('public_id', $id)->first();
        if (! $file) {
            abort(404);
        }

        return view('file', [
            'file' => $file
        ]);
    }

    public function download(Request $request, $id) {
        $file = File::where('public_id', $id)->first();
        if (! $file) {
            abort(404);
        }

        $file->addView($request->getClientIp());

        return response()->download($file->getPath(), $file->name, [
            'Content-Type: text/plain'
        ]);
    }
}
