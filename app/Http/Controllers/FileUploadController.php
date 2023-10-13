<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

final class FileUploadController extends Controller
{
    public function process(Request $request)
    {
        // We don't know the name of the file input, so we need to grab
        // all the files from the request and grab the first file.
        /** @var UploadedFile[] $files */
        $files = $request->allFiles();

        if (empty($files)) {
            abort(422, 'No files were uploaded.');
        }

        if (count($files) > 1) {
            abort(422, 'Only 1 file can be uploaded at a time.');
        }

        // Now that we know there's only one key, we can grab it to get
        // the file from the request.
        $requestKey = array_key_first($files);

        // If we are allowing multiple files to be uploaded, the field in the
        // request will be an array with a single file rather than just a
        // single file (e.g. - `csv[]` rather than `csv`). So we need to
        // grab the first file from the array. Otherwise, we can assume
        // the uploaded file is for a single file input and we can
        // grab it directly from the request.
        $file = is_array($request->input($requestKey))
            ? $request->file($requestKey)[0]
            : $request->file($requestKey);

        // Store the file in a temporary location and return the location
        // for FilePond to use.

        $quote_id = 0;

        if (Auth::guard('carrierguard')->check()) {
            $quote_id = Auth::guard('carrierguard')->user()->quote_id;
        } else if (Auth::guard('driverguard')->check()) {
            $quote_id = Auth::guard('driverguard')->user()->quote_id;
        };

        $folder_path = 'tmp/'.$quote_id.'/'.now()->timestamp.'-'.Str::random(20);

        $file_path = $file->store(
            path: $folder_path
        );
        return $file_path;
    }

    public function revert(Request $request)
    {
        $file_path = $request->getContent();
        $directory_path = dirname($file_path);

        Storage::deleteDirectory($directory_path);
    }
}
