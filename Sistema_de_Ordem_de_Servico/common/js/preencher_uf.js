var ufArray = ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", 
	"MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO"];

function inserirEstados(idSelect){
	for (var i = 0; i < ufArray.length; i++) {
		var option = document.createElement('option');
		option.text = ufArray[i];
		option.value = ufArray[i];
		document.getElementById(idSelect).appendChild(option);		
	}
}

//inserirEstados('select-empresa-uf');
//inserirEstados('select-funcionario-uf');
//inserirEstados('select-cliente-uf');