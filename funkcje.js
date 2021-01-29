function niestandardowy()
{
	document.getElementById('zakres').style.display="block";
	document.getElementById('tabelaPrzychody').style.display="none";
	document.getElementById('wydatki').style.display="none";
	document.getElementById('bilansfinalny').style.display="none";
	document.getElementById('okresczasu').style.display="none";
	
	
}
function wyswietlTabele1()
{
	document.getElementById('tabelaPrzychody').style.display="block";
	document.getElementById('wydatki').style.display="block";
	document.getElementById('bilansfinalny').style.display="block";
	document.getElementById('zakres').style.display="none";
	document.getElementById('okresczasu').style.display="block";
	document.getElementById('okresczasu').innerHTML='<span class="bilansdla">Bilans dla: </span> <span class="kolumnytabeli">bieżącego miesiąca</span>';
}
function wyswietlTabele2()
{
	document.getElementById('tabelaPrzychody').style.display="block";
	document.getElementById('wydatki').style.display="block";
	document.getElementById('bilansfinalny').style.display="block";
	document.getElementById('zakres').style.display="none";
	document.getElementById('okresczasu').style.display="block";
	document.getElementById('okresczasu').innerHTML='<span class="bilansdla">Bilans dla: </span> <span class="kolumnytabeli">poprz. miesiąca</span>';
}
function wyswietlTabele3()
{
	document.getElementById('tabelaPrzychody').style.display="block";
	document.getElementById('wydatki').style.display="block";
	document.getElementById('bilansfinalny').style.display="block";
	document.getElementById('zakres').style.display="none";
	document.getElementById('okresczasu').style.display="block";
	document.getElementById('okresczasu').innerHTML='<span class="bilansdla">Bilans dla: </span> <span class="kolumnytabeli">bieżącego roku</span>';
}
function wyswietlTabele4()
{
	var poczatek = document.getElementById("poczatek1").value;
	var koniec = document.getElementById("koniec1").value;
	document.getElementById('tabelaPrzychody').style.display="block";
	document.getElementById('wydatki').style.display="block";
	document.getElementById('bilansfinalny').style.display="block";
	document.getElementById('zakres').style.display="none";
	document.getElementById('okresczasu').style.display="block";
	document.getElementById('okresczasu').innerHTML='<span class="bilansdla">Bilans dla:</span> <span class="kolumnytabeli">'+poczatek+'_'+koniec+'</span>';

}
window.onload = start; //kiedy w oknie załaduje się strona
function start()
{
	document.getElementById('zakres').style.display="none";

// Load google charts
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	// Draw the chart and set the chart values
	function drawChart() {
	  var data = google.visualization.arrayToDataTable([
	  ['Kategoria', 'Udział procentowy'],
	  ['Jedzenie', 23],
	  ['Mieszkanie', 15],
	  ['Transport', 8],
	  ['Opieka zdrowotna', 8],
	  ['Ubranie', 7],
	  ['Higiena', 4],
	  ['Dzieci', 10],
	  ['Wycieczka', 4],
	  ['Szkolenia', 5],
	  ['Książki', 2],
	  ['Oszczędności', 10],
	  ['Złota jesień', 2],
	  ['Spłata długów', 0],
	  ['Darowizna', 1],
	  ['Inne', 1]
	]);

	  // Optional; add a title and set the width and height of the chart
	  var options = {backgroundColor:'none', chartArea:{left:'0',top:'0',width:'100%',height:'100%'}, legend:{position: 'right', textStyle:{color:'#efefef', fontSize:'12'}}, pieSliceText:'percentage', pieSliceTextStyle:{color:'black', fontSize:'14'},  colors: ['#FF0000', '#8B0000', '#B22222', '#DC143C', '#CD5C5C', '#FA8072', '#E9967A', '#FFA07A','#FFDAB9','#FFE4B5', '#FFEFD5', '#FAFAD2', '#FFFACD', '#FFFFE0', 'white' ]}


	  // Display the chart inside the <div> element with id="piechart"
	  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	  chart.draw(data, options);
	}	
}


					