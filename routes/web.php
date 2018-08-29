<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('articles', 'ArticlesController');

// DB::listen(function ($query){
//   var_dump($query->sql);
// });

Auth::routes();

Route::get('/test', 'HomeController@index')->name('home');

Route::get('mail', function() {
  $article = App\Article::with('user')->find(1);

    // 기본 메일
  return Mail::send(
    'emails.articles.created',
    compact('article'),
    function ($message) use ($article) {
        $message->from('0421mk@example.com', 'yoonwoo');
        $message->to('0421mk@gmail.com');
        $message->subject('새 글이 등록되었습니다 행님 -' . $article->title);
        $message->attach(storage_path('banner.jpg'));
    }
  );

  // 텍스트 메일
  // return Mail::send(
  //   ['text'=>'emails.articles.created-text'],
  //   compact('article'),
  //   function ($message) use ($article) {
  //       $message->to('0421mk@gmail.com');
  //       $message->subject('새 글이 등록되었습니다 ! - '.$article->title);
  //   }
  // );
});
