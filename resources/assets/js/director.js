require('./bootstrap');

$(window).ready(function(){
	var total = 0;
	var piechart = new CanvasJS.Chart("pieChartContainer", {
		animationEnabled: true,
		title: {
			text: "Crime Report"
		},
		data: [{
			type: "pie",
			startAngle: 240,
			yValueFormatString: "##0.00\"%\"",
			indexLabel: "{label} {y}",
			dataPoints: []
		}]
	});
	var barchart = new CanvasJS.Chart("barChartContainer", {
		animationEnabled: true,
		title: {
			text: "Crime Report"
		},
		data: [{
			type: "column",
			indexLabel: "{y}",
			dataPoints: []
		}]
	});
	$.ajax({
		method: 'POST',
		url: '/home/crimes'
	}).done(response=>{
		var crimes = JSON.parse(response);
		crimes.forEach(crime=>{
			var temp = JSON.parse(crime);
			total+=parseInt(temp.number);
		});
		crimes.forEach(crime=>{
			var temp = JSON.parse(crime);
			if(temp.number!=0){
				var percent = (temp.number/total)*100;
				piechart.options.data[0].dataPoints.push({y:percent,label:temp.name});
				barchart.options.data[0].dataPoints.push({y:parseInt(temp.number),label:temp.name});
				piechart.render();
				barchart.render();
			}
		});
	});
});

import Case from './components/Case.vue';
import CasesPerStation from './components/CasesPerStation.vue';
import AllCases from './components/AllCases.vue';
import AllCommanders from './components/AllCommanders.vue';

new Vue({
	el: '#case',
	components: {Case,CasesPerStation,AllCases,AllCommanders},
	data(){
		return{
			
		}
	}
});