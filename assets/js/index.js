(() => { ((a, b) => { if ("undefined" != typeof module && module.exports) return module.exports = b(); return "function" == typeof define && define.amd ? void define([], () => a.TimeMe = b()) : a.TimeMe = b() })(this, () => { let a = { startStopTimes: {}, idleTimeoutMs: 30000, currentIdleTimeMs: 0, checkIdleStateRateMs: 250, isUserCurrentlyOnPage: !0, isUserCurrentlyIdle: !1, currentPageName: "default-page-name", timeElapsedCallbacks: [], userLeftCallbacks: [], userReturnCallbacks: [], trackTimeOnElement: b => { let c = document.getElementById(b); c && (c.addEventListener("mouseover", () => { a.startTimer(b) }), c.addEventListener("mousemove", () => { a.startTimer(b) }), c.addEventListener("mouseleave", () => { a.stopTimer(b) }), c.addEventListener("keypress", () => { a.startTimer(b) }), c.addEventListener("focus", () => { a.startTimer(b) })) }, getTimeOnElementInSeconds: b => { let c = a.getTimeOnPageInSeconds(b); return c ? c : 0 }, startTimer: (b, c) => { if (b || (b = a.currentPageName), void 0 === a.startStopTimes[b]) a.startStopTimes[b] = []; else { let c = a.startStopTimes[b], d = c[c.length - 1]; if (void 0 !== d && void 0 === d.stopTime) return } a.startStopTimes[b].push({ startTime: c || new Date, stopTime: void 0 }) }, stopAllTimers: () => { let b = Object.keys(a.startStopTimes); for (let c = 0; c < b.length; c++)a.stopTimer(b[c]) }, stopTimer: (b, c) => { b || (b = a.currentPageName); let d = a.startStopTimes[b]; void 0 === d || 0 === d.length || d[d.length - 1].stopTime === void 0 && (d[d.length - 1].stopTime = c || new Date) }, getTimeOnCurrentPageInSeconds: () => a.getTimeOnPageInSeconds(a.currentPageName), getTimeOnPageInSeconds: b => { let c = a.getTimeOnPageInMilliseconds(b); return void 0 === c ? void 0 : c / 1e3 }, getTimeOnCurrentPageInMilliseconds: () => a.getTimeOnPageInMilliseconds(a.currentPageName), getTimeOnPageInMilliseconds: b => { let c = 0, d = a.startStopTimes[b]; if (void 0 === d) return; let e = 0; for (let a = 0; a < d.length; a++) { let b = d[a].startTime, c = d[a].stopTime; void 0 === c && (c = new Date); let f = c - b; e += f } return c = +e, c }, getTimeOnAllPagesInSeconds: () => { let b = [], c = Object.keys(a.startStopTimes); for (let d = 0; d < c.length; d++) { let e = c[d], f = a.getTimeOnPageInSeconds(e); b.push({ pageName: e, timeOnPage: f }) } return b }, setIdleDurationInSeconds: b => { let c = parseFloat(b); if (!1 === isNaN(c)) a.idleTimeoutMs = 1e3 * b; else throw { name: "InvalidDurationException", message: "An invalid duration time (" + b + ") was provided." } }, setCurrentPageName: b => { a.currentPageName = b }, resetRecordedPageTime: b => { delete a.startStopTimes[b] }, resetAllRecordedPageTimes: () => { let b = Object.keys(a.startStopTimes); for (let c = 0; c < b.length; c++)a.resetRecordedPageTime(b[c]) }, userActivityDetected: () => { a.isUserCurrentlyIdle && a.triggerUserHasReturned(), a.resetIdleCountdown() }, resetIdleCountdown: () => { a.isUserCurrentlyIdle = !1, a.currentIdleTimeMs = 0 }, callWhenUserLeaves: (b, c) => { a.userLeftCallbacks.push({ callback: b, numberOfTimesToInvoke: c }) }, callWhenUserReturns: (b, c) => { a.userReturnCallbacks.push({ callback: b, numberOfTimesToInvoke: c }) }, triggerUserHasReturned: () => { if (!a.isUserCurrentlyOnPage) { a.isUserCurrentlyOnPage = !0, a.resetIdleCountdown(); for (let b = 0; b < a.userReturnCallbacks.length; b++) { let c = a.userReturnCallbacks[b], d = c.numberOfTimesToInvoke; (isNaN(d) || d === void 0 || 0 < d) && (c.numberOfTimesToInvoke -= 1, c.callback()) } } a.startTimer() }, triggerUserHasLeftPageOrGoneIdle: () => { if (a.isUserCurrentlyOnPage) { a.isUserCurrentlyOnPage = !1; for (let b = 0; b < a.userLeftCallbacks.length; b++) { let c = a.userLeftCallbacks[b], d = c.numberOfTimesToInvoke; (isNaN(d) || d === void 0 || 0 < d) && (c.numberOfTimesToInvoke -= 1, c.callback()) } } a.stopAllTimers() }, callAfterTimeElapsedInSeconds: (b, c) => { a.timeElapsedCallbacks.push({ timeInSeconds: b, callback: c, pending: !0 }) }, checkIdleState: () => { for (let b = 0; b < a.timeElapsedCallbacks.length; b++)a.timeElapsedCallbacks[b].pending && a.getTimeOnCurrentPageInSeconds() > a.timeElapsedCallbacks[b].timeInSeconds && (a.timeElapsedCallbacks[b].callback(), a.timeElapsedCallbacks[b].pending = !1); !1 === a.isUserCurrentlyIdle && a.currentIdleTimeMs > a.idleTimeoutMs ? (a.isUserCurrentlyIdle = !0, a.triggerUserHasLeftPageOrGoneIdle()) : a.currentIdleTimeMs += a.checkIdleStateRateMs }, visibilityChangeEventName: void 0, hiddenPropName: void 0, listenForVisibilityEvents: (b, c) => { b && a.listenForUserLeavesOrReturnsEvents(), c && a.listForIdleEvents() }, listenForUserLeavesOrReturnsEvents: () => { "undefined" == typeof document.hidden ? "undefined" == typeof document.mozHidden ? "undefined" == typeof document.msHidden ? "undefined" != typeof document.webkitHidden && (a.hiddenPropName = "webkitHidden", a.visibilityChangeEventName = "webkitvisibilitychange") : (a.hiddenPropName = "msHidden", a.visibilityChangeEventName = "msvisibilitychange") : (a.hiddenPropName = "mozHidden", a.visibilityChangeEventName = "mozvisibilitychange") : (a.hiddenPropName = "hidden", a.visibilityChangeEventName = "visibilitychange"), document.addEventListener(a.visibilityChangeEventName, () => { document[a.hiddenPropName] ? a.triggerUserHasLeftPageOrGoneIdle() : a.triggerUserHasReturned() }, !1), window.addEventListener("blur", () => { a.triggerUserHasLeftPageOrGoneIdle() }), window.addEventListener("focus", () => { a.triggerUserHasReturned() }) }, listForIdleEvents: () => { document.addEventListener("mousemove", () => { a.userActivityDetected() }), document.addEventListener("keyup", () => { a.userActivityDetected() }), document.addEventListener("touchstart", () => { a.userActivityDetected() }), window.addEventListener("scroll", () => { a.userActivityDetected() }), setInterval(() => { !0 !== a.isUserCurrentlyIdle && a.checkIdleState() }, a.checkIdleStateRateMs) }, websocket: void 0, websocketHost: void 0, setUpWebsocket: b => { if (window.WebSocket && b) { let c = b.websocketHost; try { a.websocket = new WebSocket(c), window.onbeforeunload = () => { a.sendCurrentTime(b.appId) }, a.websocket.onopen = () => { a.sendInitWsRequest(b.appId) }, a.websocket.onerror = a => { console && console.log("Error occurred in websocket connection: " + a) }, a.websocket.onmessage = a => { console && console.log(a.data) } } catch (a) { console && console.error("Failed to connect to websocket host.  Error:" + a) } } }, websocketSend: b => { a.websocket.send(JSON.stringify(b)) }, sendCurrentTime: b => { let c = a.getTimeOnCurrentPageInMilliseconds(), d = { type: "INSERT_TIME", appId: b, timeOnPageMs: c, pageName: a.currentPageName }; a.websocketSend(d) }, sendInitWsRequest: b => { a.websocketSend({ type: "INIT", appId: b }) }, initialize: b => { let c, d, e = a.idleTimeoutMs || 30, f = a.currentPageName || "default-page-name", g = !0, h = !0; b && (e = b.idleTimeoutInSeconds || e, f = b.currentPageName || f, c = b.websocketOptions, d = b.initialStartTime, !1 === b.trackWhenUserLeavesPage && (g = !1), !1 === b.trackWhenUserGoesIdle && (h = !1)), a.setIdleDurationInSeconds(e), a.setCurrentPageName(f), a.setUpWebsocket(c), a.listenForVisibilityEvents(g, h), a.startTimer(void 0, d) } }; return a }) }).call(this);





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

    TimeMe.initialize();
    
    window.onbeforeunload = function (event) {
        send_data_to_back()
    };
    // // when user close the window OR go to other pages will be fired
    // window.addEventListener("unload", function (event) {
    //     event.preventDefault();
    //     // event.returnValue = ""; // This is ignored, but required for some legacy browsers
    //     send_data_to_back();
    // });

    // // when user move to other tabs without closing the window will be fired
    // document.addEventListener("visibilitychange", function () {
    //     if (document.visibilityState === "hidden") {
    //         send_data_to_back();
    //     }
    // });

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

    TimeMe.callWhenUserLeaves(function () {
        send_data_to_back();
    }, 5);


    let applyCodes = document.querySelectorAll(".apply-code");
    applyCodes.forEach(function (single){
        single.addEventListener("click",async function(){
            let response = await request_to_apply_discount_code();
            console.log(response.message);
            change_price_with_discounted_price(response.message)
        })
    });
}

