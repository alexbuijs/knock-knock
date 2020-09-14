import { library, dom } from '@fortawesome/fontawesome-svg-core'

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
    faTrash
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
    faClock
)
dom.watch()
