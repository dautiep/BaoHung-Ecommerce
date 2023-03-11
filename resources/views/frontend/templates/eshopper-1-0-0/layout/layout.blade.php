<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ @$title_page ?? config('page.title') }}</title>
    <link href="{{ templateAsset('favicon.ico') }}" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ templateAsset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ templateAsset('css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{ templateAsset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <style>
        .image_product {
            object-fit: cover;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    @yield('css')

</head>

<body>
    @include(bladeAsset('components.topbar'))
    @include(bladeAsset('components.navbar'))
    @yield('content')
    @include(bladeAsset('components.footer'))
    @include(bladeAsset('components.scroll_top'))
    @include(bladeAsset('scripts.scripts'))
    @yield('scripts')
    <script>
        $(document).ready(function() {
            // get the img element
            const resizeImage = () => {
                const queryAllImg = document.querySelectorAll('.image_product');
                if (queryAllImg.length < 2) {
                    return;
                }
                const closestDiv = queryAllImg[0];
                var height = closestDiv.height;
                const eachImage = function(array, callback, scope) {
                    for (var i = 0; i < array.length; i++) {
                        callback.call(scope, i, array[i]);
                    }
                };
                eachImage(queryAllImg, function(index, img) {
                    var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    var width = img.width;

                    svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                    svg.setAttribute('width', width);
                    svg.setAttribute('height', height);
                    var svgImg = document.createElementNS('http://www.w3.org/2000/svg', 'image');
                    svgImg.setAttribute('x', 0);
                    svgImg.setAttribute('y', 0);
                    svgImg.setAttribute('width', width);
                    svgImg.setAttribute('height', height);
                    svgImg.setAttributeNS('http://www.w3.org/1999/xlink', 'href', img.src);
                    svg.appendChild(svgImg);
                    img.parentNode.replaceChild(svg, img);
                });

            };
            resizeImage();
        });
    </script>
</body>

</html>
