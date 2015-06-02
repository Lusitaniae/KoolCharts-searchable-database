<!DOCTYPE html>
<html lang="en">
<head>

<title>Searchable KoolCharts</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href='http://fonts.googleapis.com/css?family=Exo:300,300italic,200italic' rel='stylesheet' type='text/css'>

<!-- koolcharts section -->

<link rel="stylesheet" type="text/css" href="kc/KoolChart.css"/>
<!--[if IE]><script language="javascript" type="text/javascript" src="KoolChart/JS/excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="kc/KoolChartLicense.js"></script>
<script language="javascript" type="text/javascript" src="kc/KoolChart.js"></script>

<style>
*{font-family: Exo, sans-serif}
</style>
	
<?php
if(isset($_GET['t']))
	if( strlen($_GET['t']) > 0 && strlen($_GET['t']) < 7){
		$tickr = "query.php?t=" .  trim($_GET['t']);
		$tickr0 = "query2.php?t=" .  trim($_GET['t']);
		$tickr1 = trim($_GET['t']);}
?>
    
<script type="text/javascript">

//----------------------- Here we start creating a chart. -----------------------

var chartVars = "KoolOnLoadCallFunction=chartReadyHandler";
KoolChart.create("chart1", "chartHolder", chartVars, "100%", "100%"); 

function chartReadyHandler(id) {
	document.getElementById(id).setLayout(layoutStr);
	document.getElementById(id).setData(dataURL);
}

///Declaring the layout as an XML string.
var layoutStr =  
'<KoolChart backgroundColor="" cornerRadius="12" borderStyle="empty">'
	+'<Options>'
		+'<Caption fontSize="20" fontWeight="normal" fontFamily="Exo, sans-serif" text="Title"/>'
		+'<SubCaption fontSize="15" fontWeight="normal" fontFamily="Exo, sans-serif" text="'+ 'Subtitle' +'"/>'
		+'<Legend fontSize="15" direction="vertical" fontWeight="normal" position="right" fontFamily="Exo, sans-serif" useVisibleCheck="true" backgroundAlpha="0" borderColor="#e6ecef" />'
	+'</Options>'
+'<CurrencyFormatter id="fmt" currencySymbol="%" alignSymbol="right"/>' 
	+'<Line2DChart showDataTips="true">'
	/* 
	showDataTips: Whether or not to show tooltips when you mouse over items in the chart.
	*/
		+'<horizontalAxis>'
			+'<CategoryAxis categoryField="Day" padding="0" title="Timeline" />' 
		+'</horizontalAxis>'
		+'<verticalAxis>'
			+'<LinearAxis title="Projection	" formatter="{fmt}"/>' 
		+'</verticalAxis>'

		+'<series>'
            +'<Line2DSeries yField="Um" displayName="Um"  form="curve" radius="4" fill="0x1B95D9"  itemRenderer="CircleItemRenderer" formatter="{fmt}" >'
                +'<lineStroke>'
                    +'<Stroke color="0x1B95D9" weight="2"/>' 
                +'</lineStroke>'
                +'<stroke>'
                    +'<Stroke color="0x1B95D9" weight="2"/>' 
                +'</stroke>'
                +'<showDataEffect>'
                    +'<SeriesSlide direction="up" duration="1000"/>'
                +'</showDataEffect>'
            +'</Line2DSeries>'

            +'<Line2DSeries yField="Dois" displayName="Dois"  form="curve" radius="4" fill="0xA5BC4E" itemRenderer="CircleItemRenderer" formatter="{fmt}" >'
                +'<lineStroke>'
                    +'<Stroke color="0xA5BC4E" weight="2"/>' 
                +'</lineStroke>'
                +'<stroke>'
                    +'<Stroke color="0xA5BC4E" weight="2"/>' 
                +'</stroke>'
                +'<showDataEffect>'
                    +'<SeriesSlide direction="up" duration="1000"/>'
                +'</showDataEffect>'
            +'</Line2DSeries>'

            +'<Line2DSeries yField="Tres" displayName="Tres"    form="curve" radius="4" fill="0xE48701" itemRenderer="CircleItemRenderer" formatter="{fmt}" >' 
                +'<lineStroke>'
                    +'<Stroke color="0xE48701" weight="2"/>' 
                +'</lineStroke>'
                +'<stroke>'
                    +'<Stroke color="0xE48701" weight="2"/>' 
                +'</stroke>'
                +'<showDataEffect>'
                    +'<SeriesSlide direction="up" duration="1000"/>'
                    
                +'</showDataEffect>'
            +'</Line2DSeries>'


        +'</series>'

                            
    +'</Line2DChart>'
+'</KoolChart>';
				
