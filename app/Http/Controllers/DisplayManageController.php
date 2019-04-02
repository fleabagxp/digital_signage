<?php

namespace App\Http\Controllers;

use Image;
use Validator;
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

    public function getDisplayImagesByID($id)
    {
        if($id == 0)
            return redirect()->back();

        $display = Display::find($id);
        
        switch($display->name) {
            case 'Mandarin Front':
            case 'Mandarin A':
            case 'Mandarin BUD':
            case 'Mandarin C':
                $displayImages = DisplayImage::where('display_id', $id)
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