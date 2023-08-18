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
if(getCookie("deg_UJ")){
    window.addEventListener("beforeunload", async function (event) {
        event.preventDefault();
        // let endTime = new Date();
        // let duration = ((endTime - startTime));
        // Cancel the event
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
    });
}
