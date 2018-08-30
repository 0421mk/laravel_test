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

Route::get('markdown', function() {
    $text ="<<<EOT
# 마크다운 예제 1

이 문서는 [마크다운][1]으로 썼습니다. 화면에는 HTML로 변환되어 출력됩니다.

## 순서없는 목록

- 첫 번째 항목
- 두 번째 항목[^1]

[1]: http://daringfireball.net/projects/markdown

[^1]: 두 번째 항목_ http://google.com
EOT";

    return app(ParsedownExtra::class)->text($text);
});

Route::get('docs/{file?}', 'DocsController@show');
