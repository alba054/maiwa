@section('content')
    <!-- CAROUSEL -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="img/s5.jpg" class="d-block w-100" alt="..."> -->

                <svg viewBox='0 0 1024 400' preserveAspectRatio='none'>
                    <defs>
                        <mask id='masker' x='0' y='0' width='1024' height='400'>
                            <polygon points='0,0 1024,0 1024,400 0,400z' fill="#fff" />
                            <path d='<?= $poli ?>' fill="#000" />
                        </mask>
                    </defs>
                    <image href='img/s5.jpg' width='1024' style="mask: url(#masker);">

                </svg>

                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <svg viewBox='0 0 1024 400' preserveAspectRatio='none'>
                    <defs>
                        <mask id='masker2' x='0' y='0' width='1024' height='400'>
                            <polygon points='0,0 1024,0 1024,400 0,400z' fill="#fff" />
                            <path d='<?= $poli ?>' fill="#000" />
                        </mask>
                    </defs>
                    <image href='img/s1.jpg' width='1024' style="mask: url(#masker2);">
                        <!-- <img src="img/s1.jpg" width="1024" style="mask: url(#masker);"> -->
                </svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <svg viewBox='0 0 1024 400' preserveAspectRatio='none'>
                    <defs>
                        <mask id='masker3' x='0' y='0' width='1024' height='400'>
                            <polygon points='0,0 1024,0 1024,400 0,400z' fill="#fff" />
                            <path d='<?= $poli ?>' fill="#000" />
                        </mask>
                    </defs>
                    <image href='img/s3.jpg' width='1024' style="mask: url(#masker3);">
                        <!-- <img src="img/s1.jpg" width="1024" style="mask: url(#masker);"> -->
                </svg>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>

    </div>
@endsection
