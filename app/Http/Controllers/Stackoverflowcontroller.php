<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\StackTags;
class Stackoverflowcontroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function getstackinfo()
    {
        $aStack = StackTags::get();
        $aJsonStack = json_encode($aStack);
        $aPie = StackTags::select('tagname as label','no_of_question as y')->get();
        $aJsonPie = json_encode($aPie);
        
        $aBar1 = StackTags::select('no_of_question as y','tagname as label')->get();
        $aBar1Stack = json_encode($aBar1);
        $aBar2 = StackTags::select('frequent_question as y','tagname as label')->get();
        $aBar2Stack = json_encode($aBar2);
        $aBar3 = StackTags::select('unanswered_question as y','tagname as label')->get();
        $aBar3Stack = json_encode($aBar3);
        
        return view('statistics',compact('aStack','aJsonStack','aJsonPie','aBar1Stack','aBar2Stack','aBar3Stack'));
    }


    function getHTML($url) {
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
