<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<title>d3 tutorial</title>
<input type="hidden" id="salesArray" value={{'sales'}} />
 {{HTML::script('js/charts.min.js')}}
<body>
	<script>
	 	var dataArray=$('#club-id').val();
		var width=500;
		var widthScale=d3.scale.linear().domain([0,100]).range([0,width]);
		var color=d3.scale.linear().domain([0,100]).range(["red","blue"])
		var axis=d3.svg.axis().scale(widthScale);
		var canvas=d3.select("body")
		.append("svg")
		.attr("width",800)
		.attr("height",800)
		.append("g")
		.attr("transform","translate(20,0)");
		var bars=canvas.selectAll("rect")
		.data(dataArray)
		.enter().
		append("rect").
		attr("width",function(d) { return widthScale(d);})
		.attr("height",50)
		.attr("fill",function(d){return color(d)})
		.attr("y",function(d,i){return i*55});
		canvas.append("g").attr("transform","translate(0,550)").call(axis);
 	</script>
</body>
</html>