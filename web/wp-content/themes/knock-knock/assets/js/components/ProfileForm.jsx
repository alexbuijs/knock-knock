import React, { useState, useRef } from 'react'
import PropTypes from 'prop-types'
import axios from 'axios'

import useFormValidation from '../lib/useFormValidation'
import validateProfileForm from '../lib/validateProfileForm'
import Alert from './Alert'

const ProfileForm = ({ data, setUserImage }) => {
    const { handleChange, handleSubmit, handleBlur, values, setValues, errors, setErrors, isSubmitting } = useFormValidation({
        email: data.email,
        phone: data.phone,
        photo: ''
    }, validateProfileForm, submitProfileForm, data.uploadMaxFilesize)

    const [alert, setAlert] = useState(false)
    const formRef = useRef(null)

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
                setAlert({ type: 'success', message: 'Wijzigingen opgeslagen!' })
                setValues({
                    ...values,
                    photo: ''
                })
                formRef.current.reset()

                const { data } = response.data
                if (data.newPhoto) {
                    setUserImage(data.newPhoto)
                }
                return data
            }
        }).catch(error => {
            if (error.response) {
                setAlert({ type: 'danger', message: `Er ging helaas iets mis (code ${error.response.status})` })
            } else {
                setAlert({ type: 'danger', message: 'Er ging helaas iets mis' })
            }
            console.error(error)
        })
    }

    return (
        <form onSubmit={handleSubmit} ref={formRef}>
            { alert &&
                <Alert type={alert.type} close={() => setAlert(false)}>{ alert.message }</Alert>
            }
            <h5 className="fw-bold">Persoonlijke gegevens</h5>
            <div className="mt-2">
                <label htmlFor="phone" className="form-label">E-mailadres <small>(Let op: wordt niet gecontroleerd)</small></label>
                <input
                    onChange={handleChange}
                    onBlur={handleBlur}
                    type="text"
                    className={`form-control ${errors.email ? 'is-invalid' : ''}`}
                    name="email"
                    placeholder="E-mailadres"
                    value={ values.email } />
                { errors.email &&
                    <div className="invalid-feedback">
                        { errors.email }
                    </div>
                }
            </div>
            <div className="mt-2">
                <label htmlFor="phone" className="form-label">Telefoonnummer</label>
                <input
                    onChange={handleChange}
                    onBlur={handleBlur}
                    type="text"
                    className={`form-control ${errors.phone ? 'is-invalid' : ''}`}
                    name="phone"
                    placeholder="Telefoonnummer"
                    value={ values.phone } />
                { errors.phone &&
                    <div className="invalid-feedback">
                        { errors.phone }
                    </div>
                }
            </div>
            <h5 className="fw-bold mt-3">Foto</h5>
            <div className="mt-2">
                <label className="form-label" htmlFor="photo">Selecteer een nieuwe foto <small>(max. { data.uploadMaxFilesize }B)</small> en klik op opslaan.</label>
                <input
                    onChange={handleChange}
                    onBlur={handleBlur}
                    className={`form-control ${errors.photo ? 'is-invalid' : ''}`}
                    type="file"
                    id="photo"
                    name="photo"
                />
                { errors.photo &&
                    <div className="invalid-feedback">
                        { errors.photo }
                    </div>
                }
            </div>
            <button type="submit" className="btn btn-primary mt-3" disabled={isSubmitting || Object.keys(errors).length}>
                <span className={`spinner-border spinner-border-sm me-2 ${!isSubmitting ? 'd-none' : ''}`} role="status" aria-hidden="true"></span>
                <span className="body">{isSubmitting ? 'Even geduld...' : 'Opslaan'}</span>
            </button>
        </form>
    )
}

ProfileForm.propTypes = {
    data: PropTypes.object,
    setUserImage: PropTypes.func.isRequired
}

export default ProfileForm
