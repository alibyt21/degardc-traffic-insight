<style>
    .flex {
        display: flex;
    }

    .flex-col {
        flex-direction: column;
    }

    .gap-5 {
        gap: 20px;
    }

    .gap-1 {
        gap: 4px;
    }
</style>
<form action="" method="post">
    <div class="flex flex-col gap-5" style="margin-top: 30px;padding:10px">
        <div class="flex gap-1" style="min-width: 100px; align-items:center">
            <input type="checkbox" name="isActive" id="isActive" <?= $current_medium && $ads_content->isActive == "0" ? "" : "checked" ?>>
            <label for="isActive">فعال است</label>
        </div>
        <div class="flex gap-5" style="align-items:center">
            <div class="flex gap-1" style="min-width: 100px; align-items:center">
                <input type="checkbox" name="exact-match" id="exact-match" <?= $current_medium && $current_medium->exact_match == "0" ? "" : "checked" ?>>
                <label for="exact-match">exact match</label>
            </div>
            <div class="flex flex-col" style="width: 100%">
                <label for="url">آدرس صفحه</label>
                <div class="flex" style="direction: ltr;align-items:center">
                    <div><?= $root ?></div>
                    <input style="width: 100%;" type="text" name="url" id="url" value="<?= $medium->parse($medium_id); ?>">
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-1">
            <label for="ads-content">محتوا تبلیغ</label>
            <?php wp_editor($current_medium && $ads_content->type == "modal" ? $ads_content->content : null, 'ads-content', array("textarea_rows" => 8)); ?>
        </div>
        <div class="flex flex-col gap-1">
            <label for="accept-button">متن دکمه قبول</label>
            <input type="text" name="accept-button" value="<?= $current_medium && $ads_content->type == "modal" ? $ads_content->acceptButton : null ?>">
        </div>
        <div class="flex flex-col gap-1">
            <label for="reject-button">متن دکمه رد</label>
            <input type="text" name="reject-button" value="<?= $current_medium && $ads_content->type == "modal" ? $ads_content->rejectButton : null ?>">
        </div>
        <div class="flex gap-1" style="min-width: 100px; align-items:center">
            <input type="checkbox" name="isCounter" <?= $current_medium && $ads_content->type == "modal" &&  $ads_content->isCounter == "0" ? "" : "checked" ?>>
            <label for="isCounter">نمایش شمارنده</label>
        </div>
        <div class="flex flex-col gap-1" style="background-color: #cccccc;padding:10px">
            <label for="ads-content-custom">محتوا تبلیغ (سفارشی)</label>
            <?php wp_editor($current_medium && $ads_content->type == "custom" ? $ads_content->content : null, 'ads-content-custom', array("textarea_rows" => 8)); ?>
        </div>
        <div class="flex flex-col">
            <label for="discount-code">کد تخفیف</label>
            <select name="discount-code" id="discount-code">
                <?php foreach ($all_discounts as $discount) : ?>
                    <?= "<option value='$discount->post_name'" . ($discount->post_name == $current_medium->discount_code ? "selected" : "") . ">$discount->post_name</option>" ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex gap-1" style="min-width: 100px; align-items:center">
            <input type="checkbox" name="auto-discount" id="auto-discount" <?= $current_medium && $current_medium->auto_discount == "1" ? "checked" : "" ?>>
            <label for="auto-discount">اعمال خودکار کد تخفیف</label>
        </div>
        <div class="flex flex-col gap-1">
            <label>توضیح مهم</label>
            <p>هرجا که لازم است با کلیک روی آیتمی کد تخفیف تعریف شده به صورت خودکار اعمال شود تنها کافیست کلاس apply-code به المان مورد نظر اضافه شود</p>
        </div>
        <div class="flex flex-col">
            <input type="submit" name="degardc_ti_save_changes" class="button button-primary" value="ذخیره تغییرات">
        </div>
    </div>
</form>