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
        if($request->hasFile('bgimage'))
            $this->saveBgData($request);

        if($request->hasFile('signage1'))
            $this->saveImage1Data($request);

        if($request->hasFile('signage2'))
            $this->saveImage2Data($request);

        if($request->hasFile('video1'))
            $this->saveVideo1Data($request);
        
        if($request->hasFile('video2'))
            $this->saveVideo1Data($request);

        return redirect()->back()->with('status', "บันทึกสำเร็จ");
    }
    private function saveBgData(Request $request)
    {
        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->name = $request->file('bgimage')->getClientOriginalName();
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
        $img->resize(1920, 1080, function ($constraint) {
            $constraint->aspectRatio();            
        });
        $img->stream();
        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);
        $displayImage->path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }

    private function saveImage1Data(Request $request)
    {
        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->name = $request->file('signage1')->getClientOriginalName();
        $displayImage->position = 'signage1';
        $displayImage->path = '';
        
        $displayImage->save();
        
        $this->saveimage1Image($request, $displayImage->id);
    }
    
    private function saveimage1Image(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);
        $image1 = $request->file('signage1');
        $name = $id . '.jpg';
        $img = Image::make($image1->getRealPath());
        $img->resize(820, 1505, function ($constraint) {
            $constraint->aspectRatio();            
        });
        $img->stream();
        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);
        $displayImage->path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }

    private function saveImage2Data(Request $request)
    {        
        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->name = $request->file('signage2')->getClientOriginalName();
        $displayImage->position = 'signage2';
        $displayImage->path = '';
        
        $displayImage->save();
        
        $this->saveimage2Image($request, $displayImage->id);
    }
    
    private function saveimage2Image(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);
        $image2 = $request->file('signage2');
        $name = $id . '.jpg';
        $img = Image::make($image2->getRealPath());
        $img->resize(820, 1505, function ($constraint) {
            $constraint->aspectRatio();            
        });
        $img->stream();
        Storage::disk('public_images')->put($displayImage->display_id . '/' . $name, $img);
        $displayImage->path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }

    private function saveVideo1Data(Request $request)
    {
        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->name = $request->file('video1')->getClientOriginalName();
        $displayImage->position = 'video1';
        $displayImage->path = '';
        
        $displayImage->save();
        
        $this->saveVideo1($request, $displayImage->id);
    }

    private function saveVideo1(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);
        $video1 = $request->file('video1');
        $name = $id . '.' . $request->video1->getClientOriginalExtension();
       
        Storage::disk('public_images')->putFileAs($displayImage->display_id, $video1, $name);
        $displayImage->path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }

    private function saveVideo2Data(Request $request)
    {
        $displayImage = new DisplayImage();
        $displayImage->display_id = $request->display;
        $displayImage->name = $request->file('video2')->getClientOriginalName();
        $displayImage->position = 'video2';
        $displayImage->path = '';
        
        $displayImage->save();
        
        $this->saveVideo2($request, $displayImage->id);
    }

    private function saveVideo2(Request $request, $id)
    {
        $displayImage = DisplayImage::find($id);
        $video2 = $request->file('video2');
        $name = $id . '.' . $request->video2->getClientOriginalExtension();
       
        Storage::disk('public_images')->putFileAs($displayImage->display_id, $video2, $name);
        $displayImage->path = '/images/displays/' . $request->display . '/' .  $name;
        $displayImage->save();
    }
}