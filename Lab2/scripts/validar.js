function comprobarFormulario()
{
	if ( !checkEmail() || !checkPreguntas() || !checkRespuestas() || !checkComplejidad() ) {
		return false;
	} 
	return true;
}

function checkEmail(){
	var correo = document.getElementById("fpreguntas").correo.value; 
	
	if (!( /(^[a-z]+)([0-9]{3})\@ikasle\.ehu\.(es|eus)/.test(correo)) || correo=="" )	{
		alert("Debe introducir un correo valido.\n");
		return false;
	}
	return true;
}

function checkPreguntas() {
	var pregunta = document.getElementById("fpreguntas").pregunta.value; 
	
	if (pregunta.length < 9) {
		alert("La pregunta debe contener al menos nueve caracteres.\n");
		return false;
	}
	return true;		
}

function checkRespuestas() {
	var correcta = document.getElementById("fpreguntas").correcta.value; 
	var incorrecta1 = document.getElementById("fpreguntas").incorrecta1.value; 
	var incorrecta2 = document.getElementById("fpreguntas").incorrecta2.value; 
	var incorrecta3 = document.getElementById("fpreguntas").incorrecta3.value; 
	var tema = document.getElementById("fpreguntas").tema.value; 


	if ((correcta=="") ||
		(incorrecta1=="") ||
		(incorrecta2=="") ||
		(incorrecta3=="")||
		(tema=="")) {
		alert("La pregunta o respuestas no pueden estar vacias.\n");
		return false;
	}
	return true;		
}

function checkComplejidad() {
	var comp = document.getElementById("fpreguntas").complejidad.value; 
	
	if (parseInt(comp) < 1 || parseInt(comp) > 5) {
		alert("La complejidad debe estar indicada en un numero entre 1 y 5.\n");
		return false;
	}
	return true;
}
