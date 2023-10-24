<style>
    .fixed {
        position: fixed
    }

    .bottom-0 {
        bottom: 0px
    }

    .left-0 {
        left: 0px
    }

    .right-0 {
        right: 0px
    }

    .top-0 {
        top: 0px
    }

    .z-50 {
        z-index: 50
    }

    .m-auto {
        margin: auto
    }

    .flex {
        display: flex
    }

    .grid {
        display: grid
    }

    .hidden {
        display: none
    }

    .h-6 {
        height: 1.5rem
    }

    .h-8 {
        height: 2rem
    }

    .h-screen {
        height: 100vh
    }

    .w-6 {
        width: 1.5rem
    }

    .w-8 {
        width: 2rem
    }

    .w-\[140px\] {
        width: 140px
    }

    .w-full {
        width: 100%
    }

    .max-w-\[600px\] {
        max-width: 600px
    }

    .transform {
        transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
    }

    .cursor-pointer {
        cursor: pointer
    }

    .grid-cols-4 {
        grid-template-columns: repeat(4, minmax(0, 1fr))
    }

    .flex-row {
        flex-direction: row
    }

    .flex-col {
        flex-direction: column
    }

    .items-center {
        align-items: center
    }

    .justify-end {
        justify-content: flex-end
    }

    .justify-center {
        justify-content: center
    }

    .justify-between {
        justify-content: space-between
    }

    .gap-2 {
        gap: 0.5rem
    }

    .gap-3 {
        gap: 0.75rem
    }

    .overflow-auto {
        overflow: auto
    }

    .rounded {
        border-radius: 0.25rem
    }

    .border {
        border-width: 1px
    }

    .border-solid {
        border-style: solid
    }

    .border-\[\#eeeeee\] {
        --tw-border-opacity: 1;
        border-color: rgb(238 238 238 / var(--tw-border-opacity))
    }

    .border-gray-200 {
        --tw-border-opacity: 1;
        border-color: rgb(229 231 235 / var(--tw-border-opacity))
    }

    .bg-\[\#00000088\] {
        background-color: #00000088 !important
    }

    .bg-\[\#f7f7f7\] {
        --tw-bg-opacity: 1;
        background-color: rgb(247 247 247 / var(--tw-bg-opacity)) !important
    }

    .bg-green-500 {
        --tw-bg-opacity: 1;
        background-color: rgb(34 197 94 / var(--tw-bg-opacity)) !important
    }

    .bg-red-500 {
        --tw-bg-opacity: 1;
        background-color: rgb(239 68 68 / var(--tw-bg-opacity)) !important
    }

    .bg-white {
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity)) !important
    }

    .p-0 {
        padding: 0px
    }

    .p-3 {
        padding: 0.75rem
    }

    .p-5 {
        padding: 1.25rem
    }

    .p-7 {
        padding: 1.75rem
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem
    }

    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem
    }

    .text-black {
        --tw-text-opacity: 1;
        color: rgb(0 0 0 / var(--tw-text-opacity)) !important
    }

    .text-white {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity)) !important
    }

    .shadow-lg {
        --tw-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms
    }

    .duration-100 {
        transition-duration: 100ms
    }

    .duration-300 {
        transition-duration: 300ms
    }

    .ease-in-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1)
    }

    .hover\:bg-green-600:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(22 163 74 / var(--tw-bg-opacity)) !important
    }

    .hover\:bg-red-600:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(220 38 38 / var(--tw-bg-opacity)) !important
    }
