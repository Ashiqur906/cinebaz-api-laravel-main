<?php
namespace App\Traits;
use Cinebaz\Media\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Cinebaz\Member\Models\Member;

trait ImageSaveTrait{

    
    private function upload($request)
    {
      
        // Get file from request 
        $file = $request->file('file');
       
        // Get filename with extension
        $filenameWithExt = $file->getClientOriginalName();

        // Get file path
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Remove unwanted characters
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);

        // Get the original image extension
        $extension = $file->getClientOriginalExtension();

        // Create unique file name
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        // Refer image to method resizeImage
        $save = $this->resizeImage($file, $fileNameToStore, $request);

        // return $save;
    }

    public function resizeImage($file, $fileNameToStore, $request)
    {
        $date = date('Y-m');
        $folder_name = str_replace(':', '', $date);
        $member =auth()->user();
        // $name = $request->get('name');
        // $size = $request->get('size');
        $attributes = [
            'imageable_id' => $member->id,
            'imageable_type' => Member::class,
            'name' => null,
            'file_name' => null,
            'featured' => false,
            'mime_type' => null,
            'remarks' => null,
            'sort_by' => null,
            'is_active' => 'Yes',
            // 'modified_by' => auth('web')->user()->id,
        ];
       
        $sizes = [
            'small' => [100, 100],
            'medium' => [150, 150],
            'full' => [600, 600],
            'thumbnail' => [300, 300],
        ];
        


        foreach ($sizes as $key => $size) {
            // Resize image
            $resize = Image::make($file)->fit($size[0], $size[1])->encode('jpg');
            // Create hash value
            $hash = md5($resize->__toString());
            // Prepare qualified image name
            $image = $hash . "jpg";
            // Put image to storage
            $save = Storage::put("public/dropzon/{$folder_name}/{$key}/{$fileNameToStore}", $resize->__toString());

            if ($save) {
                $attributes[$key] = "dropzon/{$folder_name}/{$key}/{$fileNameToStore}";
            }
        }

       if($member->profile_image){
        $insert = Picture::where('id' , $member->profile_image->id)->update($attributes);
       }else{
        $insert = Picture::create($attributes);
       }
      
       

    
    }


}