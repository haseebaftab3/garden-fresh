<div class="page-title" style="background-image: url('{{ asset($image) }}')">
    <div class="container-full">
        <div class="row">
            <div class="col-12">
                <h3 class="heading text-center">{{ $title }}</h3>
                <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                    <li>
                        <a class="link" href="{{ $homeUrl }}">{{ $homeLabel }}</a>
                    </li>
                    <li>
                        <i class="icon-arrRight"></i>
                    </li>
                    <li>{{ $currentPage }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
