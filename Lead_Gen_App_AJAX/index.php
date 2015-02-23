<html>
<head>
  <title>Intermediate</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script>
	$(document).ready(function(){
		$('.datepicker').datepicker();

		$('#search_text').on('keyup',function(){
      $('#test_form').submit();
		});
    $('.datepicker').on('change', function(){
      $('#test_form').submit();
    });
		$('#test_form').submit(function(){
			$.post(
        $(this).attr('action'),
        $(this).serialize(),
        function(data){
          $('#results').html(data.html);
        },
         "json"
			); //end $.post
			return false;
  }); //end $(document).ready  

        // $('#test_form').submit();   
  });
	</script>
	<style>
	</style>
</head>
<body>

	<form id="test_form" action="process.php" method="post">
		Name: <input id="search_text" type="text" name="name"/>
		From: <input class="datepicker" type="text" name="from_date"/>
		To: <input class="datepicker" type="text" name="to_date"/>
		<input type="submit" value="Submit"/>
	</form>

	<div id="results"></div>
</body>