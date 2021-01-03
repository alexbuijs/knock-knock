import domReady from '@wordpress/dom-ready'
import flatpickr from 'flatpickr'
import { Dutch } from 'flatpickr/dist/l10n/nl'

const flatpickrConfig = {
    enableTime: true,
    allowInput: true,
    dateFormat: 'Y-m-d H:i',
    locale: Dutch
}

domReady(() => {
    // Activate datepicker
    document.querySelectorAll('div.datetimepicker input').forEach(el => {
        flatpickr(el, flatpickrConfig)
    })
    console.log('hi')
})
