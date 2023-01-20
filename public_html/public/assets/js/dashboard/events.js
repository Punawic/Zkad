(function($) {
    /* "use strict" */


 var dzChartlist = function(){
	
	var screenWidth = $(window).width();
		
	var polarAreaCharts = function(){
		var options = {
			series: [42, 47, 52, 58],
			chart: {
				width: 300,
				type: 'polarArea',
				sparkline: {
					enabled: true,
				},
			},
			labels: ['VIP', 'Reguler', 'Exclusive', 'Economic'],
			fill: {
				opacity: 1,
				colors: ['#2130b8', '#21b830', '#ff7a00', '#ffe600']
			},
			stroke: {
				width: 0,
				colors: undefined
			},
			yaxis: {
				show: false
			},
			legend: {
				position: 'bottom'
			},
			plotOptions: {
				polarArea: {
					rings: {
						strokeWidth: 0
					}
				}
			},
			theme: {
				monochrome: {
					enabled: true,
					shadeTo: 'light',
					shadeIntensity: 0.6
				}
			}
		};

        var chart = new ApexCharts(document.querySelector("#polarAreaCharts"), options);
        chart.render();
	}
	
	
	var chartDonut = function(){
		$("span.donut").peity("donut", {
			width: "80",
			height: "80",
			radius: 8,
		});
		
	}
	
	var updatingChart = function(){
		 var t = $(".updating-chart").peity("line", {
			fill: ['rgba(255, 38, 38, .04)'],
			stroke: 'rgb(255, 38, 38)', 
			strokeWidth: 2,
			width: "100%",
			height: 30
		});
		setInterval(function() {
			var e = Math.round(10 * Math.random()),
				i = t.text().split(",");
			i.shift(), i.push(e), t.text(i.join(",")).change()
		}, 1e3)
	}
	var chartBar = function(){
		if(jQuery('#chart_widget_2').length > 0 ){
	
			const chart_widget_2 = document.getElementById("chart_widget_2").getContext('2d');
			//generate gradient
			const chart_widget_2gradientStroke = chart_widget_2.createLinearGradient(250, 0, 0, 0);
			chart_widget_2gradientStroke.addColorStop(1, "#ff7a00");
			chart_widget_2gradientStroke.addColorStop(0, "#2130b8");

			// chart_widget_2.attr('height', '100');

			new Chart(chart_widget_2, {
				type: 'bar',
				data: {
					defaultFontFamily: 'Poppins',
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [
						{
							label: "My First dataset",
							data: [15, 40, 55, 40, 25, 35, 40, 50, 85, 95, 54, 35],
							borderColor: chart_widget_2gradientStroke,
							borderWidth: "0",
							backgroundColor: chart_widget_2gradientStroke, 
							hoverBackgroundColor: chart_widget_2gradientStroke
						}
					]
				},
				options: {
					legend: false,
					responsive: true, 
					maintainAspectRatio: false,  
					scales: {
						yAxes: [{
							display: false, 
							ticks: {
								beginAtZero: true, 
								display: false, 
								max: 100, 
								min: 0, 
								stepSize: 10
							}, 
							gridLines: {
								display: false, 
								drawBorder: false
							}
						}],
						xAxes: [{
							display: false, 
							barPercentage: 0.4, 
							gridLines: {
								display: false, 
								drawBorder: false
							}, 
							ticks: {
								display: false
							}
						}]
					}
				}
			});

		}
		
		
	}
	
	var revenueChart = function(){
		if(jQuery('#revenueChart').length > 0 ){
			const chart_widget_9 = document.getElementById("revenueChart").getContext('2d');

			new Chart(chart_widget_9, {
				type: "line",
				data: {
					labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "January", "February", "March", "April"],
					datasets: [{
						label: "Sales Stats",
						backgroundColor: ['rgba(33, 48, 184, .08)'],
						borderColor: '#2130b8',
						pointBackgroundColor: '#2130b8',
						pointBorderColor: '#2130b8',
						borderWidth:2,
						pointHoverBackgroundColor: '#2130b8',
						pointHoverBorderColor: '#2130b8',
						data: [8, 7, 6, 3, 2, 4, 6, 8, 12, 6, 12, 13, 10, 18, 14, 24, 16, 12, 19, 21, 16, 14, 24, 21, 13, 15, 27, 29, 21, 11, 14, 19, 21, 17]
					}]
				},
				options: {
					title: {
						display: !1
					},
					tooltips: {
						intersect: !1,
						mode: "nearest",
						xPadding: 10,
						yPadding: 10,
						caretPadding: 10
					},
					legend: {
						display: !1
					},
					responsive: !0,
					maintainAspectRatio: !1,
					hover: {
						mode: "index"
					},
					scales: {
						xAxes: [{
							display: !1,
							gridLines: !1,
							scaleLabel: {
								display: !0,
								labelString: "Month"
							}
						}],
						yAxes: [{
							display: !1,
							gridLines: !1,
							scaleLabel: {
								display: !0,
								labelString: "Value"
							},
							ticks: {
								beginAtZero: !0
							}
						}]
					},
					elements: {
						line: {
							tension: .15
						},
						point: {
							radius: 0,
							borderWidth: 0
						}
					},
					layout: {
						padding: {
							left: 0,
							right: 0,
							top: 5,
							bottom: 0
						}
					}
				}
			});

		}
	}
	
	
		return {
			init:function(){
			},
			
			
			
			load:function(){
				polarAreaCharts();
				chartBar();
				updatingChart();
				revenueChart();
				chartDonut();
			},
			
			resize:function(){
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dzChartlist.load();
		}, 1000); 
		
	});

	jQuery(window).on('resize',function(){
		
		
	});     

})(jQuery);