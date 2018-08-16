// Fun��o para confirmar certeza de exclus�o de arquivo

function confirmApagar()
{
var agree=confirm("Tem certeza que deseja apagar este Registro? Ap�s efetuar essa opera��o ela n�o poder� ser desfeita!");
if (agree)
	return true ;
else
	return false ;
}

//Fun��o para abrir popup

function janela(URL, title)
{
	window.open(URL,title,'scrollbars=yes,width=800,height=600,left=0,top=0');
}

function voltar(pagina)
{
	window.history.go(pagina);
}

//Fun��o para selecionar todas as linhas de um formul�rio
//formname = nome do formul�rio, elemento = "checkbox", "radiobutton"...
function selecionar_todos(formname, elemento){ 
   for (i=0;i<document.forms[formname].elements.length;i++) 
      if(document.forms[formname].elements[i].type == elemento)	
         document.forms[formname].elements[i].checked=1 
}

//Fun��o para remover sele��o de todas as linhas de um formul�rio
//formname = nome do formul�rio, elemento = "checkbox", "radiobutton"...
function selecionar_nenhum(formname, elemento){ 
   for (i=0;i<document.forms[formname].elements.length;i++) 
      if(document.forms[formname].elements[i].type == elemento)	
         document.forms[formname].elements[i].checked=0 
}

//Verificar se capslock est� ativo
function checar_caps_lock(ev) {
	var e = ev || window.event;
	codigo_tecla = e.keyCode?e.keyCode:e.which;
	tecla_shift = e.shiftKey?e.shiftKey:((codigo_tecla == 16)?true:false);
	if(((codigo_tecla >= 65 && codigo_tecla <= 90) && !tecla_shift) || ((codigo_tecla >= 97 && codigo_tecla <= 122) && tecla_shift)) {
		document.getElementById('aviso_caps_lock').style.visibility = 'visible';
	}
	else {
		document.getElementById('aviso_caps_lock').style.visibility = 'hidden';
	}
}
