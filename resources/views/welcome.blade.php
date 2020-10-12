<!DOCTYPE html>
<html>
<head>
    <title>KineticsEgypt Task</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>

<div class="container">
    <div class="card bg-light mt-3">
        @if(session()->has('success'))
               <div class="alert-success container mydiv">
                   <span>{{session()->get('success')}}</span>
               </div>
            @endif

            @if(session()->has('error'))
                <div class="alert-danger container mydiv">
                    <span>{{session()->get('error')}}</span>
                </div>
            @endif
        <div class="card-header">
            KineticsEgypt Task
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control" accept="file/*" required>
                <br>
                <button class="btn btn-success">Import User Data</button>
            </form>
        </div>

    </div>
</div>
<div class="container">
@if(session()->has('neglected_users'))
    <h3>Number of Neglected Users : {{session()->get('neglected_users')}}</h3>
@endif
    <hr>
    @if(session()->has('users'))
        <div id="tag_container">
            @include('separated')
        </div>
       @endif
</div>

<script>
    setTimeout(function() {
        $('.mydiv').fadeOut('fast');
    }, 2000);
</script>

<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];

            getData(page);
        });

    });

    function getData(page){
        $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(users){
            $("#tag_container").empty().html(users);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }
</script>
</body>
</html>
