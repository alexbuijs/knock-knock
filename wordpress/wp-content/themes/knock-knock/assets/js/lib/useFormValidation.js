import { useState, useEffect } from 'react'

const useFormValidation = (initialState, validate, submitForm, maxFileSize) => {
    const [values, setValues] = useState(initialState)
    const [errors, setErrors] = useState({})
    const [isSubmitting, setSubmitting] = useState(false)

    const handleChange = (e) => {
        const newValues = {
            ...values,
            [e.target.name]: (e.target.type === 'file') ? e.target.files[0] : e.target.value
        }

        setValues(newValues)

        // On change only check if   get solved
        const validationErrors = validate(newValues, maxFileSize)
        if (Object.keys(validationErrors).length < Object.keys(errors).length) {
            setErrors(validationErrors)
        }
    }

    useEffect(() => {
        async function asyncSubmit () {
            if (!isSubmitting) {
                return
            }
            const noErrors = (Object.keys(errors).length === 0)
            if (noErrors) {
                const response = await submitForm()

                // Filter out the values we have in our form from the response
                const newValues = response ? Object.keys(response)
                    .filter(key => Object.keys(values).includes(key))
                    .reduce((obj, key) => {
                        return { ...obj, [key]: response[key] }
                    }, {}) : {}
                setValues({ ...values, ...newValues })
            }

            setSubmitting(false)
        }
        asyncSubmit()
    }, [errors])

    const handleBlur = (e) => {
        const validationErrors = validate(values, maxFileSize)
        setErrors(validationErrors)
    }

    const handleSubmit = (e) => {
        e.preventDefault()
        const validationErrors = validate(values, maxFileSize)
        setErrors(validationErrors)
        setSubmitting(true)
    }

    return { handleChange, handleSubmit, handleBlur, values, setValues, errors, setErrors, isSubmitting }
}

export default useFormValidation
