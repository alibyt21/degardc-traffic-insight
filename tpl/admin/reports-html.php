<style>
    .ml-5 {
        margin-left: 1.25rem
    }

    .table {
        display: table
    }

    .w-full {
        width: 100%
    }

    .rounded {
        border-radius: 0.25rem
    }

    .bg-white {
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity))
    }

    .px-10 {
        padding-left: 2.5rem;
        padding-right: 2.5rem
    }

    .py-5 {
        padding-top: 1.25rem;
        padding-bottom: 1.25rem
    }

    td {
        padding: 15px !important;
    }

    th {
        border-top: 1px solid #dddddd;
        border-bottom: 1px solid #dddddd;
        border-right: 1px solid #dddddd;
    }

    .dataTables_filter {
        margin-bottom: 20px;
    }

    .dataTables_wrapper .dataTables_paginate a.paginate_button.current {
        color: white !important;
        background: #4aaefe !important;
        border: 1px solid #4aaefe !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #29A0FF;
        border: 1px solid #29A0FF;
    }

    .dataTables_length {
        margin-bottom: 20px;
    }

    .dataTables_length select {
        margin: 0px 8px;
    }

    .dataTables_filter input {
        margin: 0 8px;
        border: 1px solid #aaaaaa !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0px 12px;
    }

    .dataTables_paginate {
        padding-top: 12px !important;
    }

    .paginate_button {
        border: 1px solid #efefef !important;
        margin: 0px !important;
    }
</style>


<div class="bg-white ml-5 py-5 px-10 rounded" style="margin-top: 30px;padding:10px">
    <form action="" method="GET">
        <table id="report" class="w-full cell-border stripe nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: right;">صفحه</th>
                    <th style="text-align: right;">utm_source</th>
                    <th style="text-align: right;">utm_medium</th>
                    <th style="text-align: right;">utm_campaign</th>
                    <th style="text-align: right;">utm_content</th>
                    <th style="text-align: right;">زمان اولین بازدید</th>
                    <th style="text-align: right;">تعداد بازدید</th>
                    <th style="text-align: right;">میانگین زمان بازدید</th>
                    <th style="text-align: right;">ویرایش تبلیغ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($urls as $url) :
                    $requests = $requestObj->get_by_medium_id($url->id);
                    $total_visit_time = 0;
                    $requests_count = count($requests);
                    foreach ($requests as $request) {
                        $total_visit_time = (int)($request->visit_duration) + $total_visit_time;
                    }
                ?>
                    <tr>
                        <td>
                            <?= str_replace("?", "", $url->url) ?>
                        </td>
                        <td>
                            <?= $url->utm_source ?>
                        </td>
                        <td>
                            <?= $url->utm_medium ?>
                        </td>
                        <td>
                            <?= $url->utm_campaign ?>
                        </td>
                        <td>
                            <?= $url->utm_content ?>
                        </td>
                        <td>
                            <?= $url->created_at ?>
                        </td>
                        <td>
                            <?= $requests_count ?>
                        </td>
                        <td>
                            <?= $requests_count ?  date('H:i:s', $total_visit_time / $requests_count) : "00:00:00" ?>
                        </td>
                        <td>
                            <?= "<a href='" . $_SERVER['REQUEST_URI'] . "-new&id=" . $url->id . "'>ویرایش</a>" ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>


<script>
    setTimeout(function() {
        let table = new DataTable('#report', {
            pageLength: 25,
            order: [
                [1, 'desc']
            ],
            scrollX: true,
            pagingType: "full_numbers",
            language: {
                lengthMenu: "نمایش _MENU_ نتیجه در هر صفحه",
                zeroRecords: "متاسفانه نتیجه ای یافت نشد",
                info: " نمایش صفحه _PAGE_ از مجموع _PAGES_ صفحه ",
                search: " جستجو: ",
                paginate: {
                    next: "بعدی",
                    previous: "قبلی",
                    first: "ابتدا",
                    last: "انتها",
                },
                infoEmpty: "",
                infoFiltered: "",
            },
        });
    }, 0);
</script>