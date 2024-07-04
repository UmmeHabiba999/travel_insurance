<?php

namespace App\Http\Traits;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Validator;

trait UploadFilesTraits
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    // upload multiple files
    public function uploadFiles($files)
    {
        // $validator = Validator::make($files, [
        //     'files.*' => 'required|max:1024000',
        //     'files' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError(implode(",", $validator->errors()->all()));
        // }
        $fileNames = [];
        if (!empty($files)) {
            foreach ($files as $file) {
                $name = time() . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path('/uploaded_files'), $name);
                $path =  url('public/uploaded_files') . '/' . $name;
                $fileNames[] = $path;


            }
        }
        return $fileNames;
        // return $this->sendResponse('File uploaded successfully.', $fileNames);
    }


    public function uploadSingleFile($file)
    {
        // $validator = Validator::make([
        //     'file' => $file
        // ], [
        //     'file' => 'max:1024000',
        //     'file' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError(implode(",", $validator->errors()->all()));
        // }
            // $file = $request->file('file');
            $name = time() . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('/public/uploaded_files'), $name);
            $path =  url('public/public/uploaded_files') . '/' . $name;
            return [
                'path' => $path,
                'type' => $this->fileType($file),
            ];
    }


    public function fileType($file)
    {
        // Get the file extension
        $extension = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));

        // Video file extensions
        $video_extensions = ['mp4', 'avi', 'mkv', 'flv', 'wmv', 'mov', 'webm'];

        // Audio file extensions
        $audio_extensions = ['mp3', 'ogg', 'm4a', 'flac', 'wav'];

        // Document file extensions
        $document_extensions = ['doc', 'docx', 'pdf', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];

        // Image file extensions
        $image_extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'jfif'];

        if (in_array($extension, $video_extensions)) {
            // It's a video file
            $file_type = 'video';
        } elseif (in_array($extension, $audio_extensions)) {
            // It's an audio file
            $file_type = 'audio';
        } elseif (in_array($extension, $document_extensions)) {
            // It's a document file
            $file_type = 'document';
        } elseif (in_array($extension, $image_extensions)) {
            // It's a image file
            $file_type = 'image';
        } else {
            // Unknown file type
            $file_type = 'text';
        }
        return $file_type;
    }
    public function uplaodThumbnail($base64Image)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        $pathToSave = public_path('thumbnail'); // Change 'images' to the desired folder name
        $baseUrl = url('public/thumbnail');

        if (!file_exists($pathToSave)) {
            mkdir($pathToSave, 0777, true);
        }

        $imageName = uniqid('thumbnail_') . '.png'; // Choose a name for your image
        $imagePath = $pathToSave . '/' . $imageName;
        $imageUrl = $baseUrl .'/'. $imageName;

        file_put_contents($imagePath, $imageData);
        return $imageUrl;
    }
}
