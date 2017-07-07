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

    public function download($id) {
        $file = File::where('public_id', $id)->first();
        if (! $file) {
            abort(404);
        }

        $path = storage_path() . '/file/' . $file->name;
        file_put_contents($path, md5($id));

        return response()->download($path, $file->name, [
            'Content-Type: text/plain'
        ])->deleteFileAfterSend(true);
    }
}
