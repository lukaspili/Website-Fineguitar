if (!document.all && document.getElementById)
	mozilla = true;
else
	mozilla = false;

function dateTemp() {
	this.annee = 0;
	this.mois  = 0;
	this.jour  = 0;
}
var dateTemp = new dateTemp();

function setDate() {
	this.inDate='';
	var now   = new Date();
	var day   = now.getDate();
	var month = now.getMonth()+1;
	var year  = now.getFullYear();

	dateTemp.jour   = now.getDate();
	dateTemp.mois	= now.getMonth()+1;
	dateTemp.annee  = now.getFullYear();
	displayCalendar(dateTemp.jour, dateTemp.mois, dateTemp.annee);
}
	
function setToday() {
	var now	       = new Date();
	dateTemp.jour  = now.getDate();
	dateTemp.mois  = now.getMonth()+1;
	dateTemp.annee = now.getFullYear();
	
	this.focusDay = dateTemp.jour;
	displayCalendar(dateTemp.jour, dateTemp.mois, dateTemp.annee);
	majMoisAnnee();
}

function setPreviousYear() {
	dateTemp.annee--;        
	displayCalendar( dateTemp.jour, dateTemp.mois, dateTemp.annee);
}

function setPreviousMonth() {
	dateTemp.jour = 0;
	if (dateTemp.mois == 1) {
		dateTemp.mois = 12;
		dateTemp.annee--;
	}
	else {
		dateTemp.mois--;
	}        
	displayCalendar(dateTemp.jour, dateTemp.mois, dateTemp.annee);  
	majMoisAnnee();
}

function setNextMonth() {
	dateTemp.jour   = 1;        
	if (dateTemp.mois == 12) {
		dateTemp.mois = 1;
		dateTemp.annee++;
	}
	else {
		dateTemp.mois++;
	}
	displayCalendar(dateTemp.jour, dateTemp.mois, dateTemp.annee);
	majMoisAnnee();
}

function setNextYear() {   
	dateTemp.annee = 0;
	dateTemp.annee++;      
	displayCalendar(dateTemp.jour, dateTemp.mois, dateTemp.annee);
}

function displayCalendar(day, month, year) {	
	var aujourdhui = new Date();
	var jour       = aujourdhui.getDate();
	var mois       = aujourdhui.getMonth()+1;
	var annee      = aujourdhui.getFullYear();

	day   = parseInt(day);
	month = parseInt(month)-1;
	year  = parseInt(year);

	var concerned = false;
	if (((month+1) == mois)&&(annee == year))
		concerned = true;

	var i   = 0;
	var now = new Date();

	if (day == 0) {
		var nowDay = now.getDate();
	}
	else {
		var nowDay = day;
    }

	var days = getDaysInMonth(month+1,year);
	var firstOfMonth = new Date (year, month, 1);
	
	var startingPos  = firstOfMonth.getDay();
	if (startingPos==0)
		startingPos = 7;
	days += startingPos;
	
	if (month+1 > mois)	{
		eval("document.getElementById('moisprecedent').innerHTML=\"<a href='javascript: setPreviousMonth()'><img src='img/icon_arrow_inv.gif' width='5' height='8' border='0'></a>\"");
	}
	else {
		if (year > annee) {
			eval("document.getElementById('moisprecedent').innerHTML=\"<a href='javascript: setPreviousMonth()'><img src='img/icon_arrow_inv.gif' width='5' height='8' border='0'></a>\"");
		}
		else {
			// If don't want the BEFORE today's date
			// eval("document.getElementById('moisprecedent').innerHTML=''");
			eval("document.getElementById('moisprecedent').innerHTML=\"<a href='javascript: setPreviousMonth()'><img src='img/icon_arrow_inv.gif' width='5' height='8' border='0'></a>\"");
		}
	}
	
	for (i = 1; i < startingPos; i++) {
		eval("document.getElementById('td"+(i)+"').innerHTML=''");
    }
	
	for (i = startingPos; i < days; i++) {
		if ((concerned == true)&&(jour == (i-startingPos+1))) {
			eval("document.getElementById('td"+(i)+"').innerHTML='"+(i-startingPos+1)+"'");
			eval("document.getElementById('td"+(i)+"').className='maintenantCal'");
		}
		else {
			if ((concerned == true)&&(jour > (i-startingPos+1))) {
				// If want the BEFORE today's date START
				var lien = document.createElement("a");
				var txt  = document.createTextNode((i-startingPos+1));
				lien.appendChild(txt);
	
				if ((i-startingPos+1) < 10) { var PrintDateJour2 = "0"+(i-startingPos+1); }
				else { var PrintDateJour2 = (i-startingPos+1); }
				if ((month+1) < 10) { var PrintDateMois2 = "0"+(month+1); }
				else { var PrintDateMois2 = (month+1); }
	
				// lien.setAttribute("href", "javascript: chpDate('"+ year +"-"+ PrintDateMois2 +"-"+ PrintDateJour2 +"')");
				lien.setAttribute("href", "javascript: chpDate('"+ PrintDateJour2 +"/"+ PrintDateMois2 +"/"+ year +"')");
				lien.setAttribute("style", "color: #015966; text-decoration:none;");
				// If want the BEFORE today's date END
				
				// If don't want the BEFORE today's date
				// eval("document.getElementById('td"+(i)+"').innerHTML='"+(i-startingPos+1)+"'");
				// eval("document.getElementById('td"+(i)+"').className='inactifCal'");
				eval("document.getElementById('td"+i+"').innerHTML=''");
				eval("document.getElementById('td"+(i)+"').appendChild(lien)");
			}
			else {
				var lien = document.createElement("a");
				var txt  = document.createTextNode((i-startingPos+1));
				lien.appendChild(txt);

				if ((i-startingPos+1) < 10) { var PrintDateJour2 = "0"+(i-startingPos+1); }
				else { var PrintDateJour2 = (i-startingPos+1); }
				if ((month+1) < 10) { var PrintDateMois2 = "0"+(month+1); }
				else { var PrintDateMois2 = (month+1); }

				// lien.setAttribute("href", "javascript: chpDate('"+ year +"-"+ PrintDateMois2 +"-"+ PrintDateJour2 +"')");
				lien.setAttribute("href", "javascript: chpDate('"+ PrintDateJour2 +"/"+ PrintDateMois2 +"/"+ year +"')");
				lien.setAttribute("style", "color: #015966; text-decoration:none;");

				eval("document.getElementById('td"+i+"').innerHTML=''");
				eval("document.getElementById('td"+(i)+"').appendChild(lien)");
			}
		}
	}
	for (i=days; i<43; i++) {
		eval("document.getElementById('td"+i+"').innerHTML=''");
	}
}

