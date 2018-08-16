function carrega(URL, valor, onde)
{
	ajaxGo({url: URL+valor, timeout: 5, elem_return: onde})
}
function limpar()
{
   document.getElementById("message").innerHTML="";
} 