import React, { useState } from 'react'
import axios from 'axios'

import useFormValidation from './useFormValidation'
import validateProfileForm from './validateProfileForm'
import Alert from './alert'

const ProfileForm = (data) => {
    const { handleChange, handleSubmit, handleBlur, values, errors, setErrors, isSubmitting } = useFormValidation({
        email: data.email,
        phone: data.phone
    }, validateProfileForm, submitProfileForm)

    const [alert, setAlert] = useState(false)

    function submitProfileForm () {
        setAlert(false)

        // Create formdata
        const formData = new window.FormData()
        formData.append('action', 'save_profile')
        formData.append('security', data.nonce)
        Object.keys(values).forEach((key) => {
            formData.append(key, values[key])
        })

        return axios({
            method: 'post',
            url: data.ajaxUrl,
            data: formData
        }).then(response => {
            if (!response.data.success) {
                setErrors(response.data.data)
            } else {
                setAlert('Wijzigingen opgeslagen!')
            }
        }).catch(error => {
            console.error(error)
        })
    }

    return (
        <form onSubmit={handleSubmit}>
            { alert &&
                <Alert type={'success'} close={() => setAlert(false)}>{ alert }</Alert>
            }
            <h5 className="font-weight-bold">Persoonlijke gegevens</h5>
            <div className="form-group mt-2">
                <label htmlFor="phone">E-mailadres <small>(Let op: wordt nog niet gecontroleerd)</small></label>
                <input
                    onChange={handleChange}
                    onBlur={handleBlur}
                    type="text"
                    className={`form-control ${errors.email && 'is-invalid'}`}
                    name="email"
                    placeholder="E-mailadres"
                    value={ values.email } />
                { errors.email &&
                    <div className="invalid-feedback">
                        { errors.email }
                    </div>
                }
            </div>
            <div className="form-group mt-2">
                <label htmlFor="phone">Telefoonnummer</label>
                <input
                    onChange={handleChange}
                    onBlur={handleBlur}
                    type="text"
                    className={`form-control ${errors.phone && 'is-invalid'}`}
                    name="phone"
                    placeholder="Telefoonnummer"
                    value={ values.phone } />
                { errors.phone &&
                    <div className="invalid-feedback">
                        { errors.phone }
                    </div>
                }
            </div>
            <button type="submit" className="btn btn-primary" disabled={isSubmitting || Object.keys(errors).length}>
                <span className={`spinner-border spinner-border-sm mr-2 ${!isSubmitting ? 'd-none' : ''}`} role="status" aria-hidden="true"></span>
                <span className="body">{isSubmitting ? 'Even geduld...' : 'Opslaan'}</span>
            </button>
        </form>
    )
}

export default ProfileForm
