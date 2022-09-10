function show_route_info() {
    //get display status
    let info = document.querySelector("#infoHolder");

    //if dislpay is none show info else hidde
    if(info.style.display == "none") {
        //show info
        info.style.display = "flex";
    }
    else {
        info.style.display = "none";
    }


}