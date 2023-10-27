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