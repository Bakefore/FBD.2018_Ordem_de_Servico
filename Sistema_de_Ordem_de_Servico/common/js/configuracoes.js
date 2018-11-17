var menuDropdown = false;

function voltarParaMenuPrincipal(){
	window.location.href = "principal.php";
}	    

function encaminharPagina(link){
	window.location.href = link;
}

function puxarDropdown(){
	document.getElementById('menu-dropdown').style = ("margin-top: 70px; transition: all .4s;");
	menuDropdown = true;
}

function tirarDropdown(){
	document.getElementById('menu-dropdown').style = ("margin-top: -100%; transition: all 1s;");
	menuDropdown = false;
}

function mudarMenuDropdown(){
	if(menuDropdown == false){
		puxarDropdown();
	}
	else{
		tirarDropdown();	
	}	
}
