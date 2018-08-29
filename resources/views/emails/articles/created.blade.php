<p>
    {{ $article->content }}
    <small>{{ $article->created_at }}</small>
    <br>
    <br>
    <div style="text-align:center;">
        <img src="{{ $message->embed(storage_path('banner.jpg')) }}" alt="" style="width:100px; height:100px;">
    </div>
</p>