function majMoisAnnee() {
	var strMois ="";
	switch (dateTemp.mois) {
		case 1:
			strMois = "Janvier";
		break;
		case 2:
			strMois = "F&eacute;vrier";
		break;
		case 3:
			strMois = "Mars";
		break;
		case 4:
			strMois = "Avril";
		break;
		case 5:
			strMois = "Mai";
		break;
		case 6:
			strMois = "Juin";
		break;
		case 7:
			strMois = "Juillet";
		break;
		case 8:
			strMois = "Ao&ucirc;t";
		break;
		case 9:
			strMois = "Septembre";
		break;
		case 10:
			strMois = "Octobre";
		break;
		case 11:
			strMois = "Novembre";
		break;
		case 12:
			strMois = "D&eacute;cembre";
		break;
	}
	document.getElementById('moisAnnee').innerHTML=strMois+" "+dateTemp.annee;
}

function getDaysInMonth(month,year) {
	var days;
	if (month==1 || month==3 || month==5 || month==7 || month==8 || month==10 || month==12) {
		days=31;
	}
	else if (month==4 || month==6 || month==9 || month==11) {
		days=30;
	}
	else if (month==2) {
		if (isLeapYear(year)) {
			days=29;
		}
		else {
			days=28;
		}
	}
	return (days);
}

function isLeapYear (Year) {
	if (((Year % 4)==0) && ((Year % 100)!=0) || ((Year % 400)==0)) {
		return (true);
	}
	else {
		return (false);
	}
}

function selectDate(e,chp) {
	setDate();
	majMoisAnnee();
	maDiv = document.getElementById('selectDate');

	/* if (mozilla == true) {
		maDiv.style.left = e.clientX + 'px' ;
		maDiv.style.top = e.clientY + document.documentElement.scrollTop + 'px';
	}
	else {
		maDiv.style.left = window.event.clientX;		
		maDiv.style.top = window.event.clientY + document.documentElement.scrollTop;
	} */
	
	maDiv.style.display = "block";
	this.chp = chp;
}

function todaySelectDate() {
	maDiv = document.getElementById('selectDate');
	maDiv.style.display = "none";

	var d = new Date();
	var CheckDateJour = d.getDate();
	var CheckDateMois = (d.getMonth() + 1);

	if (CheckDateJour < 10) { var PrintDateJour = "0"+CheckDateJour; }
	else { var PrintDateJour = CheckDateJour; }
	if (CheckDateMois < 10) { var PrintDateMois = "0"+CheckDateMois; }
	else { var PrintDateMois = CheckDateMois; }

	// document.getElementById('p_date'+chp).value = d.getFullYear()+"-"+PrintDateMois+"-"+PrintDateJour+" 00:00:00";
	document.getElementById('p_date'+chp).value = PrintDateJour+"/"+PrintDateMois+"/"+d.getFullYear(); 
	document.getElementById('p_date'+chp).focus();
}

function cacheSelectDate() {
	maDiv = document.getElementById('selectDate');
	maDiv.style.display = "none";
}

function chpDate(maDate) {
	maDiv = document.getElementById('selectDate');
	maDiv.style.display = "none";

	document.getElementById('p_date'+chp).value = maDate; // +" 00:00:00"
	document.getElementById('p_date'+chp).focus();
}