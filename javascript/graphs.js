$(document).ready(function (){
					//  Creat  Ploating  Array   Of the Points
					var arrGoogle = document.getElementById('googleapi').value;
					var arrSeomoz = document.getElementById('seomozapi').value;
					
					var dataArrGoogle =  arrGoogle.split(',');
					var dataArrSeomoz =   arrSeomoz.split(',');
					var  FinalGoogleApi = new Array(((dataArrGoogle.length-2)/2));
					var  FinalSeomozApi =  new Array(((dataArrSeomoz.length -2)/2));
					var ctl  =  0;
					for(var i = 0;  i  <  (dataArrGoogle.length) ;  i= i+ 2){
						FinalGoogleApi[ctl] = new Array(2);						
						for (var j=0 ; j<=1 ;j++){
							FinalGoogleApi[ctl][j] = parseInt(dataArrGoogle[j+i]); 
						}
						ctl++;
					}
					
					var ctl  =  0;
					for(var i = 0;  i  <  (dataArrSeomoz.length) ;  i= i+ 2){
						FinalSeomozApi[ctl] = new Array(2);						
						for (var j=0 ; j<=1 ;j++){
							FinalSeomozApi[ctl][j] = parseInt(dataArrSeomoz[j+i]); 
						}
						ctl++;
					}
					
				
					
				var  d  =  FinalGoogleApi;
				var dSeomoz  =  FinalSeomozApi;
				
				// first correct the timestamps - they are recorded as the daily
				// midnights in UTC+0100, but Flot always displays dates in UTC
				// so we have to add one hour to hit the midnights in the plot
				for (var i = 0; i < d.length; ++i)
					d[i][0] += 60 * 60 * 1000;
				// helper for returning the weekends in a period
				function weekendAreas(axes) {
				var markings = [];
				var d = new Date(axes.xaxis.min);
				// go to the first Saturday
				d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
				d.setUTCSeconds(0);
				d.setUTCMinutes(0);
				d.setUTCHours(0);
				var i = d.getTime();
				do {
				// when we don't set yaxis the rectangle automatically
				// extends to infinity upwards and downwards
				markings.push({ xaxis: { from: i, to: i + 2 * 24 * 60 * 60 * 1000 } });
				i += 7 * 24 * 60 * 60 * 1000;
				} while (i < axes.xaxis.max);
				return markings;
				}
				var options = {
				xaxis: { mode: "time" },
				selection: { mode: "xy" },
				lines: { show: true, fill: 0.5 },
				points: { show: true },
				yaxis: { min: 800, max: 2000 },
				grid: { markings: weekendAreas, hoverable: true, clickable: true, labelMargin: 10 },
				colors: ["#639ecb"], //639ecb //e03c42
				shadowSize: 2
				};
				function showTooltip(x, y, contents) {
				$('<div id="tooltip">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y - 35,
				left: x + 0,
				color: '#333',
				border: '1px solid #999',
				padding: '2px',
				'background-color': '#EFEFEF',
				opacity: 0.80
				}).appendTo("body").fadeIn(200);
				}
				var plot = $.plot($("#placeholder1"), [d], options);
				var previousPoint = null;
				$("#placeholder1").bind("plothover", function (event, pos, item) {
				$("#x").text(pos.x.toFixed(2));
				$("#y").text(pos.y.toFixed(2));
				if (item) {
				if (previousPoint != item.datapoint) {
				previousPoint = item.datapoint;
				$("#tooltip").remove();
				var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);
				showTooltip(item.pageX, item.pageY,
				y);
				}
				}
				else {
				$("#tooltip").remove();
				previousPoint = null;
				}
				});
				
				var plot = $.plot($("#placeholder2"), [dSeomoz], options);
				var previousPoint = null;
				$("#placeholder2").bind("plothover", function (event, pos, item) {
				$("#x").text(pos.x.toFixed(2));
				$("#y").text(pos.y.toFixed(2));
				if (item) {
				if (previousPoint != item.datapoint) {
				previousPoint = item.datapoint;
				$("#tooltip").remove();
				var x = item.datapoint[0].toFixed(2),
				y = item.datapoint[1].toFixed(2);
				showTooltip(item.pageX, item.pageY,
				y);
				}
				}
				else {
				$("#tooltip").remove();
				previousPoint = null;
				}
				});
				
		 });