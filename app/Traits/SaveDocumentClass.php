<?php

namespace app\Traits;

use Illuminate\Support\Facades\Storage;

trait SaveDocumentClass {

    private function saveDocument($username, $name, $document)
    {
        $filename     = $document->getClientOriginalName();
        $filenameInfo = pathinfo($filename);
        $fullname     = $username.'_'.$name.'.'.$filenameInfo['extension'];
        Storage::disk("documents")->putFileAs($username, $document, $fullname);
        return $fullname;
    }

    private function saveCall($slug, $document)
    {
        $filename     = $document->getClientOriginalName();
        $filenameInfo = pathinfo($filename);
        $fullname     = $slug.'.'.$filenameInfo['extension'];
        Storage::disk("public")->putFileAs('convocatorias/'.$slug ,$document, $fullname);
        return $fullname;
    }

    private function saveCover($slug, $cover)
    {
        $filename     = $cover->getClientOriginalName();
        $filenameInfo = pathinfo($filename);
        $fullname     = $slug.'.'.$filenameInfo['extension'];
        Storage::disk("public")->putFileAs('convocatorias/'.$slug ,$cover, $fullname);
        return $fullname;
    }

    private function renameFile($slug, $documentfile, $newTitle) {
        $ext = pathinfo(public_path().'archivos/convocatorias/'.$slug.'/'.$documentfile , PATHINFO_EXTENSION);
        Storage::disk("public")->move('convocatorias/'.$slug.'/'.$documentfile, 'convocatorias/'.$slug.'/'.$newTitle.'.'.$ext);
        $document = $newTitle.'.'.$ext;
        return $document;
    }

    private function DeleteCall($slug, $document)
    {
        Storage::disk("public")->delete('convocatorias/'.$slug.'/'.$document);
    }

    private function moveFiles($slug, $newTitle)
    {
        Storage::disk('public')->move('convocatorias/'.$slug, 'convocatorias/'.$newTitle);
    }

}
