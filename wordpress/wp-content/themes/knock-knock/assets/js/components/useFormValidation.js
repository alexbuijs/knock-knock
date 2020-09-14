import { useState, useEffect } from 'react'

const useFormValidation = (initialState, validate, submitForm) => {
    const [values, setValues] = useState(initialState)
    const [errors, setErrors] = useState({})
    const [isSubmitting, setSubmitting] = useState(false)

    const handleChange = (e) => {
        const newValues = {
            ...values,
            [e.target.name]: e.target.value
        }
        setValues(newValues)

        // On change only check if errors get solved
        const validationErrors = validate(newValues)
        if (Object.keys(validationErrors).length < Object.keys(errors).length) {
            setErrors(validationErrors)
        }
    }

    useEffect(() => {
        async function asyncSubmit () {
            if (isSubmitting) {
                const noErrors = (Object.keys(errors).length === 0)
                if (noErrors) {
                    await submitForm()
                    setSubmitting(false)
                } else {
                    setSubmitting(false)
                }
            }
        }
        asyncSubmit()
    }, [errors])

    const handleBlur = (e) => {
        const validationErrors = validate(values)
        setErrors(validationErrors)
    }

    const handleSubmit = (e) => {
        e.preventDefault()
        const validationErrors = validate(values)
        setErrors(validationErrors)
        setSubmitting(true)
    }

    return { handleChange, handleSubmit, handleBlur, values, errors, setErrors, isSubmitting }
}

export default useFormValidation
