import { getBytes } from './helpers'

export default function validateProfileForm (values, maxFileSize) {
    const errors = {}

    // Email
    if (!values.email) {
        errors.email = 'E-mailadres mag niet leeg zijn'
    } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(values.email)) {
        errors.email = 'E-mailadres lijkt niet geldig te zijn'
    }

    // Phone
    if (/[a-zA-Z]/i.test(values.phone)) {
        errors.phone = 'Letters zijn niet toegestaan'
    } else if (!/^[0-9\-+()]*$/i.test(values.phone)) {
        errors.phone = 'Alleen de karakters 0 t/m 9, +, (, ) en - zijn toegestaan'
    }

    // Photo
    console.log(getBytes(maxFileSize))
    if (values.photo && values.photo.size > getBytes(maxFileSize)) {
        errors.photo = `Bestand mag niet groter zijn dan ${maxFileSize}B`
    } else if (values.photo && values.photo.type !== 'image/jpeg') {
        errors.photo = 'Alleen jpg-bestanden zijn toegestaan'
    }

    return errors
}
