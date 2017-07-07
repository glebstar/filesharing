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

        // увеличиваем счётчики
        /*
        // количество всех скачек
        $file->increment('cnt_view');

        // количество оплачиваемых скачек
        if (CheckIps::checkIpsReputation([$request->getClientIp()])) {
            $user = User::where('id', $file->user_id)->first();
            $user->increment('cnt_pay_view');
            $user->save();

            $file->increment('cnt_pay_view');
        }

        $file->save();
        */

        $path = storage_path() . '/file/' . $file->name;
        file_put_contents($path, md5($id));

        return response()->download($path, $file->name, [
            'Content-Type: text/plain'
        ])->deleteFileAfterSend(true);
    }
}
