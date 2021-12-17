@extends('layouts.master_home')

@section('home_content')

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Portfolio</h2>
    </div>

    <div class="row" data-aos="fade-up">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          @if($multipic_app_count > 0) <!-- The tab App will show if there are images for it --> 
            <li data-filter=".filter-app">App</li>
          @endif
          @if($multipic_card_count > 0) <!-- The tab Card will show if there are images for it --> 
            <li data-filter=".filter-card">Card</li>
          @endif
          @if($multipic_web_count > 0) <!-- The tab Web will show if there are images for it --> 
            <li data-filter=".filter-web">Web</li>
          @endif
        </ul>
      </div>
    </div>

    <div class="row portfolio-container" data-aos="fade-up">                    

      @if($multipic_app_count > 0)

        @foreach($multipic_app as $multipic)

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{ asset($multipic->image) }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{ $multipic->title }}</h4>
              <p>{{ $multipic->description }}</p>
              <a href="{{ asset($multipic->image) }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $multipic->title }}"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        @endforeach
        
      @endif

      @if($multipic_card_count > 0)
        @foreach($multipic_card as $multipic)

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{ asset($multipic->image) }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{ $multipic->title }}</h4>
              <p>{{ $multipic->description }}</p>
              <a href="{{ asset($multipic->image) }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $multipic->title }}"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        @endforeach
      @endif

      @if($multipic_web_count > 0)
        @foreach($multipic_web as $multipic)

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{ asset($multipic->image) }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>{{ $multipic->title }}</h4>
              <p>{{ $multipic->description }}</p>
              <a href="{{ asset($multipic->image) }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $multipic->title }}"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        @endforeach
      @endif

    </div>

  </div>
</section><!-- End Portfolio Section -->

@endsection