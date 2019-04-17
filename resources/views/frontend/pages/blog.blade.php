@extends('frontend.layouts.main')

@section('title')Blog | {{env('APP_NAME')}}@endsection

@push('after_styles')

@endpush

@section('content')

    <!--====== ALL POST ==========-->
    <section>
        <div class="rows inn-page-bg com-colo">
            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">
                <!-- TITLE & DESCRIPTION -->
                <div class="spe-title col-md-12">
                    <h2>Holiday Tour <span>Blog</span> Posts</h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"></div>
                        <div class="tl-3"></div>
                    </div>
                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                </div>
                <!--===== POSTS ======-->
                <div class="rows">
                    @foreach($articles as $article)
                        <div class="posts">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if($article->image)<img src="{{ asset(cropImage($article->image, 550, 353)) }}" alt="{{ $article->name }}" /> @endif
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h3>{{ $article->name }}</h3>
                                <h5><span class="post_author">{{ $article->date()->format('jS \\of F, Y') }}</span></h5>
                                <p>{{ $article->description_short }}</p>
                                <a href="{{ route('article', ['slug' => $article->slug ?? $article->id]) }}" class="link-btn">Read more</a> </div>
                        </div>
                    @endforeach
                </div>
                <!--===== POST END ======-->

                <div class="spe-title">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
                @include('frontend.components.section-popularTravelExperiences')
            </div>

        </div>

    </section>


@endsection

@push('after_scripts')

@endpush