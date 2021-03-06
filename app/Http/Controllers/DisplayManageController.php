<?php

namespace App\Http\Controllers;

use Image;
use Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Display;
use App\DisplayImage;

class DisplayManageController extends Controller
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
    public function index(Request $request)
    {
        $displays = Display::all();

        if($request->get('display'))
        {
            $displayImages = $this->getDisplayImagesByID($request->get('display'));

            return view('display-manage')
                ->withDisplays($displays)
                ->withDisplayImages($displayImages)
                ->withDisplayID($request->get('display'));
        }

        return view('display-manage')->withDisplays($displays);
    }

    public function delete($id)
    {
        try {
            $displayImages = DisplayImage::find($id);
            $displayImages->delete();

            return redirect()->back()->with('success', "ลบสไลด์สำเร็จ");
        } catch(Exception $exception) {
            return redirect()->back()->with('error', "ไม่สามารถลบสไลด์ได้" . $exception->message);
        }
    }

    private function getDisplayImagesByID($id)
    {
        if($id == 0)
            return redirect()->back();

        $display = Display::find($id);
        
        switch($display->name) {
            case 'Mandarin Front':
            case 'Mandarin A':
            case 'Mandarin BUD':
            case 'Mandarin C':
            case 'Mandarin B':
                $displayImages = DisplayImage::where('display_id', $id)
                    ->get();
                break;
            case 'Mandarin M':
            case 'Mandarin P':
                $displayGroupIds = Display::where('name', 'Mandarin M')->orWhere('name', 'Mandarin P')->pluck('id');
                $displayImages = DisplayImage::whereIn('display_id', $displayGroupIds)
                    ->get();
                break;
            default:
                $displayGroupIds = Display::where('name', '<>', 'Mandarin Front')->pluck('id');
                $displayImages = DisplayImage::whereIn('display_id', $displayGroupIds)
                    ->get();
                break;
        }

        return $displayImages;
    }
}