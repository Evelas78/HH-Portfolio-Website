function changeText_Home(){
    document.getElementById("home-link").innerHTML = "(About The)<br>Home(lessHobo)"; 
}
function changeBack_Home(){
    document.getElementById("home-link").innerHTML = "Home"; 
}
function changeText_Socials(){
    document.getElementById("socials-link").innerHTML = "Along with my Latest Vid"; 
}
function changeBack_Socials(){
    document.getElementById("socials-link").innerHTML = "Socials + YouTube"; 
}
function changeText_Support(){
    document.getElementById("support-link").innerHTML = "I mean <br> I Am Homeless..."; 
}
function changeBack_Support(){
    document.getElementById("support-link").innerHTML = "Support Me"; 
}
function changeText_Contact(){
    document.getElementById("contact-link").innerHTML = "Or feedback, perchance?"; 
}
function changeBack_Contact(){
    document.getElementById("contact-link").innerHTML = "Contact Me?"; 
}

function addDownload(receivedID){
    document.getElementById("contact-link").innerHTML = receivedID; 
    $.ajax({
        type: 'POST',
        url: '../php/downloadUpdateFunc.php',
        data: ({ID: receivedID}),
        error: function(response) {                 
            console.log("Error in adding a download, connection issue?")
          }         
    })
}

function addVisit(receivedID){
    console.log(receivedID);
    $.ajax({
        type: 'POST',
        url: '../php/visitUpdateFunc.php',
        data: ({ID: receivedID}),
        error: function(response) {                 
            console.log("Error in adding a visit, connection issue?")
          }         
    })
}