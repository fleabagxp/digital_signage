<?php

namespace App\Http\Controllers;

use Image;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DemoController extends Controller
{
    /**
     * To display the show page
     *
     * @return \Illuminate\Http\Response
     */
    public function showJqueryImageUpload() 
    {
        return view('demos.jqueryimageupload');
    }

    /**
     * To handle the comming post request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveJqueryImageUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slip' => 'required|image',
        ]);

        if ($validator->fails()) {
            return $validator->errors();            
        }

        $status = "";

        if ($request->hasFile('slip')) {
            $image = $request->file('slip');
            // Rename image
            $filename = time().'.'.$image->guessExtension();

            $img = Image::make($request->file('slip')->getRealPath());
            $img->rotate(-$request->rotate);

            $img->stream();

            Storage::disk('public_images')->put($filename, $img);

            $status = "uploaded";            
        }
        
        return response($status,200);
    }
};