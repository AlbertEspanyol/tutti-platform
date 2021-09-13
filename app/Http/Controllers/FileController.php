<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;

class FileController extends Controller
{
    public function get(){
        return FileUpload::orderBy('created_at', 'DESC')->get();
    }

    public function upload(Request $request, $id, $name){

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileUpload = new FileUpload;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_ext = substr($file_name, strrpos($file_name, '.')+1);
            $file_path = $request->file('file')->storeAs('uploads/' . $id, $id . '_' . $name . '.' . $file_ext, 'public');

            $fileUpload->name = $id . '_' . $name . '.' . $file_ext;
            $fileUpload->path = '/storage/' . $file_path;
            $fileUpload->save();

            return $fileUpload;
        }
    }

    public function destroy($id)
    {
        $exisitingItem = FileUpload::find($id);
        if ($exisitingItem) {
            $exisitingItem->delete();
            return "Item deleted";
        }

        return "Item not found";
    }

    public function find($id){
        return FileUpload::find($id);
    }
}
