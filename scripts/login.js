function rememberMe() {
    var email = document.forms["loginForm"]["email"].value;
    var pass = document.forms["loginForm"]["password"].value;
    var rememberme = document.forms["loginForm"]["idremember"].checked;
    console.log("Form data:" + rememberme + "," + email + "," + pass);
    if (!rememberme) {
        setCookies("cemail", "", 0);
        setCookies("cpass", "", 0);
        setCookies("crem", false, 0);
        document.forms["loginForm"]["email"].value = "";
        document.forms["loginForm"]["password"].value = "";
        document.forms["loginForm"]["idremember"].checked = false;
        alert("Credentials removed");
    } else {
        if (email == "" || pass == "") {
            document.forms["loginForm"]["idremember"].checked = false;
            alert("Please enter your credentials");
            return false;
        } else {
            setCookies("cemail", email, 30);
            setCookies("cpass", pass, 30);
            setCookies("crem", rememberme, 30);
            alert("Credentials Stored Success");
        }
    }

}

    function setCookies(cookiename, cookiedata, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cookiename + "=" + cookiedata + ";" + expires + ";path=/";
    }


    function loadCookies() {
        var username = getCookie("cemail");
        var password = getCookie("cpass");
        var rememberme = getCookie("crem");
        console.log("COOKIES:" + username, password, rememberme);
        document.forms["loginForm"]["email"].value = username;
        document.forms["loginForm"]["password"].value = password;
        if (rememberme) {
            document.forms["loginForm"]["idremember"].checked = true;
        } else {
            document.forms["loginForm"]["idremember"].checked = false;
        }
    }


    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function validateemail()  
    {  
    var x=document.loginForm.email.value;  
    var atposition=x.indexOf("@");  
    var dotposition=x.lastIndexOf(".");  
    if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
      alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
      return false;  
      }  
    }  




