import React from 'react'
import PropTypes from 'prop-types'

const Alert = ({ children, type, close }) => {
    return (
        <div>
            <div className={`alert alert-dismissible alert-${type}`} role="alert">
                {children}
                <button type="button" className="btn-close" data-bs-dismiss="alert" aria-label="Close" onClick={close}></button>
            </div>
        </div>
    )
}

Alert.propTypes = {
    children: PropTypes.node.isRequired,
    type: PropTypes.string.isRequired,
    close: PropTypes.func.isRequired
}

export default Alert
