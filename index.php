<!DOCTYPE html>
<html>
<head>
	<style>
		#result {
			width: 800px;
			margin: 0 auto;
			}
		.town {
			width:33%;
			float: left;
			margin-bottom:2em;
		}

		h2 {
			text-align: center;
			margin-bottom: 0.2em;
		}
		table {
			border-collapse:collapse;	
			margin: auto;
		}
		table, th, td {
			border: 1px solid black;
		}
		td {
			padding: 0.5em;
		}
	</style>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>

	<script type="text/template" id="weatherTpl">
		{{#list}}
				<div class='town'>
					<h2>{{name}}</h2> 
					<table>
						<tr>
							{{#weather}}
							<td>Description</td>
							<td>{{description}}</td>
							{{/weather}}
						</tr>
						
						{{#main}}
						<tr>
							<td>Temperature</td>
							<td>{{temp}}</td>
						</tr>
						<tr>
							<td>Humidity</td>
							<td>{{humidity}}</td>
						</tr>
						<tr>
							<td>Pressure</td>
							<td>{{pressure}}</td>
						</tr>
						{{/main}}

						{{#wind}}
						<tr>
							<td>Wind Speed</td>
							<td>{{speed}}</td>
						</tr>
						{{/wind}}

					</table>
				</div>
		{{/list}}
	</script>

	<script>
		$(document).ready(function() {
			var towns = new Array ('London,uk', 'Essex', 'Hull', 'Bristol,uk', 'Manchester,uk', 'Liverpool,uk');
			$.each(towns, function() {
				$.getJSON('http://api.openweathermap.org/data/2.5/find?q='+this+'&mode=json&callback=?', function(response) {
					console.log(response);
					var template = $('#weatherTpl').html();
					var html = Mustache.to_html(template, response);
					$('#result').append(html);
					$('tr:even').css('background-color', '#E3F6CE');
					$('tr:odd').css('background-color', '#F2F2F2');
				}); //end getJSON
			});// end $.each
		});//end ready
	</script>
</head>
<body>
	<div id='result'></div>
</body>
</html>