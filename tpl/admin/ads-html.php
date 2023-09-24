<?php

?>

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
        <div class="flex flex-col">
            <label for="url">آدرس صفحه</label>
            <div class="flex" style="direction: ltr;align-items:center">
                <div><?= $root ?></div>
                <input style="width: 100%;" type="text" name="url" id="url" value="<?= $medium->parse($medium_id); ?>">
            </div>
        </div>
        <div class="flex flex-col gap-1">
            <label for="ads-content">محتوا تبلیغ</label>
            <?php wp_editor($current_medium->ads_content, 'ads-content', array("textarea_rows" => 8)); ?>
        </div>
        <div class="flex flex-col">
            <label for="discount-code">کد تخفیف</label>
            <select name="discount-code" id="discount-code">
                <?php foreach ($all_discounts as $discount) : ?>
                    <?php echo "<option value='$discount->post_name'" . ($discount->post_name == $current_medium->discount_code ? "selected" : "") . ">$discount->post_name</option>" ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex">
            <input type="checkbox" name="auto-discount" id="auto-discount" <?= $current_medium->auto_discount == "1" ? "checked" : "" ?>>
            <label for="auto-discount">اعمال خودکار کد تخفیف</label>
        </div>
        <div class="flex flex-col">
            <input type="submit" name="degardc_ti_save_changes" class="button button-primary" value="ذخیره تغییرات">
        </div>
    </div>
</form>