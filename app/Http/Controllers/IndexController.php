<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\getCourse;

class IndexController extends Controller
{
    public function First(Request $request)
    {
        $info = $request->all();
        $output = DB::table('str')->where('id',$info['courseid'])->get();
        if(!empty($result)){
            dd($request(0));
        }else{
            $subject = $this->get('http://jwzx.cqupt.edu.cn/jwzxtmp/kebiao/kb_stu.php?xh='.$info['courseid']);
            $pattern = "/<td[^>]+>([\s\S]*?)<\/td>/";
            $subject = $this->deal($subject);
            preg_match_all($pattern,$subject,$output);
            $data[] = $info['courseid'];
            $result = DB:table('str')->where('id',$info['courseid'])->get();
            dd($result[0]);
        }
    }

    private function get($url)
    {
        $curl = curl_init;

        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        
        $subject = curl_exec($curl);
        curl_close($curl);
        return $subject;
    }

    public function deal($subject)
    {
        $subject = str_replace("    ",'',$subject);
        $subject = preg_replace('/<a[^>]*?>(.*?)<\/a>/','',$subject);
        $subject = preg_replace('/\\s/','',$subject);
        $subject = str_replace('<fontcolor=#FF0000></font><br><spanstyle=\'color:#0000FF\'>', '<br>',$subject);
        $subject = preg_replace('/<span[^>]*?>/','',$subject);
        $subject = str_replace('</span><br><b></b>','',$subject);
        $subject = str_replace('</span><divstyle=\'background:#FFFFC0;\'>','',$subject);
        $subject = str_replace('</div><br><b></b>','',$subject);
        $subject = str_replace('<fontcolor=#FF0000>4节连上</font>','4节连上',$subject);
        $subject = preg_replace('/[0-9A-Za-z]+<br>[0-9A-Za-z]+([\\s]+)?[-](?=[C]?[\x{4e00}-\x{9fa5}]+)/u','',$subject);
        $subject = str_replace('<hr>',' ',$subject);
        $subject = str_replace('<br>',' ',$subject);
        $subject = str_replace('地点：','',$subject);
        return $subject;
    }

    public function check()
    {
       if()     
    }

    // private function dealoutputarray($output,$data){
    //     array_shift($output);
    //     array_shift($output);
    //     for ($i=0; $i<=6; $i++)
    //      {
    //         array_pop($output[$i]);
    //         array_splice($output[$i], 0, 1);
    //         array_splice($output[$i], 2, 1);
    //         array_splice($output[$i], 4, 1);
    //         array_splice($output[$i], 6, 13);
    //     }
    //     foreach ($output as $value){
    //         $data[] = $value
    //     }
    //     return $data;

    // }
 }
