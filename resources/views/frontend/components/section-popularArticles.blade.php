<div class="popu-places-home">

    @foreach(\App\Models\BlogArticle::where('id', '<>', $article->id)->inRandomOrder()->limit(4)->get() as $article)

        <div class="col-md-6 col-sm-6 col-xs-12 place">
            <a href="{{ route('article', ['id' => $article->slug]) }}"><h3>{{ $article->name }}</h3></a>
            <div class="col-md-6 col-sm-12 col-xs-12"> <img src="{{ asset(cropImage($article->image, 250, 230)) }}" alt="" /> </div>
            <div class="col-md-6 col-sm-12 col-xs-12">

                <p style="padding: 0">{{ $article->description_short }}</p>
                <div class="p2_book">
                    <ul>
                        <li><a href="{{ route('article', ['slug' => $article->slug]) }}" class="link-btn">Read more</a> </li>
                    </ul>
                </div>
            </div>
        </div>
@if($loop->index %2 == 1)
    </div>
    <div class="popu-places-home">
@endif
    @endforeach
</div>