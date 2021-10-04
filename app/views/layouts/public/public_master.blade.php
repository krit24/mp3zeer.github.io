<!doctype html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome to Zeerius</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script type="text/javascript">
        	
            var siteURL = "{{ URL::to('/') }}";
			
        </script>

        {{ HTML::script('js/main.js') }}
        {{ HTML::script('js/script.js') }}
		
    </head>
    <body>
    	{{ $content }}
    	<script type="text/javascript">
    		Zeerius.init();
    	</script>
    </body>
</html>
