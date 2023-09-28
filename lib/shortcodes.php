<?php

add_shortcode('degardc_countdown', 'degardc_countdown_callback');
function degardc_countdown_callback()
{
?>
    <style>
        #degardc-countdown ul {
            list-style-type: none;
            display: flex;
            gap: 15px;
            margin: auto;
            width: fit-content;
        }

        #degardc-countdown ul li {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #f7f7f7;
            border-radius: 5px;
            padding: 10px 20px;
            width: 30px;
        }
    </style>
    <div id="degardc-countdown">
        <ul>
            <li><span id="seconds"></span>ثانیه</li>
            <li><span id="minutes"></span>دقیقه</li>
            <li><span id="hours"></span>ساعت</li>
            <li><span id="days"></span>روز</li>
        </ul>
    </div>
    <script>
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
    </script>
<?php
}
