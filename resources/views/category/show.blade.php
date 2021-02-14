@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="container">
            <div id="tag_container">
                @include('product.grid')
            </div>
        </div>
    </body>
    <script type="text/javascript">
        $(window).on('hashchange', () => {
            if (window.location.hash) {
                let page = window.location.hash.replace('#', '')
                if (page === Number.NaN || page <= 0) {
                    return false
                } else {
                    getData(page)
                }
            }
        });

        $(document).ready(() => {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault()

                $('li').removeClass('active')
                $(this).parent('li').addClass('active')

                let page = $(this).attr('href').split('page=')[1]

                getData(page)
            });

        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done((data) => {
                $("#tag_container").empty().html(data)
                location.hash = page
            }).fail(() => alert('No response from server'))
        }
    </script>
</html>
@endsection