function send_data_to_back() {
    // fetch(degardc_ti_ajax_object.ajax_url, {
    //     method: "POST",
    //     credentials: "same-origin",
    //     headers: {
    //         "Content-Type": "application/x-www-form-urlencoded",
    //         "Cache-Control": "no-cache",
    //     },
    //     body: new URLSearchParams({
    //         action: "degardc_ti_set_journey_time_ajax",
    //     }),
    // });

    var xhr = new XMLHttpRequest();
    xhr.open("POST", degardc_ti_ajax_object.ajax_url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("Cache-Control", "no-cache");
    xhr.send("action=degardc_ti_set_journey_time_ajax");
}

async function request_to_apply_discount_code() {
    let response = await fetch(degardc_ti_ajax_object.ajax_url, {
        method: "POST",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "Cache-Control": "no-cache",
        },
        body: new URLSearchParams({
            action: "degardc_ti_apply_discount_code_ajax",
            url: window.location.pathname
        }),
    });

    // return discounted price if successful
    return response.json();
}

function change_price_with_discounted_price($discountedPrice){
    let prices = document.querySelectorAll('bdi');
    for (let index = 0; index < prices.length; index++) {
        prices[index].style.textDecoration = "line-through";
        prices[index].style.margin = "5px";
        prices[index].style.color = "#999999";
        let father = prices[index].parentElement;
        father.innerHTML += $discountedPrice;
        
    }
}
