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
        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->save();

        if($request->hasFile('bgimage'))
            $this->saveBgImage($request, $displayImage->id);

        if($request->hasFile('signage1'))
            $this->saveimage1Image($request, $displayImage->id);

        if($request->hasFile('signage2'))
            $this->saveimage2Image($request, $displayImage->id);

        if($request->hasFile('video1'))
            $this->saveVideo1($request, $displayImage->id);
        
        if($request->hasFile('video2'))
            $this->saveVideo2($request, $displayImage->id);

        return redirect()->back()->with('status', "บันทึกสำเร็จ");
    }
    
    private function saveBgImage(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);

        $bgimage = $request->file('bgimage');
        $name = 'bgimage_' . $id . '.jpg';
        $img = Image::make($bgimage->getRealPath());
        $img->resize(1920, 1080, function ($constraint) {
            $constraint->aspectRatio();            
        });
        $img->stream();
        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);

        $displayImage->bg_path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }
    
    private function saveimage1Image(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);

        $image1 = $request->file('signage1');
        $name = 'signage1_' . $id . '.jpg';
        $img = Image::make($image1->getRealPath());
        $img->resize(820, 1505, function ($constraint) {
            $constraint->aspectRatio();            
        });
        $img->stream();
        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);

        $displayImage->signage1_path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }
    
    private function saveimage2Image(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);

        $image2 = $request->file('signage2');
        $name = 'signage2_' . $id . '.jpg';
        $img = Image::make($image2->getRealPath());
        $img->resize(820, 1505, function ($constraint) {
            $constraint->aspectRatio();            
        });
        $img->stream();
        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);

        $displayImage->signage2_path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }

    private function saveVideo1(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);

        $video1 = $request->file('video1');
        $name = 'video1_' . $id . '.' . $request->video1->getClientOriginalExtension();
       
        Storage::disk('public_images')->putFileAs($displayImage->display_id, $video1, $name);

        $displayImage->video1_path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }

    private function saveVideo2(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);

        $video2 = $request->file('video2');
        $name = 'video2_' .$id . '.' . $request->video2->getClientOriginalExtension();
       
        Storage::disk('public_images')->putFileAs($displayImage->display_id, $video2, $name);

        $displayImage->video2_path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }
}