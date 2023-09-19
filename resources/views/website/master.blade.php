<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>My Commerce - @yield('title')</title>
    @include('website.includes.style')
</head>
<body>
@include('website.includes.header')

@yield('body')


@include('website.includes.footer')

@include('website.includes.script')
</body>

</html>
