import domReady from '@wordpress/dom-ready'
import flatpickr from 'flatpickr'
import { Dutch } from 'flatpickr/dist/l10n/nl'
import $ from 'jquery'

import 'bootstrap/js/dist/dropdown'
import 'bootstrap/js/dist/collapse'
import 'bootstrap/js/dist/modal'
import 'bootstrap/js/dist/tooltip'

import './icons'

const flatpickrConfig = {
    enableTime: true,
    allowInput: true,
    dateFormat: 'Y-m-d H:i',
    locale: Dutch
}

domReady(function () {
    // Activate datepicker
    document.querySelectorAll('div.datetimepicker input').forEach(el => {
        flatpickr(el, flatpickrConfig)
    })

    // Table links
    document.querySelectorAll('table tr').forEach(el => {
        el.onclick = function () {
            window.location = el.getAttribute('data-href')
        }
    })
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
