import React from 'react'
import PropTypes from 'prop-types'

const Alert = ({ children, type, close }) => {
    return (
        <div className={`alert alert-dismissible alert-${type}`} role="alert">
            {children}
            <button type="button" className="close" data-dismiss="alert" aria-label="Close" onClick={close}>
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    )
}

Alert.propTypes = {
    children: PropTypes.node.isRequired,
    type: PropTypes.string.isRequired,
    close: PropTypes.func.isRequired
}

export default Alert
