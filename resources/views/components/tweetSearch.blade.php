@push('css')
    <link href="{{ asset('css/tweet_search.css') }}" rel="stylesheet">
@endpush

<div class="tweet_search">
    検索フォーム
    <form id="searchForm" action="/tweet/search" method="POST">
        @csrf
        <input type="text" name="keyword" placeholder="キーワードを入力">
        <input type="text" name="hash_tag" placeholder="ハッシュタグを入力">
        <input type="text" name="exclude_keyword" placeholder="除外ワードを入力">
        <br>
        <td align="right"><b>添付ファイル</b></td>
        <br>
        <b>指定なし：</b><input type="radio" name="include_media" value='off' checked="checked">
        <b>画像 ：</b><input type="radio" name="include_media" value='image'>
        <b>動画 ：</b><input type="radio" name="include_media" value='video'>
        <br>
        <b>リツイートを</b>
        <br>
        <b>含めない ：</b><input type="radio" name="include_retweet" value='off' checked="checked">
        <b>含める ：</b><input type="radio" name="include_retweet" value='on'>
        <br>
        {{-- <td align="right"><b>フォロワーのみ：</b></td>
        <input type="checkbox" name="follower_tweets" value=true>
        <br>
        <td align="right"><b>フォロー中のみ：</b></td>
        <input type="checkbox" name="follow_tweets" value=true>
        <br> --}}
        <input type="text" name="favorite_num" placeholder="いいね数を指定">
        <input type="text" name="retweet_num" placeholder="リツイート数を指定">
        <input type="submit" value="検索">
    </form>
</div>