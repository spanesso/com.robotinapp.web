URL_CONNECTIONS = {
    //***************************************************
    //*****************   PRODUCCION   ******************
    //***************************************************
  core: 'http://afiloyalty.com/clean_app/'


    //***************************************************
    //*****************   DESARROLLO   ******************
    //*************************************************** 

     //  core: 'http://localhost/CLEAN_APP/Desarrollo/Web/repository/com.clean.app.web/'


};
 

function selectMenuItem(position) {
    
    console.log("================  selectMenuItem  ====================== ");
    console.log("position: "+position);
    
        $(".item--slide-menu").removeClass("active");
        $(".subitem--slide-menu").removeClass("active");
        $(".ism-"+position).addClass("active");
        $(".ssm-"+position).addClass("active"); 
     
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}