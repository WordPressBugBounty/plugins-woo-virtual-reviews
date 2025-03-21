jQuery(document).ready(function ($) {
    'use strict';
    $('.wvr-color-picker').wpColorPicker();
    $('.vi-ui.menu .item').viTab({history: true});
    $('.wvr-dropdown').each(function () {
        let placeholder = $(this).attr('placeholder');
        $(this).viDropdown({placeholder});
    });

    // Reply settings
    {
        const replyRow = ({lang = '', text = '', replys = {}}) => {
            let classHidden = wvrParams.languages.length === 0 && lang !== 'default' ? 'wvr-hidden' : '';
            let removeBtn = lang !== 'default' ? `<i class="dashicons dashicons-translation wvr-translate" data-lang="${lang}"> </i><i class="x icon wvr-remove-language"> </i>` : '';

            const textArea = (rating) => {
                let cmt = replys[rating] || '';
                if (Array.isArray(cmt)) cmt = cmt.join("\n");

                return `<div class="field">
                        <p>Reply for ${rating} &#9733;</p>
                        <textarea name="wvr_reply_content[${lang}][${rating}]" data-source="${lang}_${rating}">${cmt}</textarea>
                    </div>`
            };

            let tmpl = $(`<div class="vi-ui styled fluid accordion wvr-language-row ${classHidden}">
                    <div class="active title">
                        <i class="dropdown icon"> </i>
                       <span class="wvr-language-title">${text}</span>
                       ${removeBtn}
                    </div>
                    <div class="active content">
                        ${textArea(5)}
                        ${textArea(4)}
                        ${textArea(3)}
                        ${textArea(2)}
                        ${textArea(1)}
                    </div>
                </div>`);

            tmpl.vi_accordion({selector: {trigger: '.dropdown.icon'}});

            return tmpl;
        };

        let replysLangList = $('.wvr-replys-language-list');
        replysLangList.viDropdown({clearable: true});

        let replyContent = wvrParams.settings.reply_content || {};

        if (typeof replyContent === 'undefined' || Object.keys(replyContent).length === 0) {
            replyContent = {default: {1: '', 2: '', 3: '', 4: '', 5: ''}};
        }

        for (let lang in replyContent) {
            let text = wvrParams.languages[lang] || '';
            if (Object.keys(wvrParams.languages).length && !text) text = 'Default language';
            $('.wvr-reply-content-section').append(replyRow({lang, text, replys: replyContent[lang]}));
        }

        $('.wvr-add-language-reply').on('click', function () {
            let lang = replysLangList.viDropdown('get value'),
                text = replysLangList.viDropdown('get text');
            let textArea = replyRow({text, lang});
            if (lang) $('.wvr-reply-content-section').append(textArea);

            replysLangList.viDropdown('clear')
        });

        $('.wvr_params-wvr-reply-author').select2({
            width: '100%',
            placeholder: 'Search user',
            ajax: {
                url: wvrParams.ajaxUrl,
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                delay: 250,
                data: params => ({
                    action: 'wvr_search_user',
                    security: wvrParams.security,
                    keyword: params.term
                }),
                processResults: data => ({results: data}),
                cache: true
            },
            escapeMarkup: markup => markup,
            minimumInputLength: 1
        });
    }
});