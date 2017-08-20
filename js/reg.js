var fname = document.getElementById('fname');
var lname = document.getElementById('lname');
var email = document.getElementById('email');
var username = document.getElementById('username');
var password = document.getElementById('password');
var conpass = document.getElementById('conpass');

fname.onfocus = function() {
    fname.setAttribute("style", "color: black;");
    if (fname.value == "* First Name is required") {
        fname.setAttribute("value", ""); 
    } else if (fname.value == "* Please provide a valid name") {
        fname.setAttribute("value", "");
    }
};

lname.onfocus = function() {
    lname.setAttribute("style", "color: black;");
    if (lname.value == "* Last Name is required") {
        lname.setAttribute("value", "");
    } else if (lname.value == "* Please provide a valid name") {
        lname.setAttribute("value", "");
    }
};

email.onfocus = function() {
    email.setAttribute("style", "color: black;");
    if (email.value == "* Email is required") {
        email.setAttribute("value", "");
    } else if (email.value == "* Invalid email format") {
        email.setAttribute("value", "");
    }
};

username.onfocus = function() {
    username.setAttribute("style", "color: black;");
    if (username.value == "* Username is required") {
        username.setAttribute("value", "");
    } else if (username.value == "* There should not be white spaces in username") {
        username.setAttribute("value", "");
    } else if (username.value == "* That username already exists. Please try again with different username") {
        username.setAttribute("value", "");
    }
};

password.onfocus = function() {
    password.setAttribute("style", "color: black;");
    if (password.value == "* Password is required") {
        password.setAttribute("value", "");
    } else if (password.value == "* Password should have at least 8 characters") {
        password.setAttribute("value", "");
    }
};

conpass.onfocus = function() {
    conpass.setAttribute("style", "color: black;");
    if (conpass.value == "* Password confirming is required") {
        conpass.setAttribute("value", "");
    } else if (conpass.value == "* Password doesn't match") {
        conpass.setAttribute("value", "");
    }
};

