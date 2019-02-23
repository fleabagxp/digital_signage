<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use App\Display;
use App\DisplayImage;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $displays = Display::all();

        return view('home')->withDisplays($displays);
    }

    public function save(Request $request)
    {
        //dd($request->all());

        if($request->hasFile('bgimage'))
            $this->saveBgData($request);

        return redirect()->back()->with('status', "บันทึกสำเร็จ");
    }

    private function saveBgData(Request $request)
    {
        $oldBg = DisplayImage::where('name', 'bgimage')
            ->where('display_id', $request->display)
            ->orderBy('id', 'desc')
            ->first();

        $oldBg->delete();

        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->name = 'bgimage';
        $displayImage->position = 'bgimage';
        $displayImage->path = '';
        
        $displayImage->save();

        $this->saveBgImage($request, $displayImage->id);
    }

    private function saveBgImage(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);

        $bgimage = $request->file('bgimage');
        $name = $id . '.jpg';

        $img = Image::make($bgimage->getRealPath());
        $img->resize(480, null, function ($constraint) {
            $constraint->aspectRatio();            
        });

        $img->stream();

        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);

        $displayImage->path = '/images/displays/' .  $name;
        $displayImage->save();
    }
}
