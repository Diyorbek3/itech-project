<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="@lang('messages.meta_description')">
    <meta name="author" content="@lang('messages.meta_author')">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="@lang('messages.og_site_name')" /> <!-- website name -->
    <meta property="og:site" content="@lang('messages.og_site')" /> <!-- website link -->
    <meta property="og:title" content="@lang('messages.og_title')" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="@lang('messages.og_description')" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="@lang('messages.og_image')" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="@lang('messages.og_url')" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>@lang('messages.contact_title')</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="/css/swiper.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="/images/logo.png">
    @yield('styles')

</head>
    <body>
        <div class="container">
            @include('components.header')
            @yield('content')
            @include('components.footer')
         
        </div>

            @yield('scripts')

        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
