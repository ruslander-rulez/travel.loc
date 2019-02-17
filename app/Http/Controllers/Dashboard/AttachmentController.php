<?php

namespace App\Http\Controllers\Dashboard;

use App\Application\Attachment\RegisterNewAttachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function create(Request $request) {
        $this->validate($request, [
            "file" => "required|file"
        ]);
        return $this->dispatch(new RegisterNewAttachment($request->file("file")));

    }
}