<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryPageController extends Controller
{
    public function entryPage()
    {
        return view('entrypage');
    }

    public function modal(){
        return view('modal');
    }
    
    public function saveImage(Request $request)
    {
        $img = $_POST['image'];
        $folderPath = "C:/Users/develop/CebuTele-Net TimeTracker/cebutele_timetracker/public/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $current = date('YmdHms');
        $fileName = $current . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);
        return back()
        ->with('success','You have successfully upload image.');

        return redirect('login');
    }

}
