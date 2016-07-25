<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Input;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $form_data = Input::all();

        $photo = $form_data['img'];

        $original_name = $photo->getClientOriginalName();
        $original_name_without_ext = substr($original_name, 0, strlen($original_name) - 4);

        $filename = $this->sanitize($original_name_without_ext);
        $allowed_filename = $this->createUniqueFilename( $filename );

        $filename_ext = $allowed_filename .'.jpg';

        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode('jpg')->save(public_path('uploads/dish/original/') . $filename_ext );

        if( !$image) {

            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);

        }
        return Response::json([
            'status'    => 'success',
            'url'       => config('web.url') . 'uploads/dish/original/' . $filename_ext,
            'width'     => $image->width(),
            'height'    => $image->height()
        ], 200);
    }

    public function crop()
    {
        $form_data = Input::all();
        $image_url = $form_data['imgUrl'];
//        $image_url = public_path(str_replace(env('URL'),'',$image_url));
        // resized sizes
        $imgW = $form_data['imgW'];
        $imgH = $form_data['imgH'];
        // offsets
        $imgY1 = $form_data['imgY1'];
        $imgX1 = $form_data['imgX1'];
        // crop box
        $cropW = $form_data['width'];
        $cropH = $form_data['height'];
        // rotation angle
        $angle = $form_data['rotation'];

        $filename_array = explode('/', $image_url);
        $filename = $filename_array[sizeof($filename_array)-1];

        $manager = new ImageManager();
        $image = $manager->make( $image_url );
        $image->resize($imgW, $imgH)->rotate(-$angle)->crop($cropW, $cropH, $imgX1, $imgY1)->save(public_path('uploads/dish/crop/') . 'cropped-' . $filename);

        if( !$image) {

            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);

        }

        return Response::json([
            'status' => 'success',
            'url' => config('web.url') . 'uploads/dish/crop/cropped-' . $filename
        ], 200);

    }

    private function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }


    private function createUniqueFilename( $filename )
    {
        $upload_path = public_path('uploads');
        $full_image_path = $upload_path . $filename . '.jpg';

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $image_token = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $image_token;
        }
        return $filename;
    }
}
