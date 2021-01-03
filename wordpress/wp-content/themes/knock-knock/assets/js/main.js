import domReady from '@wordpress/dom-ready'
import { library, dom } from '@fortawesome/fontawesome-svg-core'

import Dropdown from 'bootstrap/js/dist/dropdown'
import Tooltip from 'bootstrap/js/dist/tooltip'

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

domReady(() => {
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
