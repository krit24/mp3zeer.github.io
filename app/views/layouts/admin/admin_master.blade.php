<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
        <title>Welcome to Zeerius - Administrator</title>

        {{ HTML::style('css/main.css') }}
        {{ HTML::style('css/icons.css') }}
        {{ HTML::style('css/jquery-ui.css') }}

        {{ HTML::script('js/jquery-1.7.2.min.js') }}
        {{ HTML::script('js/jquery-ui.js') }}
        {{ HTML::script('js/jquery/jquery.blockUI.js') }}

		{{ HTML::script('js/loading.js') }}
        {{ HTML::script('js/message.js') }}
        {{ HTML::script('js/modal.js') }}
        {{ HTML::script('js/system.js') }}

        <!-- set global siteURL variable for all the JS/Ajax Request. -->
        <script type="text/javascript">
            var siteURL = "{{ URL::to('/') }}";
            $(function(){
				$('#sidebar li').on('mouseover', function(){
					$(this).find('ul').removeClass('hide');
				}).on('mouseout', function(){
					$(this).find('ul').addClass('hide');
				});
			});
        </script>

    </head>
    <body>
        
        {{ $content }}
        
    </body>
</html>
