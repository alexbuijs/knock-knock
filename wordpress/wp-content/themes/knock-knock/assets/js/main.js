import domReady from '@wordpress/dom-ready'
import flatpickr from 'flatpickr'
import { Dutch } from 'flatpickr/dist/l10n/nl'
import { library, dom } from '@fortawesome/fontawesome-svg-core'
import { Dropdown, Tooltip } from 'bootstrap'

// Regular
import {
    faBell,
    faCalendarAlt,
    faFile,
    faUser,
    faClock
} from '@fortawesome/free-regular-svg-icons'

// Solid
import {
    faHome,
    faQuestion,
    faPlus,
    faList,
    faPowerOff,
    faArrowLeft,
    faArrowRight,
    faEnvelope,
    faPhone,
    faMapMarker,
    faPencilAlt,
    faTrash,
    faSun,
    faAdjust,
    faMoon
} from '@fortawesome/free-solid-svg-icons'

// Initialise
library.add(
    faCalendarAlt,
    faBell,
    faFile,
    faUser,
    faHome,
    faQuestion,
    faPlus,
    faList,
    faPowerOff,
    faArrowLeft,
    faArrowRight,
    faEnvelope,
    faPhone,
    faMapMarker,
    faPencilAlt,
    faTrash,
    faClock,
    faSun,
    faAdjust,
    faMoon
)
dom.watch()

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

    // Table links
    document.querySelectorAll('table tr').forEach(el => {
        el.onclick = function () {
            const link = el.getAttribute('data-href')

            if (link) {
                window.location = link
            }
        }
    })

    // Dropdown
    const dropdownElements = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    dropdownElements.map(el => {
        return new Dropdown(el)
    })

    // Tooltips
    const tooltipElements = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    tooltipElements.forEach(el => {
        return new Tooltip(el)
    })
})
