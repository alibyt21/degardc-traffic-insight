// let startTime = new Date();
// let fullRequestUrl = window.location.href.replace(window.location.origin,"");
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

if (getCookie("deg_UJ")) {

    // when user close the window OR go to other pages will be fired
    window.addEventListener("beforeunload", function (event) {
        event.returnValue = ""; // This is ignored, but required for some legacy browsers
        send_data_to_back();
    });

    // when user move to other tabs without closing the window will be fired
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "hidden") {
            send_data_to_back();
        }
    });

    document.onreadystatechange = () => {
        if (document.readyState === "loading") {
            send_data_to_back();
        } else if (document.readyState === "interactive") {
            send_data_to_back();
        } else {
            // document ready
            send_data_to_back();
        }
    };
}

function send_data_to_back() {
    fetch(degardc_ti_ajax_object.ajax_url, {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "Cache-Control": "no-cache",
        },
        body: new URLSearchParams({
            action: "degardc_ti_set_journey_time_ajax",
        }),
    });
}
