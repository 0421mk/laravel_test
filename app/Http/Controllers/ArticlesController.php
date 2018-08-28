<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticlesRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return __METHOD__ . '은(는) Article 컬렉션을 조회합니다.';
        // $articles = \App\Article::get();
        // $articles->load('user');

        // 페이징
        $articles = \App\Article::latest()->paginate(3);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return __METHOD__ . '은(는) Article 컬렉션을 만들기 위한 폼을 담은 뷰를 반환합니다.';
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request)
    {
        // // return __METHOD__ . '은(는) 사용자의 입력한 폼 데이터로 새로운 Article 컬렉션을 만듭니다.';
        // $rules = [
        //   'title' => ['required'],
        //   'content' => ['required', 'min:10'],
        // ];
        //
        // $messages = [
        //   'title.required' => '제목은 필수 입력 항목입니다.',
        //   'content.required' => '본문은 필수 입력 항목입니다.',
        //   'content.min' => '본문은 최소 :min 글자 이상이 필요합니다.',
        // ];
        // // 오류 메시지 사용자화 messages 변수에 담고 $validate 함수에 3번째 인자로 전달
        //
        // $validator = \Validator::make($request->all(), $rules, $messages);
        //
        // if($validator->fails()) {
        //   return back()->withErrors($validator)->withInput();
        // }
        //
        // // 글 저장 코드
        // $article = \App\User::find(1)->articles()->create($request->all());

        // 폼 리퀘스트 클래스 사용
        $article = \App\User::find(1)->articles()->create($request->all());

        if(! $article) {
          return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
        }

        // var_dump('이벤트를 던집니다.');
        // event('article.created', [$article]);
        // var_dump('이벤트를 던졌습니다.');

        // 이벤트 채널 생성
        // var_dump('이벤트를 던집니다.');
        // event(new \App\Events\ArticleCreated($article));
        // var_dump('이벤트를 던졌습니다.');

        //실용적인 이벤트 시스템
        event(new \App\Events\ArticlesEvent($article));

        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return __METHOD__ . '은(는) 다음 기본 키를 가진 Article 모델을 조회합니다.';

        // 예외처리
        $article = \App\Article::findOrFail($id);
        return $article->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return __METHOD__ . '은(는) 다음 기본 키를 가진 Article 모델을 수정하기 위한 폼을 담은 뷰를 반환합니다.';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return __METHOD__ . '은(는) 사용자의 입력한 폼 데이터로 다음 기본 키를 가진 Article 모델을 수정합니다.';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return __METHOD__ . '은(는) 다음 기본 키를 가진 Article 모델을 삭제합니다.';
    }
}
