<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      /* PHP 샘플 코드 */
        // 
        // $ch = curl_init();
        // $url = 'http://apis.data.go.kr/1300000/bmggJeongBo/list'; /*URL*/
        // $queryParams = '?' . urlencode('ServiceKey') . '=%2BsCZn816kl4zeAJLDvEncpPKFpQf3LUWGAHnFrDG5cHqa1uOEHcRISj09LC5nW9p4bKiI63X7gdUIGz%2F4gH0hA%3D%3D'; /*Service Key*/
        // $queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /*한 페이지 결과 수*/
        // $queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /*페이지 번호*/
        // $queryParams .= '&' . urlencode('') . '=' . urlencode(''); /**/
        //
        // curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // curl_setopt($ch, CURLOPT_HEADER, FALSE);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        // $response = curl_exec($ch);
        // curl_close($ch);
        //
        // var_dump($response);
        // exit;

        return view('home');
    }
}
