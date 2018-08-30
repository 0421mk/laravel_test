<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocsController extends Controller
{
    protected $docs;

    public function __construct(\App\Documentation $docs)
    {
        $this->docs = $docs;
    }

    public function show($file = null)
    {
        // $index = markdown($this->docs->get());
        // $content = markdown($this->docs->get($file ?: 'installation.md'));
        //
        // return view('docs.show', compact('index', 'content'));

        // 라라벨 캐시 저장소
        $index = \Cache::remember('docs.index', 120, function() {
            return markdown($this->docs->get());
        });

        $content = \Cache::remember('docs.{$file}', 120, function() use ($file) {
            return markdown($this->docs->get($file ?: 'installation.md'));
        });

        return view('docs.show', compact('index', 'content'));
    }
}