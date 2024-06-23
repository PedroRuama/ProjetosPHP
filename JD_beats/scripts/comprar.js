
String.prototype.reverse = function () {
    return this.split('').reverse().join('');
};

function mascaraTel(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ 
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "15");
    if (v.length == 1 ) i.value = "(" + i.value;
    if (v.length == 3 ) i.value += ") ";
    if (v.length == 10) i.value += "-";
}


function mascaraCpf(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "14");
    if (v.length == 3 || v.length == 7) i.value += ".";
    if (v.length == 11) i.value += "-";

    
}


function mascaraCEP(i) {
    const v = i.value;
        
    if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
        i.value = v.substring(0, v.length-1);
        return;
    }
    
    i.setAttribute("maxlength", "8");
    if (v.length == 4) i.value += "-";

    
}