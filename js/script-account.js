function show_password(ele) {
    //get input password
    let password = document.querySelector("#password");

    //if valu in checkbox is show do..
    if(ele.value == "show") {
        //change input type to text
        password.type = "text";
        //set hidde value
        ele.value = 'hidde';
    }
    else {
        //change input type to password
        password.type = "password";
        //set default value
        ele.value = 'show';
    }
}