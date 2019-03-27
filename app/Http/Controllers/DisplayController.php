<?php

namespace App\Http\Controllers;

use Image;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Display;
use App\DisplayImage;

class DisplayController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function show($id)
    {
        $display = Display::find($id);
        
        switch($display->name) {
            case 'Mandarin Front':
                $displayImages = DisplayImage::where('display_id', $id);
                break;
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

        if($display->name == 'Mandarin Front')
            return view('display-front')->withDisplay($display)->withDisplayImages($displayImages);

        return view('display')->withDisplay($display)->withDisplayImages($displayImages);
    }
}