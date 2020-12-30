import React, { useEffect, useState, useRef } from 'react'
import PropTypes from 'prop-types'
import useBodyClass from '../lib/useBodyClass'

import axios from 'axios'

const SettingsForm = ({ data }) => {
    const [theme, setTheme] = useState(data.themePreference ? data.themePreference : 'system-default')

    const skipOnce = useRef(true)
    useEffect(() => {
        if (skipOnce.current) {
            skipOnce.current = false
            return
        }

        // Store preference
        const formData = new window.FormData()
        formData.append('action', 'save_theme_preference')
        formData.append('security', data.nonce)
        formData.append('theme', theme)

        axios({
            method: 'post',
            url: data.ajaxUrl,
            data: formData
        }).then().catch(console.error)
    }, [theme])

    useBodyClass(theme)

    return (
        <form>
            <h5 className="font-weight-bold">Intranet voorkeuren</h5>
            <div className="theme-select d-flex align-items-center">
                <h6 className="m-0 mr-4">Thema</h6>
                <div>
                    <div className="custom-control custom-radio custom-control-inline mr-4 mt-2">
                        <input type="radio" id="customRadioInline1" checked={theme === 'prefers-light'} name="customRadioInline1" className="custom-control-input" onChange={() => setTheme('prefers-light')}/>
                        <label className="custom-control-label text-center" htmlFor="customRadioInline1">
                            <i className="fas fa-sun fa-2x"></i><br/>
                            Licht
                        </label>
                    </div>
                    <div className="custom-control custom-radio custom-control-inline mr-4 mt-2">
                        <input type="radio" id="customRadioInline2" checked={theme === 'system-default'} name="customRadioInline1" className="custom-control-input" onChange={() => setTheme('system-default')}/>
                        <label className="custom-control-label text-center" htmlFor="customRadioInline2">
                            <i className="fas fa-adjust fa-2x"></i><br/>
                            Systeeminstelling
                        </label>
                    </div>
                    <div className="custom-control custom-radio custom-control-inline mt-2">
                        <input type="radio" id="customRadioInline3" checked={theme === 'prefers-dark'} name="customRadioInline1" className="custom-control-input" onChange={() => setTheme('prefers-dark')}/>
                        <label className="custom-control-label text-center" htmlFor="customRadioInline3">
                            <i className="fas fa-moon fa-2x"></i><br/>
                            Donker
                        </label>
                    </div>
                </div>
            </div>
        </form>
    )
}

SettingsForm.propTypes = {
    data: PropTypes.object
}

export default SettingsForm
