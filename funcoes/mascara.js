/*Função Primitiva*/
function Mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
}
    
/*Função que Executa os objetos*/
function execmascara(){
        v_obj.value=v_fun(v_obj.value)
}
    
/*Função que permite apenas numeros*/
function Integer(v){
        return v.replace(/\D/g,"")
}
    
/*Função telefone (11) 4184-1241 ou (11) 95422-1234*/
function Telefone(v){
        v=v.replace(/\D/g,"") //apaga o que não é digito              
        v=v.replace(/^(\d\d)(\d)/g,"($1) $2") // parenteses no DDD e espaço para o número do tel
		v=v.replace(/(\d)(\d{4})$/,"$1-$2") //Coloca traço antes dos 4 últimos digitos
        return v
}
    
/*Função RA*/
function Ra(v){
        v=v.replace(/[^0-9Xx]/g,"")                    
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
                                                 
        v=v.replace(/(\w{3})(\w)$/,"$1-$2") 
        return v
}

/*Função CPF*/
function Cpf(v){
        v=v.replace(/\D/g,"")                    
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
                                                 
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")  
        return v
}

/*Função CTPS*/
function Ctps(v){
        v=v.replace(/[^0-9A-Za-z]/g,"")                    
        v=v.replace(/(\d{5})(\d)/,"$1/$2")             
                                                 
        v=v.replace(/(\w{4})(\w{1,2})$/,"$1-$2")  
        return v
}

/*Função Número de Classe*/
function Classe(v){
        v=v.replace(/\D/g,"")                    
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       
        v=v.replace(/(\d{3})(\d)/,"$1.$2")        
        return v
}
    
/*Função CEP*/
function Cep(v){
        v=v.replace(/\D/g,"")                
        v=v.replace(/(\d{5})(\d)/,"$1-$2") 
        return v
}

function Comunicados(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{3})(\d)/,"$1/$2") 
        return v
}

/*Função DATA*/
function Data(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        return v
}

/*Função DATA-MES*/
function Datames(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1/$2") 
        return v
}
    
/*Função HORA*/
function Hora(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d{2})(\d)/,"$1:$2")  
        return v
    }
    
/*Função valor monétario*/
function Valor(v){
        v=v.replace(/\D/g,"") //Remove tudo o que não é dígito
        v=v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/,"$1.$2");
        //v=v.replace(/(\d{3})(\d)/g,"$1,$2")
        v=v.replace(/(\d)(\d{2})$/,"$1.$2") //Coloca ponto antes dos 2 últimos digitos
        return v
}
    
/*Função Area*/
function Area(v){
        v=v.replace(/\D/g,"") 
        v=v.replace(/(\d)(\d{2})$/,"$1.$2") 
        return v
        
}