</style>
<div id="degardc-ti-modal" class="p-3 bg-[#00000088] overflow-auto transition-all duration-300 ease-in-out flex fixed top-0 right-0 left-0 bottom-0 z-50 h-screen w-full" style="visibility: hidden;opacity: 0; z-index: 9999999999">
    <!-- modal content -->
    <div class="bg-white transition-all duration-300 ease-in-out m-auto max-w-[600px] shadow-lg rounded" style="transform: translate(0,-100px);">
        <!-- modal header -->
        <div class="flex justify-between items-center p-3">
            <div class="close-modal text-black cursor-pointer w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="{1.5}" stroke="currentColor" className="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <div class="border border-gray-200 border-solid"></div>
        <!-- modal body -->
        <div class="w-full">
            <div class="modal-conent p-7">
                <div>
                    <?= $adsContent->content ?>
                </div>
                <?php if ($adsContent->isCounter == "true") { ?>
                    <div class="w-full grid grid-cols-4 gap-3 justify-center p-0 mt-4">
                        <div class="flex flex-col items-center rounded border border-solid border-[#eeeeee] bg-[#f7f7f7] py-2 px-4">
                            <span id="seconds">0</span>
                            <span>ثانیه</span>
                        </div>
                        <div class="flex flex-col items-center rounded border border-solid border-[#eeeeee] bg-[#f7f7f7] py-2 px-4">
                            <span id="minutes">0</span>
                            <span>دقیقه</span>
                        </div>
                        <div class="flex flex-col items-center rounded border border-solid border-[#eeeeee] bg-[#f7f7f7] py-2 px-4">
                            <span id="hours">0</span>
                            <span>ساعت</span>
                        </div>
                        <div class="flex flex-col items-center rounded border border-solid border-[#eeeeee] bg-[#f7f7f7] py-2 px-4">
                            <span id="days">0</span>
                            <span>روز</span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- modal buttons -->
        <?php if ($adsContent->rejectButton || $adsContent->acceptButton) { ?>
            <div class="border border-gray-200 border-solid"></div>
            <div class="flex flex-row items-center justify-between p-5">
                <div class="flex w-full justify-end gap-2">
                    <button class="close-modal transition-all duration-100 ease-in-out w-[140px] bg-red-500 hover:bg-red-600 text-white rounded py-2 cursor-pointer">
                        <?= $adsContent->rejectButton ?>
                    </button>
                    <button class="close-modal apply-code transition-all duration-100 ease-in-out w-[140px] bg-green-500 hover:bg-green-600 text-white rounded py-2 cursor-pointer">
                        <?= $adsContent->acceptButton ?>
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    // START countdown
    (function() {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        //I'm adding this section so I don't have to keep updating this pen every year :-)
        //remove this if you don't need it
        let today = new Date(),
            dd = String(today.getDate()).padStart(2, "0"),
            intdd = parseInt(dd);
        (mm = String(today.getMonth() + 1).padStart(2, "0")),
        (yyyy = today.getFullYear()),
        (nextYear = yyyy + 1),
        (tomorrow = intdd + 1);
        if (tomorrow > 31) {
            tomorrow = 1;
            intmm = parseInt(mm);
            newmm = intmm + 1;
            mm = String(newmm).padStart(2, "0");
        }
        stringtomorrow = String(tomorrow);
        (dayMonth = mm + "/" + stringtomorrow + "/"), (birthday = dayMonth + yyyy);

        today = mm + "/" + dd + "/" + yyyy;
        if (today > birthday) {
            birthday = dayMonth + nextYear;
        }
        //end

        const countDown = new Date(birthday).getTime(),
            x = setInterval(function() {
                const now = new Date().getTime(),
                    distance = countDown - now;
                if (document.getElementById("days")) {
                    (document.getElementById("days").innerText = Math.floor(
                        distance / day
                    )),
                    (document.getElementById("hours").innerText = Math.floor(
                        (distance % day) / hour
                    )),
                    (document.getElementById("minutes").innerText = Math.floor(
                        (distance % hour) / minute
                    )),
                    (document.getElementById("seconds").innerText = Math.floor(
                        (distance % minute) / second
                    ));
                }
            }, 1000);
    })();
    // END countdown

    // START modal
    let degardcTIModal = document.querySelector("#degardc-ti-modal");
    let modalClosers = document.querySelectorAll(".close-modal");
    let modalOpeners = document.querySelectorAll(".open-modal");
    let rd = Math.floor(Math.random() * 4000) + 6000;
    setTimeout(function() {
        open_modal(degardcTIModal)
    }, rd);
    modalOpeners.forEach(function(single) {
        single.addEventListener("click", function() {
            open_modal(degardcTIModal);
        });
    });
    modalClosers.forEach(function(single) {
        single.addEventListener("click", function() {
            close_modal(degardcTIModal);
        });
    });
    window.addEventListener("keyup", function(e) {
        if (e.code === "Escape" || e.keyCode === 27) {
            close_modal(degardcTIModal);
        }
    });

    function close_modal(node) {
        node.style.opacity = 0;
        node.style.visibility = "hidden";
        //first child of modal (should be modal body)
        node.children[0].style.transform = "translate(0,-100px)";
    }

    function open_modal(node) {
        node.style.opacity = 100;
        node.style.visibility = "visible";
        node.children[0].style.transform = "translate(0,0)";
    }
    // END modal
</script>