loadJSON = function(url) {
if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  request.open('GET', url , false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
 }


//Sample dataset.

var dataURL = 
<?php 
if(isset($tickr)) 
	echo "loadJSON('" . $tickr . "');" ; 
		
else{ ?>

	[ { "Day": "3", "Um": -1.8, "Dois": 0.31, "Tres": 1.81 }, { "Day": "4", "Um": -2.31, "Dois": 0.27, "Tres": 2.57 }, { "Day": "5", "Um": -2.98, "Dois": 0.5, "Tres": 2.91 }, { "Day": "6", "Um": -2.73, "Dois": 0.52, "Tres": 3.27 }, { "Day": "7", "Um": -2.67, "Dois": 0.42, "Tres": 2.73 }, { "Day": "8", "Um": -2.81, "Dois": 0.5, "Tres": 3.33 }, { "Day": "9", "Um": -3.59, "Dois": 0.24, "Tres": 3.51 }, { "Day": "10", "Um": -3.5, "Dois": -0.15, "Tres": 3.68 }, { "Day": "11", "Um": -4.26, "Dois": -0.4, "Tres": 3.72 }, { "Day": "12", "Um": -4.48, "Dois": -0.49, "Tres": 3.68 }, { "Day": "13", "Um": -5.07, "Dois": -1.07, "Tres": 4.38 }, { "Day": "14", "Um": -4.91, "Dois": -0.9, "Tres": 3.82 }, { "Day": "15", "Um": -5.07, "Dois": -0.87, "Tres": 4.5 } ];

<?php } ?>	
				
function queryWarnings(id)
{
	if(id == 0){
		document.getElementsByClassName('warning')[0].style['display'] = 'block';
		//setTimeout(function(){document.getElementsByClassName('warning')[0].style['display'] = 'none'},3000);
		}
	if(id == 1){
		document.getElementsByClassName('warning')[1].style['display'] = 'block';
		//setTimeout(function(){document.getElementsByClassName('warning')[1].style['display'] = 'none'},3000);
		}
	if(id == 2){
		document.getElementsByClassName('warning')[2].style['display'] = 'block';
		//setTimeout(function(){document.getElementsByClassName('warning')[2].style['display'] = 'none'},3000);
		}
}
function clearWarnings(){
		document.getElementsByClassName('warning')[0].style['display'] = 'none';
		document.getElementsByClassName('warning')[1].style['display'] = 'none';
		document.getElementsByClassName('warning')[2].style['display'] = 'none'	;
}
		
function changeData(ticker)
{	

	if(ticker.length > 0 && ticker.length < 7){
		var dataURI = loadJSON('query.php?t=' + ticker);
	}else
		queryWarnings(0);
		
	if(dataURI[0].status == "ticker not found"){
		clearWarnings();
		queryWarnings(1);
		window.history.pushState(ticker, ticker, '?t=' + ticker);
		chart1.setData(dataURI);
	}else if(dataURI[0].status == "n/a data"){
		clearWarnings();
		queryWarnings(2);
		window.history.pushState(ticker, ticker, '?t=' + ticker);
		chart1.setData(dataURI);
	}else{
		//update company name
	//document.getElementsByClassName('tick')[0].innerHTML =  ticker;
		//update url
	window.history.pushState(ticker, ticker, '?t=' + ticker);
		//update graph data
	clearWarnings();	
	chart1.setData(dataURI);
	

	}
}
function noenter(e) {
	//disable Enter key. Replaced with onKeyPress event on the form
    e = e || window.event;
    var key = e.keyCode || e.charCode;
    return key !== 13; 	
    changeData(this.form.t.value);
}

function verifyGet(get){
	//verify GET param
	if(get.length < 0 || get.length > 7)
		queryWarnings(0);
	else if(dataURL[0].status == "ticker not found")
		queryWarnings(1);
	else if(dataURL[0].status == "n/a data")
		queryWarnings(2);
}	

function removeSpaces(string) {
	return string.split(' ').join('');
}/*
function updateCompany(company){
	if(company != "")
		var dataUR = loadJSON('query.php?t=' + company);
	
		if(dataUR[0].status == "Company name not found")
			document.getElementsByClassName('tick')[0].innerHTML = "Not found" ;
		else if(dataUR[0].company == "")
			document.getElementsByClassName('tick')[0].innerHTML = "n/a" ;
		else	
			document.getElementsByClassName('tick')[0].innerHTML = dataUR[0].company ;
}	*/

//----------------------- The end of the configuration for creating a chart. -----------------------

</script>
</head>
<body onload="verifyGet('<?php if(isset($tickr1)) echo $tickr1; ?>');updateCompany('<?php if(isset($tickr1)) echo $tickr1; ?>');">

<div class="container-fluid"> 	
 	<div class="row ticker">
		<h3 class=".col-md-4">Company: <span class="tick"> </span></h3> 
		<!--<p class=".col-md-4">Closing Price: <span class="cPrice"></span></p>-->
	</div>
	<!--
	<div class="warning" style="display:none;">Valid queries range from 1 to 6 characters, inclusive.</div>
	<div class="warning" style="display:none;">Ticker not found.</div>
	<div class="warning" style="display:none;">Data n/a.</div>
	-->

	<form method="get" action="" class="form-inline">
		<input type="search" class="form-control" placeholder="Enter ticker" id="formValueId" name="t" 
		onkeyup="this.value=removeSpaces(this.value);" minlength=3 maxlength=8 onkeypress="" required autofocus />

		<input type="button" id="theButton" class="btn btn-default" value="consult" 
		onclick="changeData(this.form.t.value); updateCompany(this.form.t.value);"
		 onkeypress="return noenter(event);changeData(this.form.t.value);" />
	</form>

	<div class="content row">
		<div id="chartHolder" class=".col-md-12" style="width:90%; height:400px;"></div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html> 
    